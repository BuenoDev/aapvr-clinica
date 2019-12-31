import Vue from 'vue'

export function refresh (context) {
  return Vue.prototype.$axios.get('prestador').then(response => {
    context.commit('refresh', response.data)
  })
}
export function select (context, id) {
  console.log(id)
  context.commit('select', id)
}
export function deletePrestador (context, data) {
  context.commit('removePrestador', data)
  return Vue.prototype.$axios.delete(`prestador/${data}`)
}
