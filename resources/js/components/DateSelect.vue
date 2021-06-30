<template>
  <div class="date-select--wrapper">
    <select name="DOBYear">
    </select>
    <select name="DOBMonth">
    </select>
    <select name="DOBDay">
    </select>
  </div>
</template>

<script>
export default {
  name: 'DateSelect',

  props: {
    name: {
      type: String,
      default: 'date'
    },
    value: {
      type: Boolean,
      default: false
    },
  },

  data: () => ({
  }),

  computed: {
    
  },

  methods: {
  }
}
</script>
