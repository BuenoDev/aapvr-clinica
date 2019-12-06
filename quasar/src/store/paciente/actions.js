import Vue from 'vue'

export function refresh (context) {
  return Vue.prototype.$axios.get('paciente').then(response => {
    context.commit('refresh', response.data)
  })
}
export function select (context, id) {
  context.commit('select', id)
}
export function deletePaciente (context, data) {
  context.commit('removePaciente', data)
  return Vue.prototype.$axios.delete(`paciente/${data}`).catch(() => {
    context.dispatch('refresh')
  })
}
