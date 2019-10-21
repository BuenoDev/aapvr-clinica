<template>
  <div class="q-pa-md">
    <q-table
      @request="updateRequest"
      title="Usuários"
      :data="data"
      :columns="columns"
      :loading="loading"
      :pagination.sync = "pagination"
      rows-per-page-label = "Registros por página:"
      loading-label = "Carregando..."
      row-key="name"
    >
      <template v-slot:top>
        <q-btn color="white" text-color="black" label="Adicionar Grupo" />
        <q-space />
        <q-input  dense debounce="300" color="primary" v-model="search">
          <template v-slot:append>
            <q-icon name="search" />
          </template>
        </q-input>
      </template>
    <!-- TODO: fix template -->
      <template v-slot:body-cell-actions="props">
          <q-td key="actions" :props="props">
            <q-btn-dropdown
              split
              size="sm"
              color="primary"
              icon="visibility"
              :to="`/permissoes/usuario/${props.row.id}/detalhes`"
              :loading="loading"
            >
            <q-list>
              <q-item clickable v-close-popup
                :loading="loading"
                :to="`/permissoes/usuario/${props.row.id}/editar`">
              <q-item-section>
                <q-item-label>Editar</q-item-label>
              </q-item-section>
              </q-item>
              <q-item clickable v-close-popup
                :loading="loading"
                @click="prompt=true,dialog='delete',credential.id = props.row.id"
              >
              <q-item-section>
                <q-item-label>Remover</q-item-label>
              </q-item-section>
              </q-item>
            </q-list>
            </q-btn-dropdown>
          </q-td>
      </template>
    </q-table>
  </div>
</template>
<script>
export default {
  data () {
    return {
      loading: true,
      search: null,
      pagination: {
        page: 1,
        rowsPerPage: 5,
        rowsNumber: 0
      },
      columns: [
        {
          name: 'name',
          label: 'Nome',
          field: 'name',
          align: 'center'
        },
        // {
        //   name: 'permissions',
        //   label: 'Permissoes',
        //   field: 'permissions',
        //   align: 'left'
        // },
        {
          name: 'actions',
          label: 'Ações',
          field: 'id',
          align: 'center'
        }
      ],
      data: []
    }
  },
  mounted () {
    this.fetch()
  },
  watch: {
    search () {
      this.fetch()
    }
  },
  methods: {
    updateRequest (payload) {
      this.pagination = payload.pagination
      this.fetch()
    },
    fetch () {
      this.loading = true
      this.$axios.get('role', {
        params: {
          page: this.pagination.page,
          rowsPerPage: this.pagination.rowsPerPage,
          searchParam: this.search
        }
      }).then(response => {
        this.pagination.rowsNumber = response.data.count
        this.data = response.data.roles
        this.loading = false
      })
    }
  }
}

</script>
