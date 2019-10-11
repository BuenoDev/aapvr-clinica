import Vue from 'vue'
import { LocalStorage } from 'quasar'

export function login (context, data) {
  if (context.state.rememberToken) {
    context.commit('setToken', LocalStorage.getItem('token'))
    context.dispatch('fetchUser')
  }
  return Vue.prototype.$axios.post('auth/login', data).then(response => {
    context.commit('setToken', response.data)
    context.dispatch('fetchUser')
  })
}
export function logout (context) {
  return Vue.prototype.$axios.post('auth/logout').then(response => {
    context.commit('logout')
  })
}
export function rememberMe (context, data) {
  context.dispatch('rememberMe', data)
}

export function fetchUser (context) {
  return Vue.prototype.$axios.post('/auth/me').then(response => {
    context.commit('setUserData', response.data)
  })
}
