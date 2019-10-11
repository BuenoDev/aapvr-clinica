import Vue from 'vue'
import { LocalStorage } from 'quasar'

export function setToken (state, data) {
  state.token = data.access_token
  if (state.rememberToken) {
    LocalStorage.set('token', state.token)
  }
  Vue.prototype.$axios.interceptors.request.use(config => {
    config.headers.Authorization = `Bearer ${state.token}`
    return config
  })
}
export function logout (state) {
  state.token = null
  Vue.prototype.$axios.interceptors.request.use(config => {
    config.headers.Authorization = ''
    return config
  })
}
export function rememberMe (state, data) {
  state.rememberToken = data
}
export function setUserData (state, data) {
  state.user = data
}
