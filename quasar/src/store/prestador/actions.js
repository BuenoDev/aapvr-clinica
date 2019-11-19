import Vue from 'vue'

export function refresh (context) {
  Vue.prototype.$axios.get('tipo-prestador').then(response => {
    context.commit('setTipo', response.data)
  })
  Vue.prototype.$axios.get('especialidade').then(response => {
    context.commit('setEspecialidade', response.data)
  })
  return Vue.prototype.$axios.get('prestador').then(response => {
    context.commit('refresh', response.data)
  })
}
export function select (context, id) {
  context.commit('select', id)
}
export function deletePrestador (context, data) {
  context.commit('removePrestador', data)
  return Vue.prototype.$axios.delete(`prestador/${data}`)
}
