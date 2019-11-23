import Vue from 'vue'

export function refresh (context) {
  return Vue.prototype.$axios.get('grupoprocedimento').then(response => {
    context.commit('refresh', response.data)
  })
}
export function select (context, id) {
  context.commit('select', id)
}
export function deleteGrupoProcedimento (context, data) {
  context.commit('removeGrupoProcedimento', data)
  return Vue.prototype.$axios.delete(`grupoprocedimento/${data}`)
}
