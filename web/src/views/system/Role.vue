<template>
  <v-card>
    <v-toolbar flat height="64px">
      <v-toolbar-title>{{ $t("App.roleManager") }}</v-toolbar-title>
    </v-toolbar>
    <v-card-title>
      <v-btn color="primary" @click="createRole">
        {{ $t("App.createRole") }}
      </v-btn>
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
      class="elevation-1"
    >
      <template slot="headerCell" slot-scope="props">
        <v-tooltip bottom>
          <template v-slot:activator="{ on }">
            <span v-on="on">
              {{ props.header.text }}
            </span>
          </template>
          <span>
            {{ props.header.text }}
          </span>
        </v-tooltip>
      </template>
      <template v-slot:items="props">
        <td>{{ props.item.role_id }}</td>
        <td class="text-xs-center">{{ props.item.role_name }}</td>
        <td class="text-xs-center">{{ props.item.remark }}</td>
        <td class="text-xs-center">{{ props.item.create_time }}</td>
        <td class="text-xs-center">{{ props.item.update_time }}</td>
        <td class="text-xs-center">
          <a-tag color="orange" @click="setMenus(props)">
            {{ $t("App.menuAuthority") }}
          </a-tag>
          <a-tag color="#108ee9" @click="editRole(props)">{{
            $t("Sys.edit")
          }}</a-tag>
          <a-popconfirm
            placement="topLeft"
            :okText="$t('Sys.yes')"
            :cancelText="$t('Sys.no')"
            @confirm="del(props)"
          >
            <template slot="title">
              <p>{{ $t("Sys.delRoleMsg") }}</p>
            </template>
            <a-tag color="red">{{ $t("Sys.del") }}</a-tag>
          </a-popconfirm>
        </td>
      </template>
    </v-data-table>
    <v-dialog v-model="dialog" persistent max-width="600px">
      <v-card ref="role">
        <v-card-title>
          <span class="headline">{{ title }}</span>
        </v-card-title>
        <v-card-text>
          <v-container grid-list-md>
            <v-layout wrap>
              <v-flex xs12>
                <v-text-field
                  :label="$t('App.roleName')"
                  v-model="role.role_name"
                  ref="role_name"
                  :rules="[rules.required]"
                ></v-text-field>
              </v-flex>
              <v-flex xs12>
                <v-textarea
                  outline
                  :label="$t('Sys.remark')"
                  v-model="role.remark"
                  ref="remark"
                  :rules="[rules.required]"
                ></v-textarea>
              </v-flex>
            </v-layout>
          </v-container>
          <small>{{ $t("Sys.requireMsg") }}</small>
        </v-card-text>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn color="blue darken-1" flat @click="dialog = false"
            >Close</v-btn
          >
          <v-btn color="blue darken-1" flat @click="createOrUpdateRole"
            >Save</v-btn
          >
        </v-card-actions>
      </v-card>
    </v-dialog>
    <MenuTree
      :roleId="meuns.role_id"
      :menuDialog="menuDialog"
      :selectedMenu="meuns.menu_ids"
      @setMenuDialog="setDialogState"
    ></MenuTree>
  </v-card>
</template>
<script>
import MenuTree from "@/components/MenuTree";

export default {
  data() {
    return {
      search: "",
      title: "",
      dialog: false,
      menuDialog: false,
      isCreate: false,
      meuns: {
        role_id: 0,
        menu_ids: []
      },
      role: {
        role_name: "",
        remark: "",
        role_id: 0,
        roleIds: []
      },
      rules: {
        required: value => !!value || "Required."
      },

      desserts: []
    };
  },
  components: { MenuTree },
  methods: {
    init() {
      this.$api.role.get().then(data => {
        this.$data.desserts = data.data;
      });
    },
    editRole(props) {
      this.$data.title = this.$t("App.editRole");
      this.$data.dialog = true;
      this.$data.role = props.item;
    },
    createRole() {
      this.$data.title = this.$t("App.createRole");
      this.$data.dialog = true;
      this.$data.isCreate = true;
      let form = ["role_name", "remark"];
      Object.keys(this.$data.role).forEach(f => {
        if (0 <= form.indexOf(f)) {
          this.$refs[f].reset();
        }
      });
    },
    createOrUpdateRole() {
      if (this.$data.isCreate) {
        // create role
        this.$api.role
          .create({
            role_name: this.$data.role.role_name,
            remark: this.$data.role.remark
          })
          .then(() => {
            this.$notify.success("create success", { timeout: 500 });
            this.$data.isCreate = false;
            this.init();
            this.$data.dialog = false;
          });
      } else {
        // update role
        this.$api.role
          .update(this.$data.role.role_id, {
            role_name: this.$data.role.role_name,
            remark: this.$data.role.remark
          })
          .then(() => {
            this.$notify.success("edit success", { timeout: 500 });
            this.init();
            this.$data.dialog = false;
          });
      }
    },
    del(props) {
      this.$api.role.del(props.item.role_id).then(() => {
        this.init();
      });
    },
    setMenus(props) {
      this.$data.meuns = props.item;
      this.$data.menuDialog = true;
    },
    setDialogState(status) {
      this.$data.menuDialog = status;
    }
  },
  computed: {
    headers() {
      return [
        {
          text: "ID",
          align: "center",
          value: "role_id"
        },
        { text: this.$t("App.roleName"), value: "role_name", align: "center" },
        { text: this.$t("Sys.remark"), value: "remark", align: "center" },
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
        { text: this.$t("Sys.operation"), sortable: false, align: "center" }
      ];
    }
  },
  created() {
    this.init();
  }
};
</script>
