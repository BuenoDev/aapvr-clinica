import Vue from 'vue'

export function refresh (context) {
  return Vue.prototype.$axios.get('conselho').then(response => {
    context.commit('refresh', response.data)
  })
}
export function select (context, id) {
  context.commit('select', id)
}
export function deleteConselho (context, data) {
  context.commit('removeConselho', data)
  return Vue.prototype.$axios.delete(`conselho/${data}`)
}
