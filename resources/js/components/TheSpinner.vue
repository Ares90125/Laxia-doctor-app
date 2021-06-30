<template>
  <div class="vue-ios-picker" style="display: block;">
    <div class="picker-mask show" v-if="!white"></div>
    <div class="picker-panel show">
        <div class="d-flex justify-content-center">
            <Spinner size="large"></Spinner>
        </div>
    </div>
  </div>
</template>

<script>
import Spinner from 'vue-simple-spinner'

export default {
  name: "TheSpinner",
  
  components: {
    Spinner
  },

  props: [
    'white'
  ],

  data () {
    return {
      loading: true,
      // color: "green",
      size: "10"
    }
  },

  beforeDestroy() {
    const el = document.body;
    el.classList.remove('no-scroll');
  },

  mounted() {
    const el = document.body;
    el.classList.add('no-scroll');
  },
}
</script>

<style lang="scss" scoped>
@mixin unselectable() {
  -moz-user-select: none;
  -webkit-user-select: none;
  -ms-user-select: none;
  user-select: none;
}

.vue-ios-picker {
  display: none;
  position: fixed;
  top: 0;
  left: 0;
  z-index: 100;
  width: 100%;
  height: 100%;
  overflow: hidden;
  text-align: center;
  font-family: 'PingFang SC', 'STHeitiSC-Light', 'Helvetica-Light', arial, sans-serif, 'Droid Sans Fallback';
  font-size: 14px;
  z-index: 99999;
  @include unselectable();
  .picker-mask {
    position: absolute;
    z-index: 500;
    width: 100%;
    height: 100%;
    transition: all 0.5s;
    -webkit-transition: all 0.5s;
    background: rgba(0, 0, 0, 0);
    background: rgba(0, 0, 0, 0.4);
    opacity: 0;

    &.show {
      background: rgba(0, 0, 0, 0.6);
      opacity: 1;
    }
  }
  .picker-panel {
    position: absolute;
    z-index: 600;
    bottom: calc(50vh - 16px);
    left: 0;
    width: 100%;
    transition: all 0.5s;
    -webkit-transition: all 0.5s;
    &.show {
      transform: translateY(0);
      -webkit-transform: translateY(0);
    }
  }
}
</style>