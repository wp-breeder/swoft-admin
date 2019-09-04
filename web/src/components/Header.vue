<template>
  <v-toolbar clipped-left absolute app>
    <v-toolbar-side-icon
      v-if="primaryDrawer.type"
      @click.stop="setModel"
    ></v-toolbar-side-icon>
    <v-toolbar-title class="headline text-uppercase">
      <span>SWOFT</span>
      <span class="font-weight-light">{{ $t("Sys.title") }}</span>
    </v-toolbar-title>
    <UserCenter
      :setDialog="dialog"
      @closeDialog="close"
      v-if="primaryDrawer.type"
    />
    <v-spacer></v-spacer>
    <!-- serach -->
    <v-text-field
      flat
      solo-inverted
      hide-details
      prepend-inner-icon="search"
      :label="$t('Sys.search')"
      class="hidden-sm-and-down"
      v-if="primaryDrawer.type"
    ></v-text-field>
    <!-- theme -->
    <v-menu offset-y>
      <template v-slot:activator="{ on }">
        <v-btn v-on="on" flat>
          {{ $t("Sys.theme") }}
        </v-btn>
      </template>
      <v-list>
        <v-list-tile
          v-for="(item, index) in themeItems"
          :key="index"
          @click="theme(index)"
        >
          <v-list-tile-title>{{ $t(item.title) }}</v-list-tile-title>
        </v-list-tile>
      </v-list>
    </v-menu>
    <!-- language -->
    <v-menu offset-y>
      <template v-slot:activator="{ on }">
        <v-btn v-on="on" flat>
          {{ $t("Sys.lang") }}
        </v-btn>
      </template>
      <v-list>
        <v-list-tile
          v-for="(item, index) in langItems"
          :key="index"
          @click="lang(index)"
        >
          <v-list-tile-title>{{ item.title }}</v-list-tile-title>
        </v-list-tile>
      </v-list>
    </v-menu>
    <!-- user information -->
    <v-menu offset-y v-if="primaryDrawer.type">
      <template v-slot:activator="{ on }">
        <v-btn icon v-on="on" flat large>
          <v-avatar size="32px" tile>
            <img
              src="https://cdn.vuetifyjs.com/images/logos/logo.svg"
              alt="Vuetify"
            />
          </v-avatar>
        </v-btn>
      </template>
      <v-list>
        <v-list-tile
          v-for="(item, index) in userItems"
          :key="index"
          @click="user(index)"
        >
          <v-list-tile-title>{{ $t(item.title) }}</v-list-tile-title>
        </v-list-tile>
      </v-list>
    </v-menu>

    <v-btn
      flat
      href="https://github.com/vuetifyjs/vuetify/releases/latest"
      target="_blank"
      v-if="!primaryDrawer.type"
    >
      <span class="mr-2">Latest Release</span>
    </v-btn>
    <a
      href="https://github.com/vuetifyjs/vuetify/releases/latest"
      target="_blank"
      class="github-corner"
      aria-label="View source on GitHub"
    >
      <svg
        width="60"
        height="60"
        viewBox="0 0 250 250"
        style="fill:#151513; color:#fff; position: absolute; top: 0; border: 0; right: 0;"
        aria-hidden="true"
      >
        <path d="M0,0 L115,115 L130,115 L142,142 L250,250 L250,0 Z" />
        <path
          d="M128.3,109.0 C113.8,99.7 119.0,89.6 119.0,89.6 C122.0,82.7 120.5,78.6 120.5,78.6 C119.2,72.0 123.4,76.3 123.4,76.3 C127.3,80.9 125.5,87.3 125.5,87.3 C122.9,97.6 130.6,101.9 134.4,103.2"
          fill="currentColor"
          style="transform-origin: 130px 106px;"
          class="octo-arm"
        />
        <path
          d="M115.0,115.0 C114.9,115.1 118.7,116.5 119.8,115.4 L133.7,101.6 C136.9,99.2 139.9,98.4 142.2,98.6 C133.8,88.0 127.5,74.4 143.8,58.0 C148.5,53.4 154.0,51.2 159.7,51.0 C160.3,49.4 163.2,43.6 171.4,40.1 C171.4,40.1 176.1,42.5 178.8,56.2 C183.1,58.6 187.2,61.8 190.9,65.4 C194.5,69.0 197.7,73.2 200.1,77.6 C213.8,80.2 216.3,84.9 216.3,84.9 C212.7,93.1 206.9,96.0 205.4,96.6 C205.1,102.4 203.0,107.8 198.3,112.5 C181.9,128.9 168.3,122.5 157.7,114.1 C157.9,116.9 156.7,120.9 152.7,124.9 L141.0,136.5 C139.8,137.7 141.6,141.9 141.8,141.8 Z"
          fill="currentColor"
          class="octo-body"
        />
      </svg>
    </a>
  </v-toolbar>
</template>
<script>
import Cache from "@/libs/cache";
import UserCenter from "@/components/UserCenter";

export default {
  name: "Header",
  components: { UserCenter },
  data() {
    return {
      themeItems: [{ title: "Sys.dark" }, { title: "Sys.light" }],
      langItems: [{ title: "简体中文" }, { title: "English" }],
      userItems: [{ title: "Sys.personalCenter" }, { title: "Sys.logout" }],
      primaryDrawer: {
        type: true,
        model: true
      },
      dialog: false
    };
  },
  methods: {
    theme(index) {
      let status = index === 0 ? true : false;
      this.$store.commit("changeTheme", status);
    },
    lang(index) {
      let locale = "";
      index === 1 ? (locale = "en") : (locale = "zh");
      this.$i18n.locale = locale;
      Cache.set("lang", locale);
    },
    setModel() {
      this.$data.primaryDrawer.model = !this.$data.primaryDrawer.model;
      this.$emit("changeDrawerModel", this.$data.primaryDrawer.model);
    },
    user(index) {
      if (index === 0) {
        return (this.$data.dialog = true);
      } else {
        this.$api.account.logout().then(() => {
          this.$store.commit("delToken");
          this.$router.push({ path: "/login" });
        });
      }
    },
    close() {
      this.$data.dialog = false;
    }
  },
  props: {
    primaryDrawerType: {
      default: true,
      type: Boolean
    },
    primaryDrawerModel: {
      default: true,
      type: Boolean
    }
  },
  created() {
    this.$data.primaryDrawer.type = this.$props.primaryDrawerType;
  },
  watch: {
    // watch parent component
    primaryDrawerModel: function(val) {
      this.$data.primaryDrawer.model = val;
    }
  }
};
</script>

<style>
.github-corner {
  padding: 10px;
}
</style>
