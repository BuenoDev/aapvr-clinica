<template>
  <div>
    <q-table
      @request="updateRequest"
      title="Usuários"
      :data="users "
      :columns="columns"
      :loading="loading"
      :pagination = "pagination"
      rows-per-page-label = "Registros por página:"
      loading-label = "Carregando..."
      row-key="name"
    >
      <template v-slot:top>
        <!-- <q-btn flat dense color="primary" :disable="loading" label="Add row" @click="addRow" />
        <q-btn class="on-right" flat dense color="primary" :disable="loading" label="Remove row" @click="removeRow" /> -->
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
              :to="`/permissoes/usuario/${props.row.id}`"
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
import { mapGetters } from 'vuex'

export default {
  name: 'usuario',
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
          align: 'left'
        },
        {
          name: 'email',
          label: 'Email',
          field: 'email',
          align: 'left'
        },
        {
          name: 'role',
          label: 'Grupo',
          field: 'roles',
          align: 'left'
        },
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
    if (this.users.length === 0) {
      this.loading = true
      this.fetchUsers()
    } else {
      this.loading = false
      this.pagination.rowsNumber = this.usersCount
    }
  },
  watch: {
    search () {
      this.fetchUsers()
    }
  },
  computed: {
    ...mapGetters('permissions', [
      'usersCount',
      'users'
    ])
  },
  methods: {
    updateRequest (payload) {
      this.pagination = payload.pagination
      this.fetchUsers()
    },
    fetchUsers () {
      this.loading = true
      this.$store.dispatch('permissions/searchUsers', {
        page: this.pagination.page,
        rowsPerPage: this.pagination.rowsPerPage,
        searchParam: this.search
      }).then(response => {
        this.pagination.rowsNumber = this.usersCount
        this.loading = false
      })
    }
  }
}

</script>
