<template>
  <v-snackbar
    v-model="state.snackbar"
    :bottom="state.y === 'bottom'"
    :color="state.msgType.color"
    :left="state.x === 'left'"
    :multi-line="state.mode === 'multi-line'"
    :right="state.x === 'right'"
    :timeout="state.timeout"
    :top="state.y === 'top'"
    :vertical="state.mode === 'vertical'"
  >
    <i class="material-icons" style="padding-right:10px">
      {{ state.msgType.sentiment }}
    </i>
    {{ state.msg }}
    <v-btn dark class="v-btn--flat v-btn--text" @click="state.snackbar = false">
      {{ state.close }}
    </v-btn>
  </v-snackbar>
</template>
<script>
export default {
  name: "Notify",
  data() {
    return {
      state: {
        msgType: {
          sentiment: "sentiment_satisfied",
          color: "blue"
        },
        mode: "",
        snackbar: true,
        msg: "content",
        close: "Close",
        timeout: 3000,
        x: null,
        y: "top"
      }
    };
  },
  methods: {
    commit: function(state) {
      this.$data.state = Object.assign(this.$data.state, state);
    }
  }
};
</script>
<style scoped>
.v-snack__content {
  width: auto !important;
  margin: 0 auto !important;
}
</style>  
