import Vue from 'vue'
import axios from 'axios'

let config = {
  baseURL: 'http://localhost:8000/api'
}
axios.defaults.baseURL = config.baseURL

Vue.prototype.$axios = axios

export default config
