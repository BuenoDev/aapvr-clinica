import Vue from 'vue'
import axios from 'axios'
import axiosConfig from '../../boot/axios'
import { LocalStorage, SessionStorage } from 'quasar'

export function setToken (state, data) {
  state.token = data
  SessionStorage.set('token', state.token)
  if (state.rememberToken) LocalStorage.set('token', state.token)
  let config = {
    ...axiosConfig,
    headers: {
      Authorization: `Bearer ${state.token}`
    }
  }
  Vue.prototype.$axios = axios.create(config)
}
export function logout (state) {
  state.token = null
  state.user = null
  SessionStorage.remove('token')
  LocalStorage.remove('token')
  // Retorna a instancia para o valor original
  Vue.prototype.$axios = axios.create(axiosConfig)
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
