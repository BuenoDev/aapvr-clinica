import Vue from 'vue'

export function refresh (context) {
  return Vue.prototype.$axios.get('unidade').then(response => {
    context.commit('refresh', response.data)
  })
}
export function select (context, id) {
  context.commit('select', id)
}
export function deleteUnidade (context, data) {
  context.commit('removeUnidade', data)
  return Vue.prototype.$axios.delete(`unidade/${data}`)
}
