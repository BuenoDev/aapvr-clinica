export function refresh (state, data) {
  state.prestadores = data
}
export function select (state, id) {
  state.selected = state.prestadores.find(el => el.id === id)
}
export function removePrestador (state, id) {
  state.prestadores = state.prestadores.filter(prestador => prestador.id !== id)
  state.selected = null
}
