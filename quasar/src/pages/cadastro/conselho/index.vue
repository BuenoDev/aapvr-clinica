<template>
  <div class="q-mt-lg">
    <default-page-header :config="headerConfig" backTo="home" />
    <div class="row justify-center q-mt-lg">
      <div class="col-lg-6 col-md-12 col-sm-12">
        <q-card>
          <q-card-section>
            <span class="text-h5">
              Procedimentos
            </span>
          </q-card-section>
          <q-card-section>
            <q-table :filter="filter" no-data-label="Nenhum Registro Encontrado!" :data="procedimentos" :columns="columns" :loading="loading" rows-per-page-label="Registros por página:" loading-label="Carregando..." row-key="codigo">
              <template v-slot:top-right>
                <q-input borderless dense debounce="300" v-model="filter" placeholder="Procurar">
                  <template v-slot:append>
                    <q-icon name="search" ></q-icon>
                  </template>
                </q-input>
              </template>
              <template v-slot:top-left>
                <q-btn color="white" text-color="black" label="Adicionar Procedimento" to="procedimento/cadastro" />
                <q-space />
                <!-- <q-input dense debounce="300" color="primary" v-model="search">
                <template v-slot:append>
                  <q-icon name="search" />
                </template>
              </q-input> -->
              </template>
              <template v-slot:body-cell-actions="props">
                <q-td key="actions" :props="props">
                  <q-btn split size="sm" color="primary" icon="visibility" :to="`/procedimento/visualizar`"
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
    ...mapGetters('procedimento', [
      'procedimentos'
    ])
  },
  methods: {
    ...mapActions('procedimento', [
      'refresh',
      'select'
    ])
  },
  data () {
    return {
      filter: '',
      headerConfig: [
        {
          icon: 'home',
          route: '/home',
          label: 'Home'
        },
        {
          icon: 'person',
          route: '/criar',
          label: 'Procedimentos'
        }
      ],
      columns: [
        {
          name: 'codigo',
          label: 'Código',
          field: 'codigo',
          align: 'center'
        },
        {
          name: 'procedimento',
          label: 'Procedimento',
          field: 'procedimento',
          align: 'left'
        },
        {
          name: 'status',
          label: 'Status',
          field: 'status',
          align: 'center'
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
