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
      { path: 'home', name: 'home', component: () => import('pages/Index.vue') },
      { path: 'agenda', name: 'agenda', component: () => import('pages/agenda/Index') },
      /**
       * Permissoes
       */
      { path: 'prontuario', name: 'prontuario', component: () => import('pages/prontuario/Index') },
      { path: 'permissoes', component: () => import('pages/permissoes/Index') },
      { path: 'permissoes/usuario/:id', component: () => import('pages/permissoes/usuario/show') },
      { path: 'permissoes/grupos/:id', component: () => import('pages/permissoes/grupos/show') },
      { path: 'permissoes/permissoes/:id', component: () => import('pages/permissoes/permissoes/show') },
      /**
       * Cadastros
       */
      { path: 'prestador/cadastro', component: () => import('pages/cadastro/prestador/create') }

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
