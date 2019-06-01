<template>
  <v-toolbar
    flat
    dark
    card
  >
    <v-avatar class="hidden-sm-and-down">
      <img
        src="../assets/logo.png"
        alt="Logo"
      >
    </v-avatar>
    <v-spacer />
    <!--<v-text-field-->
    <!--flat-->
    <!--solo-inverted-->
    <!--prepend-icon="search"-->
    <!--label="What are you looking for?"-->
    <!--class="hidden-sm-and-down my-0 py-0"-->
    <!--/>-->
    <v-btn icon>
      <v-icon>notifications</v-icon>
    </v-btn>
    <v-menu
      offset-y
      origin="center center"
      :nudge-bottom="10"
      transition="scale-transition"
    >
      <v-btn
        slot="activator"
        icon
        large
        flat
      >
        <v-avatar size="32px">
          <img src="https://randomuser.me/api/portraits/men/1.jpg">
        </v-avatar>
      </v-btn>
      <v-list class="pa-0">
        <v-list-tile
          to="/profile"
          ripple="ripple"
          rel="noopener"
          @click="goToProfile"
        >
          <v-list-tile-action>
            <v-icon>account_circle</v-icon>
          </v-list-tile-action>
          <v-list-tile-content>
            <v-list-tile-title>Profile</v-list-tile-title>
          </v-list-tile-content>
        </v-list-tile>
        <v-list-tile
          to="/settings"
          ripple="ripple"
          rel="noopener"
          @click="goToSettings"
        >
          <v-list-tile-action>
            <v-icon>settings</v-icon>
          </v-list-tile-action>
          <v-list-tile-content>
            <v-list-tile-title>Pengaturan</v-list-tile-title>
          </v-list-tile-content>
        </v-list-tile>
        <v-list-tile
          to="/settings"
          ripple="ripple"
          rel="noopener"
          @click="logout"
        >
          <v-list-tile-action>
            <v-icon>fullscreen_exit</v-icon>
          </v-list-tile-action>
          <v-list-tile-content>
            <v-list-tile-title>Logout</v-list-tile-title>
          </v-list-tile-content>
        </v-list-tile>
      </v-list>
    </v-menu>
  </v-toolbar>
</template>

<script>
  export default {
    data: () => ({

    }),
    methods: {
      logout() {
        this.$router.push("/");
      },
      goToProfile() {
        this.$router.push('/profile');
      },
      goToSettings() {
        this.$router.push('/settings');
      }
    }
  };
</script>