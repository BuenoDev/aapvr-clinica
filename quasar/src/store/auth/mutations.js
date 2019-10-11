import Vue from 'vue'

export function setUserData (state, data) {
  state.user = data
}
export function setToken (state, data) {
  state.token = data.access_token
  Vue.prototype.$axios.interceptors.request.use(function (config) {
    config.headers.Authorization = `Bearer ${state.token}`
    return config
  })
}
