
export function refresh (state, data) {
  state.unidades = data
}
export function select (state, id) {
  state.selected = state.unidades.find(el => el.id === id)
}
export function removeUnidade (state, id) {
  state.unidades = state.unidades.filter(unidade => unidade.id !== id)
  state.selected = null
}
