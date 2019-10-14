import Vue from 'vue'
import { LocalStorage, SessionStorage } from 'quasar'

export function setToken (state, data) {
  console.log({ SessionStorage: SessionStorage, LocalStorage: LocalStorage })
  state.token = data
  SessionStorage.set('token', state.token)
  if (state.rememberToken) LocalStorage.set('token', state.token)
  Vue.prototype.$axios.interceptors.request.use(config => {
    config.headers.Authorization = `Bearer ${state.token}`
    return config
  })
}
export function logout (state) {
  state.token = null
  SessionStorage.remove('token')
  LocalStorage.remove('token')
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
