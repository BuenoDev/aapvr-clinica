<template>
  <div class="q-pa-md">
    <default-page-header
     :config="headerConfig"
     backTo="home"
    />
    <div class="q-gutter-y-md " style="min-width: 900px">
      <q-card>
        <q-tabs
          v-model="tab"
          dense
          class="text-grey"
          active-color="primary"
          indicator-color="primary"
          align="justify"
          narrow-indicator
        >
          <q-tab name="usuarios" label="Usuarios" />
          <q-tab name="grupos" label="Grupos" />
          <q-tab name="permissoes" label="Permissoes" />
        </q-tabs>
        <q-separator />
        <q-tab-panels v-model="tab" animated>
          <q-tab-panel name="usuarios">
            <usuarios/>
          </q-tab-panel>

          <q-tab-panel name="grupos">
            <grupos/>
          </q-tab-panel>

          <q-tab-panel name="permissoes">
            <permissoes/>
          </q-tab-panel>
        </q-tab-panels>
      </q-card>
    </div>
  </div>
</template>
<script>
import usuarios from './usuario/index'
import permissoes from './permissoes/index'
import grupos from './grupos/index'
import defaultPageHeader from '../../components/defaultPageHeader'

export default {
  components: {
    usuarios,
    permissoes,
    grupos,
    defaultPageHeader
  },
  created () {
    this.$store.dispatch('permissions/searchRole')
    this.$store.dispatch('permissions/searchPermission')
  },
  data () {
    return {
      tab: 'usuarios',
      headerConfig: [
        {
          icon: 'home',
          route: '/',
          label: 'Home'
        },
        {
          icon: '',
          route: '/permission',
          label: 'Permissoes'
        }
      ]
    }
  }
}
</script>
