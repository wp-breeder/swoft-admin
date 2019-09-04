<template>
  <v-app>
    <v-dialog v-model="dialog" persistent max-width="600px">
      <v-card ref="menu">
        <v-card-title>
          <span class="headline">{{ $t("App.menuInfo") }}</span>
        </v-card-title>
        <v-card-text>
          <v-container grid-list-md>
            <v-layout wrap>
              <v-flex xs12 sm6>
                <v-text-field
                  :label="$t('App.menuName') + '*'"
                  v-model="menu.menu_name"
                  ref="menu_name"
                  :rules="[rules.required]"
                ></v-text-field>
              </v-flex>
              <v-flex xs12 sm6>
                <v-text-field
                  :label="$t('App.menuAuthAlias') + '*'"
                  v-model="menu.alias"
                  ref="alias"
                  :rules="[rules.required]"
                ></v-text-field>
              </v-flex>
              <v-flex xs12>
                <v-select
                  v-model="menu.menu_type"
                  ref="menu_type"
                  :items="menuTypes"
                  item-text="name"
                  item-value="menu_type"
                  :label="$t('App.menuType') + '*'"
                  required
                ></v-select>
              </v-flex>
              <v-flex xs12>
                <v-autocomplete
                  v-model="menu.icon"
                  ref="icon"
                  :items="icons"
                  chips
                  :label="$t('App.menuIconPicker') + '*'"
                  item-text="name"
                  item-value="name"
                >
                  <template v-slot:selection="data">
                    <v-chip :selected="data.selected" class="chip--select">
                      <v-icon>{{ data.item.name }}</v-icon>
                      &nbsp;{{ data.item.name }}
                    </v-chip>
                  </template>
                  <template v-slot:item="data">
                    <template v-if="typeof data.item === 'object'">
                      <v-list-tile-avatar>
                        <v-icon class="white">{{ data.item.name }}</v-icon>
                      </v-list-tile-avatar>
                      <v-list-tile-content>
                        <v-list-tile-title
                          v-html="data.item.name"
                        ></v-list-tile-title>
                        <v-list-tile-sub-title
                          v-html="data.item.group"
                        ></v-list-tile-sub-title>
                      </v-list-tile-content>
                    </template>
                  </template>
                </v-autocomplete>
              </v-flex>
              <v-flex xs12>
                {{ $t("Sys.status") }}
                <v-radio-group v-model="menu.status" ref="status" row>
                  <v-radio
                    :label="$t('Sys.enable')"
                    color="success"
                    :value="1"
                  ></v-radio>
                  <v-radio
                    :label="$t('Sys.disable')"
                    color="warning"
                    :value="0"
                  ></v-radio>
                </v-radio-group>
              </v-flex>
              <v-flex xs12 sm6>
                <v-text-field
                  v-if="menu.menu_type === 1"
                  :label="$t('App.menuPath') + '*'"
                  v-model="menu.path"
                  :rules="[rules.required]"
                  ref="path"
                ></v-text-field>
              </v-flex>
              <v-flex xs12 sm6>
                <v-text-field
                  v-if="menu.menu_type === 1"
                  :label="$t('App.menuRouter') + '*'"
                  v-model="menu.router"
                  :rules="[rules.required]"
                  ref="router"
                ></v-text-field>
              </v-flex>
              <v-flex xs12>
                <v-select
                  :items="menus"
                  :label="$t('App.parentMenu') + '*'"
                  v-if="menu.menu_type !== 0"
                  item-text="menu_name"
                  item-value="menu_id"
                  v-model="menu.menu_id"
                  :rules="[rules.required]"
                  ref="menu_id"
                ></v-select>
              </v-flex>
              <v-flex xs12>
                <v-select
                  :items="resources"
                  v-if="menu.menu_type !== 0"
                  :label="$t('App.menuResourceMapping') + '*'"
                  item-text="resource"
                  item-value="resource_id"
                  v-model="menu.resource_ids"
                  ref="resource_ids"
                  multiple
                  chips
                  deletable-chips
                  clearable
                ></v-select>
              </v-flex>
            </v-layout>
          </v-container>
          <small>{{ $t("Sys.requireMsg") }}</small>
        </v-card-text>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn color="blue darken-1" flat @click="setState">Close</v-btn>
          <v-btn color="blue darken-1" flat @click="createOrUpdateMenu"
            >Save</v-btn
          >
        </v-card-actions>
      </v-card>
    </v-dialog>
  </v-app>
</template>
<script>
import icon from "@/libs/icon";

export default {
  data() {
    return {
      rules: {
        required: value => !!value || "Required."
      },
      menu: {
        menu_name: "",
        menu_type: 0,
        icon: "favorite_border",
        alias: "",
        status: 1,
        path: "",
        router: "",
        menu_id: 0,
        resource_ids: []
      },
      row: 1,
      icons: []
    };
  },
  computed: {
    menuTypes() {
      return [
        { name: this.$t("Sys.folder"), menu_type: 0 },
        { name: this.$t("Sys.menu"), menu_type: 1 },
        { name: this.$t("Sys.button"), menu_type: 2 }
      ];
    }
  },
  props: {
    dialog: {
      type: Boolean,
      default: false
    },
    resources: {
      type: Array,
      default: () => []
    },
    menus: {
      type: Array,
      default: () => []
    },
    pMenu: {
      menu_name: {
        type: String,
        default: ""
      },
      menu_type: {
        type: Number,
        default: 0
      },
      icon: {
        type: String,
        default: "favorite_border"
      },
      alias: {
        type: String,
        default: ""
      },
      status: {
        type: Number,
        default: 1
      },
      path: {
        type: String,
        default: ""
      },
      router: {
        type: String,
        default: ""
      },
      menu_id: {
        type: Number,
        default: 0
      },
      resource_ids: {
        type: Array,
        default: () => []
      }
    }
  },
  methods: {
    init() {
      // init icon picker
      Object.keys(icon).forEach(key => {
        this.$data.icons.push({ header: key });
        icon[key].forEach(val => {
          this.$data.icons.push({ name: val });
        });
        this.$data.icons.push({ divider: true });
      });
    },
    setState() {
      Object.keys(this.$data.menu).forEach(f => {
        if (this.$refs[f] !== undefined) {
          this.$refs[f].reset();
        }
      });
      this.$data.menu = Object.assign(
        {},
        {
          menu_name: "",
          menu_type: 0,
          icon: "favorite_border",
          alias: "",
          status: 1,
          path: "",
          router: "",
          menu_id: 0,
          resource_ids: []
        }
      );
      this.$emit("setState");
    },
    createOrUpdateMenu() {
      this.$data.menu.resource_ids = this.$data.menu.resource_ids.join(",");
      this.$data.menu.parent_id =
        !this.$data.menu.menu_id || this.$data.menu.menu_id === 0
          ? ""
          : this.$data.menu.menu_id;
      delete this.$data.menu.menu_id;
      this.$api.menu.create(this.$data.menu).then(() => {
        this.$notify.success("create menu success", { timeout: 500 });
        this.setState();
      });
    }
  },
  watch: {
    pMenu() {
      this.$data.menu = this.$props.pMenu;
    }
  },
  created() {
    this.init();
  }
};
</script>