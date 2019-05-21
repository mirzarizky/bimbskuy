<template>
  <v-footer
    height="auto"
    color="grey darken-3"
  >
    <v-layout
      row
      wrap
    >
      <v-btn
        v-for="link in links"
        :key="link"
        color="white"
        flat
        small
      >
        {{ link }}
      </v-btn>
      <v-flex
        py-2
        ml-4
        text-xs
        white--text
        xs12
      >
        &copy; 2019 —
        <strong>Vuetify</strong>
      </v-flex>
    </v-layout>
  </v-footer>
</template>

<script>
    export default {
        name: "Footer",
        data: () => ({
            links: ["Docs", "About", "Contact"]
        })
    };
</script>