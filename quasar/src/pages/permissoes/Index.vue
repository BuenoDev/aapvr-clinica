<template>
  <div class="q-pa-md">
    <div class="row">
      <q-breadcrumbs class="q-pl-md q-mb-xl col-md-4">
        <q-breadcrumbs-el icon="home" to="/" />
        <q-breadcrumbs-el label="Permissões" icon="assignment_ind"/>
      </q-breadcrumbs>
      <div class="justify-right col-md-2 offset-6">
        <q-btn
        label="voltar"
        size="sm"
        icon="arrow_back"
        to="/"
        />
      </div>
    </div>
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

export default {
  components: {
    usuarios,
    permissoes,
    grupos
  },
  data () {
    return {
      tab: 'usuarios'
    }
  }
}
</script>
