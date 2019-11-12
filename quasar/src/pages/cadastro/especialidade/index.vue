<template>
  <div class="q-mt-lg">
    <default-page-header :config="headerConfig" backTo="home" />
    <div class="row justify-center q-mt-lg">
      <div class="col-lg-6 col-md-8 col-sm-12">
        <q-card>
          <q-card-section>
            <span class="text-h5">
              Especialidades
            </span>
          </q-card-section>
          <q-card-section>
            <q-table  :data="especialidades" :columns="columns" :loading="loading"
              rows-per-page-label="Registros por página:" loading-label="Carregando..."
              row-key="name">
              <template v-slot:top>
                <q-btn color="white" text-color="black" label="Adicionar Especialidade" to="especialidade/cadastro" />
                <q-space />
                <!-- <q-input  dense debounce="300" color="primary" v-model="search">
                <template v-slot:append>
                  <q-icon name="search" />
                </template>
              </q-input> -->
              </template>
              <template v-slot:body-cell-actions="props">
                <q-td key="actions" :props="props">
                  <q-btn split size="sm" color="primary" icon="visibility" :to="`/especialidade/visualizar`"
                     @click="select(props.row.id)"/>
                </q-td>
              </template>
            </q-table>
          </q-card-section>
        </q-card>
      </div>
    </div>
  </div>
</template>
<script>
import { mapGetters, mapActions } from 'vuex'
import defaultPageHeader from '../../../components/defaultPageHeader'

export default {
  components: {
    defaultPageHeader
  },
  computed: {
    ...mapGetters('especialidade', [
      'especialidades'
    ])
  },
  methods: {
    ...mapActions('especialidade', [
      'refresh',
      'select'
    ])
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
          route: '/especialidade',
          label: 'Especialidade'
        }
      ],
      columns: [
        {
          name: 'codigo',
          label: 'Codigo',
          field: 'codigo',
          align: 'center'
        },
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
      loading: false
    }
  },
  mounted () {
    this.loading = true
    this.refresh().then(() => {
      this.loading = false
    })
  }
}
</script>
