import Vue from 'vue'
import Fuse from 'fuse.js'

Vue.prototype.$fuse = new Fuse(this.especialidadesOptions, {
  shouldSort: true,
  threshold: 0.6,
  location: 0,
  distance: 100,
  maxPatternLength: 32,
  minMatchCharLength: 1,
  keys: ['label']
})
