<template>
  <v-card>
    <v-toolbar flat height="64px">
      <v-toolbar-title>{{ $t("App.userManager") }}</v-toolbar-title>
    </v-toolbar>
    <v-card-title>
      <v-btn color="primary" @click="createUser">{{
        $t("App.createUser")
      }}</v-btn>
      <v-spacer></v-spacer>
      <v-text-field
        v-model="search"
        append-icon="search"
        :label="$t('Sys.search')"
        single-line
        hide-details
      ></v-text-field>
    </v-card-title>
    <v-data-table
      :headers="headers"
      :items="desserts"
      :search="search"
      :rows-per-page-text="$t('App.perPageText')"
    >
      <template v-slot:items="props">
        <td>{{ props.item.uid }}</td>
        <td class="text-xs-center">{{ props.item.nickname }}</td>
        <td class="text-xs-center">{{ props.item.login_name }}</td>
        <td class="text-xs-center">{{ props.item.phone }}</td>
        <td class="text-xs-center">{{ props.item.email }}</td>
        <td class="text-xs-center">{{ props.item.create_time }}</td>
        <td class="text-xs-center">{{ props.item.update_time }}</td>
        <td class="text-xs-center">
          <a-switch
            v-model="props.item.status"
            :checkedChildren="$t('Sys.enable')"
            :unCheckedChildren="$t('Sys.disable')"
            @change="setState(props)"
          ></a-switch>
        </td>
        <td class="text-xs-center">
          <a-tag color="#108ee9" @click="editUser(props)">{{
            $t("Sys.edit")
          }}</a-tag>
          <a-popconfirm
            placement="topLeft"
            :okText="$t('Sys.yes')"
            :cancelText="$t('Sys.no')"
            @confirm="resetPwd(props)"
          >
            <template slot="title">
              <p>{{ $t("Sys.resetPwdMsg") }}</p>
            </template>
            <a-tag color="orange">{{ $t("Sys.resetPwd") }}</a-tag>
          </a-popconfirm>
        </td>
      </template>
    </v-data-table>
    <v-dialog v-model="dialog" persistent max-width="600px">
      <v-card ref="user">
        <v-card-title>
          <span class="headline">{{ $t("App.userProfile") }}</span>
        </v-card-title>
        <v-card-text>
          <v-container grid-list-md>
            <v-layout wrap>
              <v-flex xs12>
                <v-text-field
                  ref="nickname"
                  :label="$t('App.nickname') + '*'"
                  v-model="user.nickname"
                  :rules="[rules.required]"
                ></v-text-field>
              </v-flex>
              <v-flex xs12>
                <v-text-field
                  :label="$t('App.email') + '*'"
                  ref="email"
                  v-model="user.email"
                  type="email"
                  :rules="[rules.required]"
                ></v-text-field>
              </v-flex>
              <v-flex xs12>
                <v-text-field
                  :label="$t('App.phone') + '*'"
                  ref="phone"
                  v-model="user.phone"
                  type="phone"
                  :rules="[rules.required]"
                ></v-text-field>
              </v-flex>
              <v-flex xs12>
                <v-autocomplete
                  v-model="role_ids"
                  :items="roles"
                  item-text="role_name"
                  item-value="role_id"
                  :label="$t('App.role')"
                  chips
                  clearable
                  multiple
                  deletable-chips
                  required
                ></v-autocomplete>
              </v-flex>
              <v-flex xs12>
                <v-text-field
                  :label="$t('App.identity') + '*'"
                  required
                  v-if="isCreate"
                  :rules="[rules.required]"
                  ref="identity"
                  v-model="addUser.identity"
                ></v-text-field>
              </v-flex>
              <v-flex xs12>
                <v-text-field
                  :label="$t('App.credential') + '*'"
                  v-model="addUser.credential"
                  :rules="[
                    rules.required,
                    () => addUser.credential.length >= 8 || 'Min 8 characters'
                  ]"
                  :append-icon="show ? 'visibility' : 'visibility_off'"
                  :type="show ? 'text' : 'password'"
                  v-if="isCreate"
                  ref="credential"
                  @click:append="show = !show"
                ></v-text-field>
              </v-flex>
            </v-layout>
          </v-container>
          <small>{{ $t("Sys.requireMsg") }}</small>
        </v-card-text>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn color="blue darken-1" flat @click="close">{{
            $t("Sys.close")
          }}</v-btn>
          <v-btn color="blue darken-1" flat @click="createOrUpdateUser">{{
            $t("Sys.save")
          }}</v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
  </v-card>
</template>
<script>
import axios from "axios";

export default {
  data() {
    return {
      search: "",
      show: "",
      dialog: false,
      isCreate: false,
      roles: [],
      rules: {
        required: value => !!value || "Required."
      },
      role_ids: [],
      user: {
        nickname: "",
        email: "",
        phone: ""
      },
      addUser: {
        identity: "",
        credential: ""
      },
      desserts: []
    };
  },
  computed: {
    headers() {
      return [
        {
          text: "ID",
          align: "center",
          value: "uid"
        },
        { text: this.$t("App.nickname"), value: "nickname", align: "center" },
        { text: this.$t("App.identity"), value: "login_name", align: "center" },
        { text: this.$t("App.phone"), value: "phone", align: "center" },
        { text: this.$t("App.email"), value: "email", align: "center" },
        {
          text: this.$t("Sys.createTime"),
          value: "create_time",
          align: "center"
        },
        {
          text: this.$t("Sys.updateTime"),
          value: "update_time",
          align: "center"
        },
        { text: this.$t("App.userStatus"), value: "status", align: "center" },
        { text: this.$t("Sys.operation"), sortable: false, align: "center" }
      ];
    }
  },
  methods: {
    init() {
      axios.all([this.$api.user.get(), this.$api.role.get()]).then(
        axios.spread((users, roles) => {
          this.$data.desserts = users.data.map(v => {
            v.status = !!v.status;
            return v;
          });
          this.$data.roles = roles.data;
        })
      );
    },
    setState(props) {
      let status = props.item.status ? 1 : 0;
      this.$api.user.setState(props.item.uid, status).then(() => {
        this.$notify.success("edit success", { timeout: 500 });
      });
    },
    editUser(props) {
      this.$api.user.getUserById(props.item.uid).then(data => {
        this.$data.user = data.data;
        this.$data.role_ids = data.data.role_ids;
        this.$data.dialog = true;
      });
    },
    resetPwd(props) {
      this.$api.user.resetPwd(props.item.uid).then(() => {
        this.$notify.success("reset password success", { timeout: 500 });
      });
    },
    createOrUpdateUser() {
      this.$data.user.role_ids = this.$data.role_ids.join(",");
      if (this.$data.isCreate) {
        let userInfo = Object.assign({}, this.$data.user, this.$data.addUser);
        this.$api.user.createUser(userInfo).then(() => {
          this.$data.isCreate = false;
          this.$api.user.get().then(data => {
            this.$data.desserts = data.data;
          });
          this.$notify.success("create success", { timeout: 500 });
        });
      } else {
        this.$api.user
          .editUser(this.$data.user.uid, this.$data.user)
          .then(() => {
            this.$notify.success("edit success", { timeout: 500 });
          });
      }
      this.dialog = false;
    },
    createUser() {
      let form = ["nickname", "email", "phone"];
      Object.keys(this.$data.user).forEach(f => {
        if (0 <= form.indexOf(f)) {
          this.$refs[f].reset();
        }
      });
      this.$data.role_ids = [];
      this.$data.isCreate = true;
      this.$data.dialog = true;
    },
    close() {
      if (this.$data.isCreate) {
        this.$data.isCreate = false;
      }
      this.$data.dialog = false;
    }
  },
  created() {
    this.init();
  }
};
</script>
