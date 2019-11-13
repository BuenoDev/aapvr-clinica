import Vue from 'vue'

export function refresh (context) {
  return Vue.prototype.$axios.get('tipo-prestador').then(response => {
    context.commit('refresh', response.data)
  })
}
export function select (context, id) {
  context.commit('select', id)
}
export function remove (context, data) {
  context.commit('remove', data)
  return Vue.prototype.$axios.delete(`tipo-prestador/${data}`)
}
