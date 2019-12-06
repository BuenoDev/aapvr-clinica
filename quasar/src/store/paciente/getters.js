
export function pacientes (state) {
  return state.pacientes
}
export function selected (state) {
  let obj = Object.assign({}, state.selected)
  obj.enderecos = [Object.assign({}, obj.endereco)]
  obj.telefones = [obj.telefones.map(el => Object.assign({}, el))]
  return obj
}
