export function refresh (state, data) {
  state.pacientes = data
}
export function select (state, id) {
  state.selected = state.pacientes.find(el => el.id === id)
}
export function removePaciente (state, id) {
  state.pacientes = state.pacientes.filter(el => el.id !== id)
  state.selected = null
}
