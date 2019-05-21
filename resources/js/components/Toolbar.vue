<template>
  <v-card flat>
    <v-toolbar
      color="grey darken-3"
      dark
      extended
      flat
    >
      <v-toolbar-title class="white--text">
        Title
      </v-toolbar-title>
    </v-toolbar>

    <v-layout
      row
      class="mx-5"
    >
      <v-flex xs6>
        <v-card
          round
          class="card--flex-toolbar"
        >
          <v-divider />

          <v-card-text style="height: 200px;" />
        </v-card>
      </v-flex>
    </v-layout>
  </v-card>
</template>

<script>
    export default {
        name: "Toolbar"
    };
</script>


<style scoped>
  .card--flex-toolbar {
    margin-top: -64px;
  }
</style>