import Vue from 'vue'
import Vuex from 'vuex'

import auth from './auth'
import permissions from './permissions'
import prestador from './prestador'
import unidade from './unidade'
import especialidade from './especialidade'

Vue.use(Vuex)

/*
 * If not building with SSR mode, you can
 * directly export the Store instantiation
 */

export default function (/* { ssrContext } */) {
  const Store = new Vuex.Store({
    modules: {
      auth,
      permissions,
      prestador,
      unidade,
      especialidade
    },

    // enable strict mode (adds overhead!)
    // for dev mode only
    strict: process.env.DEV
  })

  /*
    if we want some HMR magic for it, we handle
    the hot update like below. Notice we guard this
    code with "process.env.DEV" -- so this doesn't
    get into our production build (and it shouldn't).
  */

  if (process.env.DEV && module.hot) {
    module.hot.accept(['./auth'], () => {
      const newAuth = require('./auth').default
      Store.hotUpdate({ modules: { auth: newAuth } })
    })
    module.hot.accept(['./permissions'], () => {
      const newPermissions = require('./permissions').default
      Store.hotUpdate({ modules: { permissions: newPermissions } })
    })
    module.hot.accept(['./prestador'], () => {
      const newPrestador = require('./prestador').default
      Store.hotUpdate({ modules: { prestador: newPrestador } })
    })
    module.hot.accept(['./unidade'], () => {
      const newObj = require('./unidade').default
      Store.hotUpdate({ modules: { unidade: newObj } })
    })
    module.hot.accept(['./especialidade'], () => {
      const newObj = require('./especialidade').default
      Store.hotUpdate({ modules: { especialidade: newObj } })
    })
  }
  return Store
}
