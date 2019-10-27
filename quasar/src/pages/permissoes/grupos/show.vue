<template>
  <div v-if="selectedRole" class="q-pa-md">
    <default-page-header :config="header.config" :backTo="header.back" />
    <q-card class="q-ma-lg">
      <q-card-section>
        <span class="text-h4" style="color:black">
          {{ selectedRole.name }}
        </span>
        <span class="text-h4 q-ml-lg">
          <q-icon name="delete_forever" color="negative" @click="removeRole"/>
        </span>
        <br>
      </q-card-section>
      <q-separator/>
      <q-card-section>
        <div class="row">
          <div class="col-md-4 col-sm-12">
            <span class="text-h5">
              Permissões
            </span>
            <q-btn size="sm" class="q-ml-md" @click="sync" >
              Sincronizar
            </q-btn>
            <q-list bordered separator class="q-mt-md permission-list">
              <q-item clickable v-ripple v-for="permission in rolePermissions" :key="permission.id">
                <q-item-section>
                  {{ permission.name }}
                </q-item-section>
                <q-item-section side>
                  <q-toggle v-model="permission.has" />
                </q-item-section>
              </q-item>
            </q-list>

          </div>
          <div class="offset-md-2 col-md-4 col-sm-12" v-if="users.length !== 0">
            <span class="text-h5" style="color:black">
              Usuários
            </span>
            <q-list>
              <q-list bordered separator class="q-mt-md permission-list">
                <q-item clickable v-ripple v-for="user in users" :key="user.id">
                  <q-item-section>
                    {{ user.name }}
                  </q-item-section>
                  <q-item-section side>
                    <q-btn
                      size="sm"
                      color="primary"
                      icon="visibility"
                      :to="`/permissoes/usuario/${user.id}`"
                      :loading="loading"
                    />
                  </q-item-section>
                </q-item>
              </q-list>
            </q-list>
          </div>
        </div>
      </q-card-section>
    </q-card>
  </div>
</template>
<script>
import { mapGetters } from 'vuex'
import defaultPageHeader from '../../../components/defaultPageHeader'
export default {
  computed: {
    ...mapGetters('permissions', [
      'permissions',
      'selectedRole'
    ])
  },
  components: {
    defaultPageHeader
  },
  data () {
    return {
      header: {
        config: [
          {
            icon: 'home',
            route: '/',
            label: 'Home'
          },
          {
            icon: '',
            route: '/permissoes',
            label: 'Permissoes'
          },
          {
            icon: '',
            label: 'Visualizar Grupo'
          }
        ],
        back: '/permissoes'
      },
      loading: false,
      users: [],
      rolePermissions: []
    }
  },
  mounted () {
    this.fetch()
  },
  methods: {
    fetch () {
      this.$store.dispatch('permissions/selectRole', this.$route.params.id).then(() => {
        this.setPermissions()
        this.$axios.get(`/role/${this.selectedRole.id}/users`).then(response => {
          this.users = response.data
        }).catch(error => {
          console.error(error)
          this.$q.notify({
            message: 'Não foi possivel carregar os usuários para esse grupo',
            color: 'negative'
          })
        })
      })
    },
    setPermissions () {
      this.rolePermissions = this.permissions.map(permission => {
        return {
          id: permission.id,
          name: permission.name,
          has: this.roleHasPermission(permission.name)
        }
      })
    },
    roleHasPermission (permission) {
      return this.selectedRole.permissions.includes(permission)
    },
    confirmPermissions () {
      this.loading = true
      let userRoles = this.addRolesList.filter(role => role.has).map(role => role.name)
      this.$store.dispatch('permissions/syncUserRoles', {
        roles: userRoles,
        user_id: this.selectedUser.id
      }).then(() => {
        this.loading = false
        this.roleDialog = false
        this.fetch()
      }).catch(error => {
        this.$q.notify({
          message: error,
          color: 'negative'
        })
      })
    },
    sync () {
      this.$q.loading.show({
        message: 'Atualizando permissões'
      })
      this.$store.dispatch('permissions/syncRolePermissions', {
        role_id: this.selectedRole.id,
        permissions: this.rolePermissions.filter(permission => permission.has).map(permission => permission.name)
      }).then(() => {
        this.$store.dispatch('permissions/searchUsers')
        this.$q.notify({
          message: 'Permissões sincronizadas com sucesso'
        })
      }).catch(error => {
        console.error(error)
        this.$q.notify({
          message: 'Ocorreu um erro ao tentar sincronizar as permissões, tente novamente'
        })
      }).finally(() => {
        this.$q.loading.hide()
      })
    },
    removeRole () {
      this.$q.dialog({
        title: 'Apagar ' + this.selectedRole.name,
        message: `Tem certeza que deseja apagar ${this.selectedRole.name}? Esta ação não pode ser desfeita!`,
        cancel: {
          label: 'Cancelar'
        }
      }).onOk(() => {
        this.$q.loading.show({
          message: 'Apagando...'
        })
        this.$axios.delete(`/role/${this.selectedRole.id}`).then(response => {
          this.$q.notify({
            message: 'Grupo excluido',
            color: 'positive'
          })
          this.$router.push('/permissoes')
        }).catch(error => {
          console.error(error)
          this.$q.notify({
            message: 'Ouve um erro ao tentar excluir este grupo',
            color: 'negative'
          })
        }).finally(() => {
          this.$q.loading.hide()
        })
      })
    }
  }
}
</script>
<style lang="scss">
.permission-list{
  max-height: 350px;
  overflow: auto;
}
</style>
