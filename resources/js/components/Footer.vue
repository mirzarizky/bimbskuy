<template>
  <v-footer height="auto">
    <v-layout
      wrap
    >
      <v-flex
        xs12
      >
        <v-card
          flat
          tile
          class="primary lighten-1 white--text text-xs-center"
        >
          <v-card-text
            class="py-0 my-0"
          >
            <v-btn
              v-for="link in links"
              :key="link"
              class="mx-3 white--text"
              flat
              small
            >
              {{ link }}
            </v-btn>
          </v-card-text>
          <!--<v-card-text class="white&#45;&#45;text pt-0">-->
          <!--Phasellus feugiat arcu sapien, et iaculis ipsum elementum sit amet. Mauris cursus commodo interdum. Praesent ut risus eget metus luctus accumsan id ultrices nunc. Sed at orci sed massa consectetur dignissim a sit amet dui. Duis commodo vitae velit et faucibus. Morbi vehicula lacinia malesuada. Nulla placerat augue vel ipsum ultrices, cursus iaculis dui sollicitudin. Vestibulum eu ipsum vel diam elementum tempor vel ut orci. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.-->
          <!--</v-card-text>-->
          <v-card-text class=" white--text my-0">
            &copy;2019 — <strong>Vuetify</strong>
          </v-card-text>
        </v-card>
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