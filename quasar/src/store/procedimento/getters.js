
export function procedimentos (state) {
  return state.procedimentos
}
export function selected (state) {
  let obj = Object.assign({}, state.selected)
  obj.procedimentos = [Object.assign({})]
  console.log(obj)
  return obj
}
