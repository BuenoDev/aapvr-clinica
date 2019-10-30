/*
export function someAction (context) {
}
*/
import Vue from 'vue'

/**
 *
 * @param {*} context
 * @param { page, rowsPerPage, searchParam } params
 */
export function searchUsers (context, params) {
  return Vue.prototype.$axios.get('user', {
    params: params
  }).then(response => {
    context.commit('setUsers', response.data)
  })
}
export function searchRole (context, params) {
  return Vue.prototype.$axios.get('role', {
    params: params
  }).then(response => {
    context.commit('setRoles', response.data)
  })
}
export function searchPermission (context, params) {
  return Vue.prototype.$axios.get('permission', {
    params: params
  }).then(response => {
    context.commit('setPermissions', response.data)
  })
}
export function selectUser (context, id) {
  context.commit('selectUser', parseInt(id))
}
export function selectRole (context, id) {
  context.commit('selectRole', parseInt(id))
}
export function selectPermission (context, id) {
  context.commit('selectPermission', parseInt(id))
}
// TODO: remove
export function revokeRole (context, data) {
  console.log(data)
  return Vue.prototype.$axios.delete(`/user/${data.user}/role`, {
    params: {
      role: data.role
    }
  }).then(response => {
    context.commit('updateUser', response.data)
  })
}
export function syncUserRoles (context, data) {
  return Vue.prototype.$axios.put(`/user/${data.user_id}/role`, {
    roles: data.roles
  }).then(response => {
    context.commit('updateUser', response.data)
  })
}
export function syncUserPermissions (context, data) {
  return Vue.prototype.$axios.put(`/user/${data.user_id}/permission`, {
    permissions: data.permissions
  }).then(response => {
    context.commit('updateUser', response.data)
  })
}
export function syncRolePermissions (context, data) {
  return Vue.prototype.$axios.put(`/role/${data.role_id}/permission`, {
    permissions: data.permissions
  }).then(response => {
    context.commit('updateRole', response.data)
  })
}
