export function getUserData (state) {
  return state.user
}
export function getToken (state) {
  return state.token
}
export function rememberToken (state) {
  return state.rememberToken
}
export function isAuth (state) {
  return !!state.token
}
