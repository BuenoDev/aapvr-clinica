const routes = [
  {
    path: '',
    component: () => import('layouts/AuthLayout.vue'),
    /**
     * Rotas de login
     */
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
       * Tipo de Prestador
       */
      { path: 'tipo-prestador', component: () => import('pages/cadastro/tipo-prestador/index') },
      { path: 'tipo-prestador/cadastro', component: () => import('pages/cadastro/tipo-prestador/create') },
      { path: 'tipo-prestador/visualizar', component: () => import('pages/cadastro/tipo-prestador/show') },
      /**
       * Grupo de Procedimento
       */
      { path: 'grupoprocedimento', component: () => import('pages/cadastro/grupoprocedimento/index') },
      { path: 'grupoprocedimento/cadastro', component: () => import('pages/cadastro/grupoprocedimento/create') },
      { path: 'grupoprocedimento/visualizar', component: () => import('pages/cadastro/grupoprocedimento/show') },
      /**
       * Procedimento
       */
      { path: 'procedimento', component: () => import('pages/cadastro/procedimento/index') },
      { path: 'procedimento/cadastro', component: () => import('pages/cadastro/procedimento/create') },
      { path: 'procedimento/visualizar', component: () => import('pages/cadastro/procedimento/show') },
      /**
       * Conselho
       */
      { path: 'conselho', component: () => import('pages/cadastro/conselho/index') },
      { path: 'conselho/cadastro', component: () => import('pages/cadastro/conselho/create') },
      { path: 'conselho/visualizar', component: () => import('pages/cadastro/conselho/show') },
      /**
       * Convenio
       */
      { path: 'convenio', component: () => import('pages/cadastro/convenio/index') },
      { path: 'convenio/cadastro', component: () => import('pages/cadastro/convenio/create') },
      { path: 'convenio/visualizar', component: () => import('pages/cadastro/convenio/show') },
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
