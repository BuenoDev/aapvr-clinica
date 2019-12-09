
export function refresh (state, data) {
  state.convenios = data
}
export function select (state, id) {
  state.selected = state.convenios.find(el => el.id === id)
}
export function removeConvenio (state, id) {
  state.convenios = state.convenios.filter(convenio => convenio.id !== id)
  state.selected = null
}
