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

      /**
       * Prestador
       */
      { path: 'prestador', component: () => import('pages/cadastro/prestador/index') },
      { path: 'prestador/cadastro', component: () => import('pages/cadastro/prestador/create') },
      { path: 'prestador/visualizar', component: () => import('pages/cadastro/prestador/show') },
      /**
       * Grupo de Procedimento
       */
      { path: 'grupoprocedimento', component: () => import('pages/cadastro/grupoprocedimento/index') },
      { path: 'grupoprocedimento/cadastro', component: () => import('pages/cadastro/grupoprocedimento/create') },
      { path: 'grupoprocedimento/visualizar', component: () => import('pages/cadastro/grupoprocedimento/show') },
      /**
       * Unidade
       */
      { path: 'unidade', component: () => import('pages/cadastro/unidade/index') },
      { path: 'unidade/cadastro', component: () => import('pages/cadastro/unidade/create') },
      { path: 'unidade/visualizar', component: () => import('pages/cadastro/unidade/show') },
      /**
       * Especialidade
       */
      { path: 'especialidade', component: () => import('pages/cadastro/especialidade/index') },
      { path: 'especialidade/cadastro', component: () => import('pages/cadastro/especialidade/create') },
      { path: 'especialidade/visualizar', component: () => import('pages/cadastro/especialidade/show') },
      /**
       * Pacientes
       */
      { path: 'paciente', component: () => import('pages/cadastro/paciente/index') },
      { path: 'paciente/cadastro', component: () => import('pages/cadastro/paciente/create') },
      { path: 'paciente/visualizar', component: () => import('pages/cadastro/paciente/show') }
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
