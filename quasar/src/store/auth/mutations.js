import Vue from 'vue'

export function setToken (state, data) {
  state.token = data.access_token
  Vue.prototype.$axios.interceptors.request.use(config => {
    config.headers.Authorization = `Bearer ${state.token}`
    return config
  })
}

export function setUserData (state, data) {
  state.user = data
}
