export function users (state) {
  return state.users.data
}
export function usersCount (state) {
  return state.users.count
}
export function unlinkedUsers (state) {
  // let obj = state.unlinkedUsers.map(o => {
  //   let usr = Object.assign({}, o)
  //   usr.perfil = Object.assign({}, o.perfil)
  // })
  // console.log(obj)
  return state.unlinkedUsers
}
export function roles (state) {
  return state.roles.data
}
export function rolesCount (state) {
  return state.roles.count
}
export function permissions (state) {
  return state.permissions.data
}
export function permissionsCount (state) {
  return state.permissions.count
}
export function selectedUser (state) {
  return state.users.selected
}
export function selectedRole (state) {
  return state.roles.selected
}
export function selectedPermission (state) {
  return state.permissions.selected
}
