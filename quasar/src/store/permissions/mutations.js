/*
export function someMutation (state) {
}
*/
export function setUsers (state, data) {
  state.users.data = data.users
  state.users.count = data.count
}
