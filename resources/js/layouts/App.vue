<template>
  <v-app>
    <app-toolbar />
    <v-content>
      <router-view />
    </v-content>
    <app-footer />
  </v-app>
</template>

<script>
  import appToolbar from "@/components/AppToolbar.vue"
  import appFooter from "@/components/Footer.vue"

  export default {
    components: {
      appToolbar,
      appFooter
    }
  };
</script>