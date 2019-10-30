<template>
  <div class="row">
    <q-breadcrumbs class="q-pl-md q-mb-xl col-md-4">
      <template v-for="(conf, index) of config" >
        <q-breadcrumbs-el :icon="conf.icon" :to="conf.route" :label="conf.label" :key="index"/>
      </template>
    </q-breadcrumbs>
    <div class="justify-right col-md-2 offset-6">
      <q-btn label="voltar" size="sm" icon="arrow_back" :to="this.backTo" />
    </div>
  </div>
  <!-- </div> -->
</template>
<script>
/**
 * Header padrão para a maioria das telas
 * Consiste em um quasar-breadcrumbs e um botão voltar a direita
 *
 * @props config (lista de objetos para o breadcrumb => [{ icon: String, route: String, label: String }])
 * @props backTo String -> link para voltar
 */
export default {
  props: [
    'config', 'backTo'
  ]
}
</script>
