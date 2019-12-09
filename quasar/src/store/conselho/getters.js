
export function conselhos (state) {
  return state.conselhos
}
export function selected (state) {
  let obj = Object.assign({}, state.selected)
  obj.conselhos = [Object.assign({})]
  console.log(obj)
  return obj
}
