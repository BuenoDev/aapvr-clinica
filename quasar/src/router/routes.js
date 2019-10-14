const routes = [
  {
    path: '',
    component: () => import('layouts/AuthLayout.vue'),
    children: [
      {
        path: '/login',
        name: 'login',
        meta: { allowGuest: true },
        component: () => import('pages/auth/login')
      },
      {
        path: '/cadastro',
        name: 'cadastro',
        meta: { allowGuest: true },
        component: () => import('pages/auth/register')
      }
    ]
  },
  {
    path: '/',
    component: () => import('layouts/MainLayout.vue'),
    children: [
      { path: 'home', component: () => import('pages/Index.vue') },
      { path: 'agenda', component: () => import('pages/agenda/Index') },
      { path: 'prontuario', component: () => import('pages/prontuario/Index') }
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
