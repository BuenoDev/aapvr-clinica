
export function pacientes (state) {
  return state.pacientes
}
export function selected (state) {
  let obj = Object.assign({}, state.selected)
  console.log('getter')
  obj.telefones = obj.telefones.map(el => Object.assign({}, el))
  obj.enderecos = obj.enderecos.map(el => Object.assign({}, el))
  return obj
}
