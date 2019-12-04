
export function refresh (state, data) {
  state.procedimentos = data
}
export function select (state, id) {
  state.selected = state.procedimentos.find(el => el.id === id)
}
export function removeProcedimento (state, id) {
  state.procedimentos = state.procedimentos.filter(procedimento => procedimento.id !== id)
  state.selected = null
}
