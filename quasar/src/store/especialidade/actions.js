import Vue from 'vue'

export function refresh (context) {
  return Vue.prototype.$axios.get('especialidade').then(response => {
    context.commit('refresh', response.data)
  })
}
export function select (context, id) {
  context.commit('select', id)
}
export function deleteEspecialidade (context, data) {
  context.commit('removeEspecialidade', data)
  return Vue.prototype.$axios.delete(`especialidade/${data}`)
}
