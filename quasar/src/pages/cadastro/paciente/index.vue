<template>
  <div class="q-mt-lg">
    <default-page-header :config="headerConfig" backTo="home" />
    <div class="row justify-center q-mt-lg">
      <div class="col-lg-6 col-md-8 col-sm-12">
          <q-card-section>
            <span class="text-h5">
              Unidades
            </span>
          </q-card-section>
          <q-card-section>
            <q-table  :data="tableData" :columns="columns" :loading="loading"
              rows-per-page-label="Registros por página:" loading-label="Carregando..."
              row-key="name">
              <template v-slot:top-left>
                <q-btn color="white" text-color="black" label="Adicionar Paciente" to="paciente/cadastro" />
              </template>
              <template v-slot:top-right>
                <q-space />
                <fuse-input :data="pacientes" :keys="['nome']" @result="setResult" />
              </template>
              <template v-slot:body-cell-actions="props">
                <q-td key="actions" :props="props">
                  <q-btn split size="sm" color="primary" icon="visibility" :to="`/pacientes/visualizar`"
                     @click="select(props.row.id)"/>
                </q-td>
              </template>
            </q-table>
          </q-card-section>
      </div>
    </div>
  </div>
</template>
<script>
import { mapGetters, mapActions } from 'vuex'
import fuseInput from '../../../components/fuseInput'
import defaultPageHeader from '../../../components/defaultPageHeader'

export default {
  components: {
    defaultPageHeader,
    fuseInput
  },
  computed: {
    ...mapGetters('paciente', [
      'pacientes'
    ])
  },
  methods: {
    ...mapActions('paciente', [
      'refresh',
      'select'
    ]),
    setResult (result) {
      this.tableData = result
    }
  },
  data () {
    return {
      headerConfig: [
        {
          icon: 'home',
          route: '/',
          label: 'Home'
        },
        {
          icon: 'person',
          route: '/paciente',
          label: 'Pacientes'
        }
      ],
      columns: [
        {
          name: 'name',
          label: 'Nome',
          field: 'nome',
          align: 'center'
        },
        {
          name: 'actions',
          label: 'Ações',
          field: 'id',
          align: 'center'
        }
      ],
      tableData: [],
      loading: false
    }
  },
  mounted () {
    this.loading = true
    this.tableData = this.pacientes
    this.refresh().then(() => {
      this.loading = false
      this.tableData = this.pacientes
    })
  }
}
</script>
