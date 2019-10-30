<template>
  <div class="">
    <q-table
      @request="updateRequest"
      title="Usuários"
      :data="permissions"
      :columns="columns"
      :loading="loading"
      :pagination = "pagination"
      rows-per-page-label = "Registros por página:"
      loading-label = "Carregando..."
      row-key="name"
    >
      <template v-slot:top>
        <q-space />
        <!-- <q-input  dense debounce="300" color="primary" v-model="search">
          <template v-slot:append>
            <q-icon name="search" />
          </template>
        </q-input> -->
      </template>
    <!-- TODO: fix template -->
      <template v-slot:body-cell-actions="props">
          <q-td key="actions" :props="props">
            <q-btn
              size="sm"
              color="primary"
              icon="visibility"
              :to="`/permissoes/permissoes/${props.row.id}`"
              :loading="loading"
            >
            </q-btn>
          </q-td>
      </template>
    </q-table>
  </div>
</template>
<script>
import { mapGetters } from 'vuex'

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
      ]
    }
  },
  mounted () {
    if (this.permissions.length === 0) {
      this.loading = true
      this.fetch()
    } else {
      this.loading = false
      this.pagination.rowsNumber = this.permissionCount
    }
  },
  watch: {
    search () {
      this.fetch()
    }
  },
  computed: {
    ...mapGetters('permissions', [
      'permissionsCount',
      'permissions'
    ])
  },
  methods: {
    updateRequest (payload) {
      this.pagination = payload.pagination
      this.fetch()
    },
    fetch () {
      this.loading = true
      this.$store.dispatch('permissions/searchPermission', {
        page: this.pagination.page,
        rowsPerPage: this.pagination.rowsPerPage,
        searchParam: this.search
      }).then(response => {
        this.pagination.rowsNumber = this.permissionCount
        this.loading = false
      })
    }
  }
}

</script>
