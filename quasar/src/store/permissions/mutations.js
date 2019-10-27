/*
export function someMutation (state) {
}
*/
export function setUsers (state, data) {
  state.users.data = data.users
  state.users.count = data.count
}
export function setRoles (state, data) {
  state.roles.data = data.roles
  state.roles.count = data.count
}
export function setPermissions (state, data) {
  state.permissions.data = data.permissions
  state.permissions.count = data.count
}
export function updateUser (state, data) {
  state.users.data = state.users.data.map(function (user) {
    return user.id === data.id ? data : user
  })
}
export function selectUser (state, data) {
  state.users.selected = state.users.data.find(user => user.id === data)
}
export function selectRole (state, data) {
  state.roles.selected = state.roles.data.find(role => role.id === data)
}
