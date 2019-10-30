<template>
  <div class="">
    <q-table
      @request="updateRequest"
      :data="roles"
      :columns="columns"
      :loading="loading"
      :pagination.sync = "pagination"
      rows-per-page-label = "Registros por página:"
      loading-label = "Carregando..."
      row-key="name"
    >
      <template v-slot:top>
        <q-btn color="white" text-color="black" label="Adicionar Grupo" @click="openDialog"/>
        <q-space />
        <!-- <q-input  dense debounce="300" color="primary" v-model="search">
          <template v-slot:append>
            <q-icon name="search" />
          </template>
        </q-input> -->
      </template>
      <template v-slot:body-cell-actions="props">
          <q-td key="actions" :props="props">
            <q-btn
              split
              size="sm"
              color="primary"
              icon="visibility"
              :to="`/permissoes/grupos/${props.row.id}`"
              :loading="loading"
            />
          </q-td>
      </template>
    </q-table>
    <q-dialog v-model="createDialog">
      <q-card>
        <!-- <q-card-section class="row">
          <q-btn icon="close" flat round dense v-close-popup class="col-2 offset-10"/>
        </q-card-section> -->
        <q-card-section class="itens-center">
          <form @submit.prevent="createRole">
            <q-input
              v-model="roleName"
              label="Nome"
            />
            <q-btn
              class="full-width q-mt-lg"
              label="Adicionar"
              type="submit"
              :loading="loading"
            ></q-btn>
          </form>
        </q-card-section>
      </q-card>
    </q-dialog>
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
        {
          name: 'actions',
          label: 'Ações',
          field: 'id',
          align: 'center'
        }
      ],
      data: [],
      createDialog: false,
      roleName: null
    }
  },
  mounted () {
    if (this.roles.length === 0) {
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
      'rolesCount',
      'roles'
    ])
  },
  methods: {
    openDialog () {
      this.createDialog = true
    },
    updateRequest (payload) {
      this.pagination = payload.pagination
      this.fetch()
    },
    fetch () {
      this.loading = true
      this.$store.dispatch('permissions/searchRole', {
        page: this.pagination.page,
        rowsPerPage: this.pagination.rowsPerPage,
        searchParam: this.search
      }).then(response => {
        this.pagination.rowsNumber = this.rolesCount
        this.loading = false
      })
    },
    createRole () {
      this.loading = true
      this.$axios.post('/role', {
        role: this.roleName
      }).then(() => {
        this.createDialog = false
        this.$q.notify({
          message: 'Grupo adicionado com sucesso'
        })
        this.fetch()
      })
    }
  }
}

</script>
