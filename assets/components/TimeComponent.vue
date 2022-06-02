<template>
  <div>
    <button type="button" class="btn btn-danger my-button">{{ time }}</button>
  </div>
</template>
<script>
export default {
  name: "time-component",
  props: ["start"],
  data() {
    return {
      timer: null,
      time: 10,
    };
  },
  mounted() {
    this.timer = setInterval(this.countdown, 1000);
  },
  methods: {
    countdown() {
      console.log(props);
      this.time--;
      if (this.time == 0) {
        clearInterval(this.timer);
      }
    },
  },
  beforeDestroy() {
    clearInterval(this.timer);
  },
};
</script>
<style scoped>
</style>