<template>
  <v-footer :inset="footer.inset" app>
      <span class="px-3">Copyright &copy; {{ new Date().getFullYear() }} SWOFT-ADMIN All rights reserved</span>
    </v-footer>
</template>

<script>
export default {
  name: "Footer",
  data: () => ({
    footer: {
      inset: true
    }
  })
};
</script>

