export function user (state) {
  return state.user
}
export function token (state) {
  return state.token
}
export function rememberToken (state) {
  return state.rememberToken
}
export function isAuth (state) {
  return !!state.token
}
