<template>
  <div>
    <q-input dense debounce="300" color="primary" v-model="search">
      <template v-slot:append>
        <q-icon name="search" v-if="!search" />
        <q-icon name="delete" v-if="search" @click="clearField"/>
      </template>
    </q-input>
  </div>
</template>
<script>
import Fuse from 'fuse.js'

export default {
  props: ['data', 'keys'],
  data () {
    return {
      search: null,
      fuse: null,
      options: {
        shouldSort: true,
        threshold: 0.6,
        location: 0,
        distance: 100,
        maxPatternLength: 32,
        minMatchCharLength: 1,
        keys: this.keys
      }
    }
  },
  watch: {
    search () {
      if (this.search !== null) this.$emit('result', this.fuse.search(this.search))
      else this.$emit('result', this.data)
    }
  },
  methods: {
    clearField () {
      this.search = null
    }
  },
  mounted () {
    this.fuse = new Fuse(this.data, this.options)
  }
}
</script>
