export function getUserData (state) {
  return state.user
}
export function getToken (state) {
  return state.token
}
export function isAuth (state) {
  return !!state.token
}
