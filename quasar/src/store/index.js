import Vue from 'vue'
import Vuex from 'vuex'

import auth from './auth'
import permissions from './permissions'
import prestador from './prestador'
import unidade from './unidade'
import especialidade from './especialidade'
import grupoprocedimento from './grupoprocedimento'
import paciente from './paciente'
import procedimento from './procedimento'
import conselho from './conselho'
import convenio from './convenio'
import tipoprestador from './tipo-prestador'
import tipopaciente from './tipo-paciente'

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
      especialidade,
      procedimento,
      grupoprocedimento,
      paciente,
      conselho,
      convenio,
      tipoprestador,
      tipopaciente
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
    module.hot.accept(['./grupoprocedimento'], () => {
      const newObj = require('./grupoprocedimento').default
      Store.hotUpdate({ modules: { grupoprocedimento: newObj } })
    })
    module.hot.accept(['./procedimento'], () => {
      const newObj = require('./procedimento').default
      Store.hotUpdate({ modules: { procedimento: newObj } })
    })
    module.hot.accept(['./conselho'], () => {
      const newObj = require('./conselho').default
      Store.hotUpdate({ modules: { conselho: newObj } })
    })
    module.hot.accept(['./convenio'], () => {
      const newObj = require('./convenio').default
      Store.hotUpdate({ modules: { convenio: newObj } })
    })
    module.hot.accept(['./paciente'], () => {
      const newObj = require('./paciente').default
      Store.hotUpdate({ modules: { paciente: newObj } })
    })
    module.hot.accept(['./tipo-prestador'], () => {
      const newObj = require('./tipo-prestador').default
      Store.hotUpdate({ modules: { tipoprestador: newObj } })
    })
    module.hot.accept(['./tipo-paciente'], () => {
      const newObj = require('./tipo-paciente').default
      Store.hotUpdate({ modules: { tipopaciente: newObj } })
    })
  }
  return Store
}
