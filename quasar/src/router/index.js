import Vue from 'vue'
import VueRouter from 'vue-router'

import routes from './routes'

Vue.use(VueRouter)

/*
 * If not building with SSR mode, you can
 * directly export the Router instantiation
 */

export default function (/* { store, ssrContext } */) {
  const Router = new VueRouter({
    scrollBehavior: () => ({ x: 0, y: 0 }),
    routes,

    // Leave these as is and change from quasar.conf.js instead!
    // quasar.conf.js -> build -> vueRouterMode
    // quasar.conf.js -> build -> publicPath
    mode: process.env.VUE_ROUTER_MODE,
    base: process.env.VUE_ROUTER_BASE
  })

  Router.beforeEach((to, from, next) => {
    let isAuth = Router.app.$store.getters['auth/isAuth']
    let allowGuest = to.meta.allowGuest
    console.log({ isAuth: isAuth, routeAllowGuests: allowGuest })
    /**
     * Redireciona o usuário caso o mesmo não esteja autenticado
     * a menos que a proxima rota seja para login ou cadastro
     * ou qualquer outra que aceite visitantes
     */
    if (!isAuth && !allowGuest) next('/login')
    /**
     * Redireciona para home se usuario tentar entrar nas rotas
     * login ou cadastro
     */
    if (isAuth && allowGuest) next('/home')
    else next()
  })
  return Router
}
