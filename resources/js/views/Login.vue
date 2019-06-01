<template>
  <v-app
    id="login"
    class="primary"
  >
    <v-content>
      <v-container
        fluid
        fill-height
      >
        <v-layout
          align-center
          justify-center
        >
          <v-flex
            xs12
            sm8
            md4
            lg4
          >
            <v-card class="elevation-1 pa-3">
              <v-card-text>
                <div class="layout column align-center">
                  <img
                    src="../assets/logo.png"
                    alt="Vue Material Admin"
                    width="120"
                    height="120"
                  >
                  <h1 class="flex my-4 primary--text">
                    Please Login
                  </h1>
                </div>
                <v-form>
                  <v-text-field
                    v-model="model.username"
                    append-icon="person"
                    name="login"
                    label="Email"
                    type="text"
                  />
                  <v-text-field
                    id="password"
                    v-model="model.password"
                    append-icon="lock"
                    name="password"
                    label="Password"
                    type="password"
                  />
                </v-form>
              </v-card-text>
              <v-card-actions>
                <v-spacer />
                <v-btn
                  block
                  flat
                  color="primary"
                  :loading="loading"
                  @click="login"
                >
                  Daftar
                </v-btn>
                <v-btn
                  block
                  color="primary"
                  :loading="loading"
                  @click="login"
                >
                  Login
                </v-btn>
              </v-card-actions>
            </v-card>
          </v-flex>
        </v-layout>
      </v-container>
    </v-content>
  </v-app>
</template>

<script>
  export default {
    data: () => ({
      loading: false,
      model: {
        username: 'admin@isockde.com',
        password: 'password'
      }
    }),

    methods: {
      login () {
        this.loading = true;
        setTimeout(() => {
          this.$router.push('/dashboard');
        }, 1000);
      }
    }

  };
</script>
<style scoped lang="css">
  #login {
    height: 50%;
    width: 100%;
    position: absolute;
    top: 0;
    left: 0;
    content: "";
    z-index: 0;
  }
</style>