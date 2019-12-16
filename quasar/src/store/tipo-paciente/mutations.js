export function refresh (state, data) {
  state.especialidades = data
}
export function select (state, id) {
  state.selected = state.especialidades.find(el => el.id === id)
}
export function removeEspecialidade (state, id) {
  state.especialidades = state.especialidades.filter(obj => obj.id !== id)
  state.selected = null
}
