<template>
  <div class="q-mt-lg">
    <default-page-header :config="headerConfig" backTo="home" />
    <div class="row justify-center q-mt-lg">
      <div class="col-lg-6 col-md-8 col-sm-12">
        <q-card>
          <q-card-section>
            <span class="text-h5">
              Prestadores
            </span>
          </q-card-section>
          <q-card-section>
            <q-table no-data-label="Nenhum Registro Encontrado!" :data="prestadores" :columns="columns" :loading="loading"
              rows-per-page-label="Registros por página:" loading-label="Carregando..."
              row-key="name">
                 <template v-slot:top-right>
                <q-input borderless dense debounce="300" v-model="filter" placeholder="Procurar">
                  <template v-slot:append>
                    <q-icon name="search" ></q-icon>
                  </template>
                </q-input>
              </template>
              <template v-slot:top-left>
                <q-btn color="white" text-color="black" label="Adicionar Prestador" to="prestador/cadastro" />
                <q-space />
                <!-- <q-input  dense debounce="300" color="primary" v-model="search">
                <template v-slot:append>
                  <q-icon name="search" />
                </template>
              </q-input> -->
              </template>
              <template v-slot:body-cell-actions="props">
                <q-td key="actions" :props="props">
                  <q-btn split size="sm" color="primary" icon="visibility" :to="`/prestador/visualizar`"
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
    ...mapGetters('prestador', [
      'prestadores'
    ])
  },
  methods: {
    ...mapActions('prestador', [
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
          route: '/prestador',
          label: 'Prestador'
        },
        {
          icon: 'person',
          route: '/criar',
          label: 'cadastro'
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
