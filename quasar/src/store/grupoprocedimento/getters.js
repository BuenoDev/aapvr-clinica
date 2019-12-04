
export function grupoprocedimentos (state) {
  return state.grupoprocedimentos
}
export function selected (state) {
  let obj = Object.assign({}, state.selected)
  obj.grupoprocedimentos = [Object.assign({})]
  return obj
}
