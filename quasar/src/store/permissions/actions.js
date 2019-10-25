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
// TODO: trocar por array.find
export function getUser (context, id) {
  let user = context.state.users.data.filter(user => {
    return user.id === parseInt(id)
  })
  return user[0]
}
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
