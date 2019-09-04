<template>
  <v-app>
    <v-layout row justify-center>
      <v-dialog v-model="dialog" persistent max-width="600px">
        <v-tabs fixed-tabs v-model="tab">
          <v-tab key="userProfile"
            ><i class="material-icons">
              account_circle
            </i>
            &nbsp;&nbsp;&nbsp;{{ $t("App.userProfile") }}</v-tab
          >
          <v-tab key="editPwd"
            ><i class="material-icons">
              edit
            </i>
            &nbsp;&nbsp;&nbsp;{{ $t("App.editPwd") }}</v-tab
          >
        </v-tabs>
        <v-tabs-items v-model="tab">
          <v-tab-item key="userProfile">
            <v-card>
              <v-card-title>
                <span class="headline">{{ $t("App.userProfile") }}</span>
              </v-card-title>
              <v-form>
                <v-card-text>
                  <v-container grid-list-md>
                    <v-layout wrap>
                      <v-flex xs12>
                        <v-text-field
                          :label="$t('App.nickname')"
                          required
                          v-model="user.nickname"
                        ></v-text-field>
                      </v-flex>
                      <v-flex xs12 sm6>
                        <v-text-field
                          :label="$t('App.email')"
                          required
                          v-model="user.email"
                        ></v-text-field>
                      </v-flex>
                      <v-flex xs12 sm6>
                        <v-text-field
                          :label="$t('App.phone')"
                          type="phone"
                          required
                          v-model="user.phone"
                        ></v-text-field>
                      </v-flex>
                    </v-layout>
                  </v-container>
                  <small>{{ $t("Sys.requireMsg") }}</small>
                </v-card-text>
              </v-form>
              <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn color="blue darken-1" flat @click="close">{{
                  $t("Sys.close")
                }}</v-btn>
                <v-btn color="blue darken-1" flat @click="saveInfo">{{
                  $t("Sys.save")
                }}</v-btn>
              </v-card-actions>
            </v-card>
          </v-tab-item>
          <v-tab-item key="editPwd">
            <v-card>
              <v-card-title>
                <span class="headline">{{ $t("App.editPwd") }}</span>
              </v-card-title>
              <v-form>
                <v-card-text>
                  <v-container grid-list-md>
                    <v-layout wrap>
                      <v-flex xs12>
                        <v-text-field
                          :label="$t('App.newPwd') + '*'"
                          required
                          v-model="edit.newPwd"
                          type="password"
                        ></v-text-field>
                      </v-flex>
                      <v-flex xs12>
                        <v-text-field
                          :label="$t('App.confimPwd') + '*'"
                          required
                          v-model="edit.confimPwd"
                          type="password"
                        ></v-text-field>
                      </v-flex>
                    </v-layout>
                  </v-container>
                  <small>{{ $t("Sys.requireMsg") }}</small>
                </v-card-text>
              </v-form>
              <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn color="blue darken-1" flat @click="close">{{
                  $t("Sys.close")
                }}</v-btn>
                <v-btn color="blue darken-1" flat @click="savePwd">{{
                  $t("Sys.save")
                }}</v-btn>
              </v-card-actions>
            </v-card>
          </v-tab-item>
        </v-tabs-items>
      </v-dialog>
    </v-layout>
  </v-app>
</template>

<script>
export default {
  name: "UserCenter",
  data: () => ({
    tab: null,
    dialog: false,
    user: {
      nickname: "",
      email: "",
      phone: ""
    },
    edit: {
      newPwd: "",
      confimPwd: ""
    }
  }),
  props: {
    setDialog: {
      type: Boolean,
      default: false
    }
  },
  methods: {
    close() {
      this.$data.dialog = false;
      this.$emit("closeDialog");
    },
    saveInfo() {
      this.$api.account.editInfo(this.$data.user).then(() => {
        this.$notify.success("edit success");
        // update local user info
        this.$store.commit("setUserInfo", this.$data.user);
      });
      this.close();
    },
    savePwd() {
      if (
        8 <= this.$data.edit.newPwd.length &&
        this.$data.edit.newPwd === this.$data.edit.confimPwd
      ) {
        this.$api.account.editPwd(this.$data.edit.newPwd).then(() => {
          this.$notify.success("edit success");
          this.$store.commit("delToken");
          this.$router.push({ path: "/login" });
          this.close();
        });
      } else {
        this.$notify.warn(
          "Password length is not 8-20 or Two passwords are different, please check in"
        );
      }
    }
  },
  watch: {
    setDialog: function(val) {
      this.$data.dialog = val;
    }
  },
  created() {
    this.$data.user = this.$store.getters.userInfo;
  }
};
</script>