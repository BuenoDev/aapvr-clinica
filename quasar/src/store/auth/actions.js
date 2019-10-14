import Vue from 'vue'
import { LocalStorage, SessionStorage } from 'quasar'

/**
 * Realiza o login com as credenciais enviadas
 * @param {Vuex} context
 * @param {email, password, remember} data
 */
export function login (context, data) {
  context.dispatch('rememberMe', data.remember)
  return Vue.prototype.$axios.post('auth/login', {
    email: data.email,
    password: data.password
  }).then(response => {
    context.commit('setToken', response.data.access_token)
    context.dispatch('fetchUser')
  })
}
/**
 * Realiza o login automatico se existir um token JWT no storage
 */
export function loginWithToken (context) {
  // Define qual storage existe o token, false se as duas forem vazias
  let storage = LocalStorage.has('token') ? LocalStorage : (SessionStorage.has('token') ? SessionStorage : false)
  if (storage) {
    context.commit('setToken', storage.getItem('token'))
    context.dispatch('fetchUser')
    return true
  } else return false
}
/**
 * Desconecta o usuário
 */
export function logout (context) {
  return Vue.prototype.$axios.post('auth/logout').then(response => {
    console.log(response)
    context.commit('logout')
  }).catch(error => {
    console.error(error)
  })
}
/**
 * Ativa ou desativa o token rememberMe do storage
 * TODO: realmente necessário?
 */
export function rememberMe (context, data) {
  context.commit('rememberMe', data)
}
/**
 * Carrega os dados do usuário
 */
export function fetchUser (context) {
  return Vue.prototype.$axios.post('/auth/me').then(response => {
    context.commit('setUserData', response.data)
  })
}
