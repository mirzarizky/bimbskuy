<template>
  <file-pond
    ref="pond"
    name="test"
    class-name="my-pond"
    label-idle="Drop files here..."
    accepted-file-types="image/jpeg, image/png"
    :files="myFiles"
    @init="handleFilePondInit"
  />
</template>

<script>
  import vueFilePond from 'vue-filepond';

  // import FilePondPluginFileValidateType from 'filepond-plugin-file-validate-type/dist/filepond-plugin-file-validate-type.esm.js';
  // import FilePondPluginImagePreview from 'filepond-plugin-image-preview/dist/filepond-plugin-image-preview.esm.js';

  // Import styles
  // import 'filepond/dist/filepond.min.css';
  // import '~filepond-plugin-image-preview/dist/filepond-plugin-image-preview.min.css';

  // Create FilePond component
  const FilePond = vueFilePond();

  export default {
    name: 'App',
    components: {
      FilePond
    },
    data: function() {
      return { myFiles: "" };
    },
    methods: {
      handleFilePondInit: function() {
        console.log('FilePond has initialized');

        // example of instance method call on pond reference
        this.$refs.pond.getFiles();
      }
    }
  };
</script>

<style scoped lang="scss">
  @import '~filepond/dist/filepond.min.css';
  /*@import '~filepond-plugin-image-preview/dist/filepond-plugin-image-preview.min.css';*/
</style>