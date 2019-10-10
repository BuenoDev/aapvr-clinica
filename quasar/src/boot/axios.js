import Vue from 'vue'
import axios from 'axios'

axios.defaults.baseURL = 'http://localhost:8000/api'

Vue.prototype.$axios = axios
