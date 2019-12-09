
export function convenios (state) {
  return state.convenios
}
export function selected (state) {
  let obj = Object.assign({}, state.selected)
  obj.convenios = [Object.assign({})]
  console.log(obj)
  return obj
}
