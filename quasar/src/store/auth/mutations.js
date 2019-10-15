import Vue from 'vue'
import { LocalStorage, SessionStorage } from 'quasar'

export function setToken (state, data) {
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
  let user = data
  /**
   * Verifica se usuário possui a permissão indicada
   */
  user.can = function (permission) {
    return this.permissions.includes(permission)
  }
  /**
   * Verifica se o usuário pertence ao grupo indicado
   */
  user.hasRole = function (role) {
    return this.roles.includes(role)
  }
  state.user = user
}
