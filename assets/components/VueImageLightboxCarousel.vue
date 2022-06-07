<template>
  <div
    id="my-strictly-unique-vue-image-lightbox-carousel"
    style="text-align: center"
  >
    <a @click="openLightbox">
      <img class="custom-image" :src="myImage[0].path" alt="Avatar" />
    </a>

    <vue-image-lightbox-carousel
      ref="lightbox"
      :show="showLightbox"
      @close="showLightbox = false"
      :images="myImage"
      @change="changeImage"
    >
    </vue-image-lightbox-carousel>
  </div>
</template>

<script>
import VueImageLightboxCarousel from "vue-image-lightbox-carousel";

export default {
  name: "app",
  props: {
    images: {
      required: true,
    },
  },
  data() {
    return {
      showLightbox: false,
    };
  },
  components: {
    VueImageLightboxCarousel,
  },
  methods: {
    openLightbox() {
      this.showLightbox = true;
      this.$refs.lightbox.showImage(1);
    },
    changeImage(index) {
      if (index + 1 == Object.keys(this.myImage).length) {
        setTimeout((this.showLightbox = false), 20000);
      }
    },
  },
  computed: {
    myImage: function () {
      return JSON.parse(this.images);
    },
  },
};
</script>
<style lang="css" scoped>
#app {
  font-family: "Avenir", Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
  margin-top: 60px;
}

.vue-lightbox-modal-image {
  padding-top: 150px;
}
.modal-mask {
  padding-top: 70px;
}
.custom-image {
  max-width: 40%;
}
</style>
