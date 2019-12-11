export function refresh (state, data) {
  state.tipoPrestador = data
}
export function select (state, id) {
  state.selected = state.tipoPrestador.find(el => el.id === id)
}
export function remove (state, id) {
  state.tipoPrestador = state.tipoPrestador.filter(obj => obj.id !== id)
  state.selected = null
}
