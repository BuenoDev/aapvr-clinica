import Vue from 'vue'

export function refresh (context) {
  return Vue.prototype.$axios.get('tipo-paciente').then(response => {
    context.commit('refresh', response.data)
  })
}
export function select (context, id) {
  context.commit('select', id)
}
export function deleteEspecialidade (context, data) {
  context.commit('removeTipoPaciente', data)
  return Vue.prototype.$axios.delete(`tipo-paciente/${data}`)
}
