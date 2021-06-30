<template>
  <div id="app">
    <loading ref="loading" />

    <transition name="page" mode="out-in">
      <component :is="layout" v-if="layout" />
    </transition>
  </div>
</template>

<script>
import Loading from './Loading'
import Spinner from 'vue-simple-spinner'

// Load layout components dynamically.
const requireContext = require.context('~/layouts', false, /.*\.vue$/)

const layouts = requireContext.keys()
  .map(file =>
    [file.replace(/(^.\/)|(\.vue$)/g, ''), requireContext(file)]
  )
  .reduce((components, [name, component]) => {
    components[name] = component.default || component
    return components
  }, {})

export default {
  el: '#app',

  components: {
    Loading,
    Spinner
  },

  data: () => ({
    layout: null,
    defaultLayout: 'default',
    window: {
      width: 0,
      height: 0
    }
  }),

  created() {
    window.addEventListener('resize', this.handleResize)
    this.handleResize()
  },

  metaInfo () {
    const { appName } = window.config

    return {
      title: appName,
      titleTemplate: `%s · ${appName}`
    }
  },

  mounted () {
    this.$loading = this.$refs.loading
  },

  methods: {
    /**
     * Set the application layout.
     *
     * @param {String} layout
     */
    setLayout (layout) {
      if (!layout || !layouts[layout]) {
        layout = this.defaultLayout
      }

      this.layout = layouts[layout]
    },

    handleResize() {
      if (window.innerWidth < 1200) {
        document.body.classList.add('container-fix')
      } else {
        document.body.classList.remove('container-fix')
      }
      this.window.width = window.innerWidth
      this.window.height = window.innerHeight
    }
  },
  
  destroyed() {
    window.removeEventListener('resize', this.handleResize)
  }
}
</script>
