<template>
  <router-view></router-view>
</template>
<script>
export default {
  name: "App",
  data() {
    return {};
  }
};
</script>
<style lang="stylus" scoped>
@import '../node_modules/nprogress/nprogress.css';

#nprogress .spinner {
  display: none;
}
</style>