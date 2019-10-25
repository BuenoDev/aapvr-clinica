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
  // console.log(data)
  // let users = state.users.data
  state.users.data = state.users.data.map(function (user) {
    // console.log({
    //   user: user,
    //   data: data,
    //   user_id: user.id,
    //   data_id: data.data.id,
    //   flag: user.id === data.data.id
    // })
    return user.id === data.id ? data : user
  })
  // let index = state.users.data.findIndex((user, index, array) => {
  //   console.log(data)
  //   return user.id === data.id
  // })
  // state.users.data[index] = data
  // for (var user in state.users.data) {
  //   console.log(user.id === data.id)
  // }
  // let users = state.users.data.map(function (user) {
  //   console.log({
  //     user: user.id,
  //     data: data.id
  //   })
  //   if (user.id === data.id) console.log(true)
  //   else console.log(false)
  //   return user.id === data.id ? data : user
  // })
  // console.log({
  //   users: users,
  //   data: data
  // })
  // state.users.data = users
}
