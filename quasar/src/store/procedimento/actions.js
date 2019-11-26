import Vue from 'vue'

export function refresh (context) {
  return Vue.prototype.$axios.get('procedimento').then(response => {
    context.commit('refresh', response.data)
  })
}
export function select (context, id) {
  context.commit('select', id)
}
export function deleteProcedimento (context, data) {
  context.commit('removeProcedimento', data)
  return Vue.prototype.$axios.delete(`procedimento/${data}`)
}
