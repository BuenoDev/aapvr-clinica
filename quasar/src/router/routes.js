// function guard (to, from, next) {
//   // if (false) { // TODO: use store to check if user is curently logged n
//   //     next()
//   // } else {
//   //   next('/login')
//   // }
//   next('/cadastro')
// }
const routes = [
  {
    path: '/',
    component: () => import('layouts/MyLayout.vue'),
    // beforeEnter: guard(),
    beforeEnter: (to, from, next) => {
      next('/login')
    },
    children: [
      { path: '', component: () => import('pages/Index.vue') }
    ]
  },
  {
    path: '',
    component: () => import('layouts/AuthLayout.vue'),
    children: [
      {
        path: '/login',
        component: () => import('pages/auth/login')
      },
      {
        path: '/cadastro',
        component: () => import('pages/auth/register')
      }
    ]
  }
]
// Always leave this as last one
if (process.env.MODE !== 'ssr') {
  routes.push({
    path: '*',
    component: () => import('pages/Error404.vue')
  })
}

export default routes
