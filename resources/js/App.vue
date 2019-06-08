<template>
  <div>
    <template v-if="!$route.meta.public">
      <app-layout />
    </template>
    <template v-else>
      <transition>
        <keep-alive>
          <router-view />
        </keep-alive>
      </transition>
    </template>
  </div>
</template>

<script>
  import appLayout from "@/layouts/App.vue"

  export default {
      name: "App",
    metaInfo: {
      // if no subcomponents specify a metaInfo.title, this title will be used
      title: 'Bimbskuy App',
      // all titles will be injected into this template
      titleTemplate: '%s | Bimbskuy App'
    },
    components: {
      appLayout
    }
  };
</script>
