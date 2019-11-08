
export function prestadores (state) {
  return state.prestadores
}
export function selected (state) {
  let obj = Object.assign({}, state.selected)
  obj.telefones = obj.telefones.map(el => Object.assign({}, el))
  obj.enderecos = obj.enderecos.map(el => Object.assign({}, el))
  return obj
}
