<template>
  <v-app>
    <app-toolbar />
    <v-content>
      <slot />
    </v-content>
    <app-footer />
  </v-app>
</template>

<script>
  import appToolbar from "@/components/DefaultToolbar.vue"
  import appFooter from "@/components/Footer.vue"

  export default {
    components: {
      appToolbar,
      appFooter
    },
  };
</script>