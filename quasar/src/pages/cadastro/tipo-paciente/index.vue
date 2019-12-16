<template>
  <div class="q-mt-lg">
    <default-page-header :config="headerConfig" backTo="home" />
    <div class="row justify-center q-mt-lg">
      <div class="col-lg-6 col-md-8 col-sm-12">
          <q-card-section>
            <span class="text-h5">
              Tipo de Prestador
            </span>
          </q-card-section>
          <q-card-section>
            <q-table  :data="tableData" :columns="columns" :loading="loading"
              rows-per-page-label="Registros por página:" loading-label="Carregando..."
              row-key="name">
              <template v-slot:top>
                <q-btn color="white" text-color="black" label="Adicionar Tipo de Prestador" to="tipo-prestador/cadastro" />
                <q-space />
                <fuse-input :data="tiposPrestador" :keys="['nome']" @result="setResult" />
              </template>
              <template v-slot:body-cell-actions="props">
                <q-td key="actions" :props="props">
                  <q-btn split size="sm" color="primary" icon="visibility" :to="`/tipo-prestador/visualizar`"
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
    ...mapGetters('tipopaciente', [
      'tiposPaciente'
    ])
  },
  methods: {
    ...mapActions('tipoprestador', [
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
          route: '/tipo-prestador',
          label: 'Tipo de Prestador'
        }
      ],
      columns: [
        {
          name: 'name',
          label: 'Nome',
          field: 'nome',
          align: 'left'
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
    this.tableData = this.tiposPrestador
    this.refresh().then(() => {
      this.loading = false
      this.tableData = this.tiposPrestador
    })
  }
}
</script>
