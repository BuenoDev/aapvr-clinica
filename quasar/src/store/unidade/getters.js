
export function unidades (state) {
  return state.unidades
}
export function selected (state) {
  let obj = Object.assign({}, state.selected)
  obj.enderecos = [Object.assign({}, obj.endereco)]
  return obj
}
