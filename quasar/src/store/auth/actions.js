import Vue from 'vue'

export function login (context, data) {
  return Vue.prototype.$axios.post('auth/login', data).then(response => {
    context.commit('setToken', response.data)
    context.dispatch('fetchUser')
  })
}

export function fetchUser (context) {
  return Vue.prototype.$axios.post('/auth/me').then(response => {
    context.commit('setUserData', response.data)
  })
}
