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
      components: {
        appLayout
      }
  };
</script>
