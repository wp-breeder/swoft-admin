<template>
  <v-app>
    <v-dialog v-model="menuDialog" persistent max-width="800px">
      <v-card>
        <v-toolbar card color="grey lighten-3">
          <v-toolbar-title>{{ $t("App.menuAuthority") }}</v-toolbar-title>
        </v-toolbar>
        <v-layout>
          <v-flex>
            <v-card-text>
              <v-treeview
                v-model="tree"
                :load-children="fetch"
                :items="items"
                item-key="menu_id"
                item-text="menu_name"
                selected-color="indigo"
                open-on-click
                selectable
              >
              </v-treeview>
            </v-card-text>
          </v-flex>
          <v-divider vertical></v-divider>
          <v-flex xs12 md6>
            <v-card-text>
              <div
                v-if="selections.length === 0"
                key="title"
                class="title font-weight-light grey--text pa-3 text-xs-center"
              >
                {{ $t("App.selectMenuMsg") }}
              </div>

              <v-scroll-x-transition group hide-on-leave>
                <v-chip
                  v-for="(selection, i) in selections"
                  :key="i"
                  color="grey"
                  dark
                  small
                >
                  <i class="material-icons">
                    {{ selection.icon }}
                  </i>
                  {{ selection.menu_name }}
                </v-chip>
              </v-scroll-x-transition>
            </v-card-text>
          </v-flex>
        </v-layout>
        <v-divider></v-divider>
        <v-card-actions>
          <v-btn flat @click="tree = []">
            {{ $t("Sys.reset") }}
          </v-btn>
          <v-spacer></v-spacer>
          <v-btn
            class="white--text"
            color="green darken-1"
            depressed
            @click="close"
          >
            {{ $t("Sys.close") }}
            <v-icon right>close</v-icon>
          </v-btn>
          <v-btn
            class="white--text"
            color="green darken-1"
            depressed
            @click="saveMenus"
          >
            {{ $t("Sys.save") }}
            <v-icon right>save</v-icon>
          </v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
  </v-app>
</template>
<script>
//TODO: upgrade vuetify 2.0+ ,fixed treeview bug
import { genTree } from "@/libs/util";

export default {
  data: () => ({
    menus: [],
    tree: [],
    types: []
  }),

  computed: {
    items() {
      const children = this.types.map(type => ({
        menu_id: type.menu_id,
        menu_name: type.menu_name,
        children: genTree(this.$data.menus, type.menu_id)
      }));
      return [
        {
          menu_id: 0,
          menu_name: this.$t("App.allMenus"),
          children
        }
      ];
    },
    selections() {
      const selections = [];
      for (const leaf of this.tree) {
        const children = this.$data.menus.find(menu => menu.menu_id === leaf);
        if (!children) continue;
        selections.push(children);
        const parent = this.$data.menus.find(
          menu => children.parent_id === menu.menu_id
        );
        if (!parent) continue;
        selections.push(parent);
      }

      return selections;
    }
  },
  props: {
    selectedMenu: {
      type: Array,
      default: () => []
    },
    menuDialog: {
      type: Boolean,
      default: false
    },
    roleId: {
      type: Number,
      default: undefined
    }
  },
  watch: {
    // set authorized menus
    menus(val) {
      this.$data.types = val
        .reduce((acc, cur) => {
          if (cur.parent_id === 0) acc.push(cur);
          return acc;
        }, [])
        .sort();
    }
  },

  methods: {
    fetch() {
      if (this.$data.menus.length) return;

      return this.$api.menu.get().then(data => (this.$data.menus = data.data));
    },
    saveMenus() {
      let menus = this.$data.tree
        .filter(val => !(!val || val === ""))
        .join(",");
      this.$api.role
        .updateRoleMenu(this.$props.roleId, { menu_ids: menus })
        .then(() => {
          this.$notify.success("save success", { timeout: 500 });
          this.close();
        });
    },
    close() {
      this.$data.tree = [];
      this.$emit("setMenuDialog", false);
    }
  }
};
</script>