/*
export function someMutation (state) {
}
*/
export function setUsers (state, data) {
  state.users.data = data.users
  state.users.count = data.count
}
export function setUnlinkedUsers (state, data) {
  state.unlinkedUsers = Object.values(data)
}
export function removeUnlinked (state, id) {
  state.unlinkedUsers = state.unlinkedUsers.filter(user => {
    return user.id !== id
  })
}
export function setRoles (state, data) {
  state.roles.data = data.roles
  state.roles.count = data.count
}
export function setPermissions (state, data) {
  state.permissions.data = data.permissions
  state.permissions.count = data.count
}
export function selectUser (state, data) {
  state.users.selected = state.users.data.find(user => user.id === data)
}
export function selectRole (state, data) {
  state.roles.selected = state.roles.data.find(role => role.id === data)
}
export function selectPermission (state, data) {
  state.permissions.selected = state.permissions.data.find(permission => permission.id === data)
}
export function updateUser (state, data) {
  state.users.data = state.users.data.map(function (user) {
    return user.id === data.id ? data : user
  })
}
export function updateRole (state, data) {
  state.roles.data = state.roles.data.map(role => role.id === data.id ? data : role)
}
