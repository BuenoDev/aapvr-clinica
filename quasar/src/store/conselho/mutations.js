
export function refresh (state, data) {
  state.conselhos = data
}
export function select (state, id) {
  state.selected = state.conselhos.find(el => el.id === id)
}
export function removeConselho (state, id) {
  state.conselhos = state.conselhos.filter(conselho => conselho.id !== id)
  state.selected = null
}
