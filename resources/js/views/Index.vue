<template>
  <app-layout>
    <v-container fluid>
      <v-layout row wrap>
        <v-flex xs12 lg10 class="hidden-sm-and-down mx-auto">
          <v-card flat color="accent" class="pa-3 white--text">
            <v-layout row justify-space-between fill-height>
              <v-flex xs7>
                <v-card-text class="mb-5">
                  <div>
                    <div class="headline font-weight-bold">
                      Avengers!
                    </div>
                    <span>Allright whatever it takes, online and offline.</span>
                  </div>
                </v-card-text>
              </v-flex>
              <v-flex xs5 class="pa-0 ma-0">
                <v-img
                  src="~@/assets/undraw_super_thank_you_obwk.png"
                  alt="Image"
                  height="196"
                  contain
                />
              </v-flex>
            </v-layout>
            <v-card-actions>
              <v-btn depressed>
                Assemble
              </v-btn>
            </v-card-actions>
          </v-card>
        </v-flex>
      </v-layout>
    </v-container>
  </app-layout>
</template>

<script>
import appLayout from "@/layouts/Default.vue";

export default {
  components: {
    appLayout,
  },
};
</script>
