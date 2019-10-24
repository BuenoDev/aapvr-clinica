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
  console.log(params)
  return Vue.prototype.$axios.get('user', {
    params: params
  }).then(response => {
    context.commit('setUsers', response.data)
  })
}

export function getUser (context, id) {
  let user = context.state.users.data.filter(user => {
    return user.id === parseInt(id)
  })
  return user[0]
}
