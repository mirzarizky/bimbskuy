<template>
  <v-app>
    <app-toolbar />
    <v-content>
      <v-container fluid>
        <img
          alt="logo"
          width="25%"
          src="./assets/logo.png"
        >
      </v-container>
    </v-content>
    <app-footer />
  </v-app>
</template>

<script>
    import toolbar from './components/Toolbar'
    import footer from './components/Footer.vue'

    export default {
        name: "App",
        components: {
            appToolbar: toolbar,
            appFooter: footer
        }
    };
</script>

