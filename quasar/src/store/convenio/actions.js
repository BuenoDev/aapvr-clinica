import Vue from 'vue'

export function refresh (context) {
  return Vue.prototype.$axios.get('convenio').then(response => {
    context.commit('refresh', response.data)
  })
}
export function select (context, id) {
  context.commit('select', id)
}
export function deleteConvenio (context, data) {
  context.commit('removeConvenio', data)
  return Vue.prototype.$axios.delete(`convenio/${data}`)
}
