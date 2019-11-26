
export function refresh (state, data) {
  state.grupoprocedimentos = data
}
export function select (state, id) {
  state.selected = state.grupoprocedimentos.find(el => el.id === id)
}
export function removeGrupoProcedimento (state, id) {
  state.grupoprocedimentos = state.grupoprocedimentos.filter(grupoprocedimento => grupoprocedimento.id !== id)
  state.selected = null
}
