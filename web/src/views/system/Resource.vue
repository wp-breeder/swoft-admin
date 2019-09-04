<template>
  <div>
    <v-card>
      <v-toolbar flat height="64px">
        <v-toolbar-title>{{ $t("App.resourceManager") }}</v-toolbar-title>
      </v-toolbar>
      <v-card-title>
        <v-btn color="primary" @click="fresh">{{
          $t("App.freshResource")
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
        class="elevation-1"
      >
        <template v-slot:items="props">
          <td>{{ props.item.resource_id }}</td>
          <td class="text-xs-right">{{ props.item.resource_name }}</td>
          <td class="text-xs-right">{{ props.item.method }}</td>
          <td class="text-xs-right">{{ props.item.mapping }}</td>
          <td class="text-xs-right" v-if="props.item.auth_type === 1">
            <a-tag color="blue" text-color="white">{{
              $t("App.isLogin")
            }}</a-tag>
          </td>
          <td class="text-xs-right" v-else-if="props.item.auth_type === 2">
            <a-tag color="green" text-color="white">{{
              $t("App.openAuthority")
            }}</a-tag>
          </td>
          <td class="text-xs-right" v-else-if="props.item.auth_type === 3">
            <a-tag color="orange" text-color="white">{{
              $t("App.isAuthority")
            }}</a-tag>
          </td>
          <td class="text-xs-right">{{ props.item.perm }}</td>
          <td class="text-xs-right">{{ props.item.update_time }}</td>
        </template>
      </v-data-table>
    </v-card>
  </div>
</template>
<script>
export default {
  data() {
    return {
      search: "",
      desserts: []
    };
  },
  methods: {
    init() {
      // init resource
      this.$api.resource.get().then(data => {
        this.$data.desserts = data.data;
      });
    },
    fresh() {
      this.$api.resource.fresh().then(() => {
        this.init();
        this.$notify.success("fresh success");
      });
    }
  },
  computed: {
    headers() {
      return [
        {
          text: "ID",
          align: "left",
          sortable: false,
          value: "resource_id"
        },
        {
          text: this.$t("App.resourceName"),
          value: "resource_name"
        },
        { text: this.$t("App.method"), value: "method", sortable: false },
        { text: this.$t("App.pathMapping"), value: "mapping", sortable: false },
        { text: this.$t("App.authType"), value: "auth_type" },
        { text: this.$t("App.perm"), value: "perm", sortable: false },
        { text: this.$t("Sys.updateTime"), value: "update_time" }
      ];
    }
  },
  created() {
    this.init();
  }
};
</script>