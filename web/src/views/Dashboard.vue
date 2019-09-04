<template>
  <v-app id="sandbox" :dark="theme">
    <!-- left top sidebar start -->
    <v-navigation-drawer v-model="primaryDrawer.model" clipped app>
      <v-list>
        <template v-for="item in items">
          <v-layout v-if="item.heading" :key="item.heading" row align-center>
            <v-flex xs6>
              <v-subheader v-if="item.heading">
                {{ item.heading }}
              </v-subheader>
            </v-flex>
          </v-layout>
          <v-list-group
            v-else-if="item.children"
            :key="item.menu_name"
            v-model="item.model"
            :prepend-icon="item.model ? item.icon : item['icon-alt']"
            append-icon=""
          >
            <template v-slot:activator>
              <v-list-tile>
                <v-list-tile-content>
                  <v-list-tile-title>
                    {{ item.menu_name }}
                  </v-list-tile-title>
                </v-list-tile-content>
              </v-list-tile>
            </template>
            <v-list-tile
              v-for="(child, i) in item.children"
              :key="i"
              @click="jump(child.path)"
            >
              <v-list-tile-action v-if="child.icon">
                <i class="material-icons">
                  {{ child.icon }}
                </i>
              </v-list-tile-action>
              <v-list-tile-content>
                <v-list-tile-title>
                  {{ child.menu_name }}
                </v-list-tile-title>
              </v-list-tile-content>
            </v-list-tile>
          </v-list-group>
          <v-list-tile v-else :key="item.menu_name" @click="jump(child.path)">
            <v-list-tile-action>
              <v-icon>{{ item.icon }}</v-icon>
            </v-list-tile-action>
            <v-list-tile-content>
              <v-list-tile-title>
                {{ item.menu_name }}
              </v-list-tile-title>
            </v-list-tile-content>
          </v-list-tile>
        </template>
      </v-list>
    </v-navigation-drawer>
    <!-- header -->
    <Header
      @changeDrawerModel="setModel"
      :primaryDrawerModel="primaryDrawer.model"
      :primaryDrawerType="primaryDrawer.type"
    />
    <!-- right sidebar -->
    <v-content>
      <v-container fluid>
        <router-view></router-view>
      </v-container>
    </v-content>
    <!-- footer -->
    <Footer />
  </v-app>
</template>

<script>
import Header from "@/components/Header";
import Footer from "@/components/Footer";
import { renderMenu } from "@/libs/util";

export default {
  data: () => ({
    dark: true,
    primaryDrawer: {
      type: true,
      model: true
    },
    dialog: false,
    drawer: null,
    items: []
  }),
  components: { Header, Footer },
  computed: {
    theme() {
      return this.$store.state.dark;
    }
  },
  methods: {
    init() {
      let menu = renderMenu(this.$store.getters.menus);
      this.$data.items = menu;
      this.$router.push({
        path: menu[0].jump === undefined ? "/" : menu[0].jump
      });
    },
    setModel(status) {
      this.primaryDrawer.model = status;
    },
    jump(path) {
      this.$router.push({ path: "/" + path });
    }
  },
  created() {
    this.init();
  }
};
</script>