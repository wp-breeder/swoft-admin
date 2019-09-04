<template>
  <v-app id="inspire" :dark="theme">
    <Header :primaryDrawerType="primaryDrawerType"></Header>
    <v-content>
      <v-container fluid fill-height>
        <v-layout align-center justify-center>
          <v-flex xs12 sm8 md4>
            <v-card class="elevation-12">
              <v-toolbar dark color="grey">
                <v-toolbar-title> {{ $t("Sys.loginForm") }} </v-toolbar-title>
              </v-toolbar>
              <v-card-text>
                <v-form>
                  <v-text-field
                    prepend-icon="person"
                    name="login"
                    :label="$t('Sys.account') + '*'"
                    type="text"
                    v-model="loginForm.identity"
                    required
                  ></v-text-field>
                  <v-text-field
                    id="password"
                    prepend-icon="lock"
                    name="password"
                    :label="$t('Sys.password') + '*'"
                    type="password"
                    v-model="loginForm.credential"
                    required
                  ></v-text-field>
                </v-form>
              </v-card-text>
              <v-card-actions>
                <small>{{ $t("Sys.requireMsg") }}</small>
                <v-spacer></v-spacer>
                <v-btn color="grey" @click="login" :loading="loading">{{
                  $t("Sys.login")
                }}</v-btn>
              </v-card-actions>
            </v-card>
          </v-flex>
        </v-layout>
      </v-container>
    </v-content>
    <Footer />
  </v-app>
</template>

<script>
import Header from "@/components/Header";
import Footer from "@/components/Footer";
import axios from "axios";

export default {
  data: () => ({
    dark: false,
    drawer: null,
    primaryDrawerType: false,
    loginForm: {
      identity: "test",
      credential: "00000000"
    },
    loading: false
  }),
  components: { Header, Footer },
  computed: {
    theme() {
      return this.$store.state.dark;
    }
  },
  methods: {
    login() {
      this.$data.loading = true;
      if (this.loginForm.identity === "" || this.loginForm.credential === "") {
        this.$notify.err("Account or password cannot be empty");
        this.$data.loading = false;
        return;
      }

      this.$api.account
        .getToken(this.loginForm.identity, this.loginForm.credential)
        .then(data => {
          // set token to store
          this.$store.commit("setToken", data.data);
          // get menus by user
          axios
            .all([this.$api.account.getMenus(), this.$api.account.getInfo()])
            .then(
              axios.spread((menus, userInfo) => {
                // 存储 菜单信息 和 用户信息
                this.$store.commit("setMenus", menus.data);
                this.$store.commit("setUserInfo", userInfo.data);
                this.$router.push({ path: "/" });
              })
            );
        })
        .catch(() => {
          this.$data.loading = false;
        });
    }
  }
};
</script>