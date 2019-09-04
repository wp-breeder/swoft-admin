<template>
  <v-card>
    <v-toolbar flat height="64px">
      <v-toolbar-title>{{ $t("App.menuManager") }}</v-toolbar-title>
    </v-toolbar>
    <v-card-title>
      <v-btn color="primary" @click="props.dialog = true">
        {{ $t("App.addMenu") }}
      </v-btn>
    </v-card-title>
    <a-table
      :pagination="pagination"
      :columns="columns"
      :dataSource="data"
      :rowKey="rowKey"
      :footer="footer"
    >
      <span slot="icon" slot-scope="text">
        <v-icon>{{ text }}</v-icon>
      </span>
      <span slot="menu_type" slot-scope="text">
        <a-tag v-if="text === 0" color="cyan">{{ $t("Sys.folder") }}</a-tag>
        <a-tag v-else-if="text === 1" color="blue">{{ $t("Sys.menu") }}</a-tag>
        <a-tag v-else>{{ $t("Sys.button") }}</a-tag>
      </span>
      <span slot="status" slot-scope="text, record">
        <a-switch
          v-model="record.status"
          :checkedChildren="$t('Sys.enable')"
          :unCheckedChildren="$t('Sys.disable')"
          @change="setState(record)"
        ></a-switch>
      </span>
      <span slot="operation" slot-scope="text, record">
        <a-tag @click="editMenu(record)"> {{ $t("Sys.edit") }} </a-tag>
        <a-popconfirm
          placement="topLeft"
          :okText="$t('Sys.yes')"
          :cancelText="$t('Sys.no')"
          @confirm="del(record)"
        >
          <template slot="title">
            <p>{{ $t("Sys.delMenuMsg") }}</p>
          </template>
          <a-tag color="red">{{ $t("Sys.del") }}</a-tag>
        </a-popconfirm>
      </span>
    </a-table>
    <MenuForm
      :dialog="props.dialog"
      :menus="props.menus"
      :resources="props.resources"
      :pMenu="props.menu"
      @setState="setDialogState"
    ></MenuForm>
  </v-card>
</template>
<script>
// FIXME: upgrade treetable in vuetify-2.X
import { genTree } from "@/libs/util";
import axios from "axios";
import MenuForm from "@/components/MenuForm";

export default {
  data() {
    return {
      data: [],
      rowKey: record => record.menu_id,
      pagination: false,
      expandedRowKeys: [],
      props: {
        menus: [],
        resources: [],
        dialog: false,
        menu: {}
      },
      footer: () => ""
    };
  },
  components: { MenuForm },
  computed: {
    columns() {
      return [
        {
          title: this.$t("App.menuName"),
          dataIndex: "menu_name"
        },
        {
          title: this.$t("App.menuIcon"),
          dataIndex: "icon",
          key: "icon",
          width: "12%",
          scopedSlots: { customRender: "icon" }
        },
        {
          title: this.$t("App.menuPath"),
          dataIndex: "path",
          width: "12%",
          key: "path"
        },
        {
          title: this.$t("App.menuRouter"),
          dataIndex: "router",
          width: "12%",
          key: "router"
        },
        {
          title: this.$t("App.menuType"),
          dataIndex: "menu_type",
          width: "12%",
          key: "menu_type",
          scopedSlots: { customRender: "menu_type" }
        },
        {
          title: this.$t("App.menuStatus"),
          dataIndex: "status",
          width: "12%",
          key: "status",
          scopedSlots: { customRender: "status" }
        },
        {
          title: this.$t("Sys.updateTime"),
          dataIndex: "update_time",
          width: "12%",
          key: "update_time"
        },
        {
          title: this.$t("Sys.operation"),
          dataIndex: "operation",
          key: "operation",
          scopedSlots: { customRender: "operation" }
        }
      ];
    }
  },
  methods: {
    init() {
      axios.all([this.$api.menu.get(), this.$api.resource.get()]).then(
        axios.spread((menuList, resources) => {
          // init menus
          this.$data.props.menus = JSON.parse(JSON.stringify(menuList.data));
          let menus = menuList.data.map(v => {
            v.status = !!v.status;
            return v;
          });
          this.$data.data = genTree(menus);
          // init resource
          this.$data.props.resources = resources.data.map(val => {
            return {
              resource: val.resource_name + ":" + val.perm,
              resource_id: val.resource_id
            };
          });
        })
      );
    },
    setState(props) {
      this.$api.menu.setState(props.menu_id, Number(props.status)).then(() => {
        this.$notify.success("edit success", { timeout: 500 });
      });
    },
    del(props) {
      this.$api.menu.del(props.menu_id).then(() => {
        this.init();
        this.$notify.success("delete success", { timeout: 500 });
      });
    },
    editMenu(record) {
      this.$data.props.dialog = true;
      this.$data.props.menu = Object.assign({}, record, {
        status: Number(record.status)
      });
    },
    setDialogState() {
      this.$data.props.dialog = false;
    }
  },
  created() {
    this.init();
  }
};
</script>
