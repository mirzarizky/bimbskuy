<template>
  <v-container
    fluid
  >
    <v-layout
      justify-center
      align-center
      row
      wrap
    >
      <v-flex
        sm6
        lg3
        class="mx-auto"
      >
        <v-card>
          <v-card-text>
            <div class="layout row ma-0 align-center justify-space-between">
              <div class="text-box">
                <div class="subheading pb-2">
                  Bounce Rate
                </div>
                <span class="grey--text">-10%
                  <v-icon
                    small
                    color="green"
                  >trending_down</v-icon>
                </span>
              </div>
              <div class="chart">
                <v-progress-circular
                  :size="60"
                  :width="5"
                  :rotate="360"
                  :value="10"
                  color="success"
                >
                  10
                </v-progress-circular>
              </div>
            </div>
          </v-card-text>
        </v-card>
      </v-flex>
      <v-flex
        sm6
        lg3
      >
        <v-card>
          <v-card-text>
            <div class="layout row ma-0 align-center justify-space-between">
              <div class="text-box">
                <div class="subheading pb-2">
                  Bounce Rate
                </div>
                <span class="grey--text">-10%
                  <v-icon
                    small
                    color="green"
                  >trending_down</v-icon>
                </span>
              </div>
              <div class="chart">
                <v-progress-circular
                  :size="60"
                  :width="5"
                  :rotate="360"
                  :value="10"
                  color="success"
                >
                  10
                </v-progress-circular>
              </div>
            </div>
          </v-card-text>
        </v-card>
      </v-flex>
    </v-layout>
  </v-container>
</template>

<script>
  export default {

  };
</script>