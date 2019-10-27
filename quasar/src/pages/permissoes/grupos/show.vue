<template>
  <div v-if="selectedRole" class="q-pa-md">
    <default-page-header :config="header.config" :backTo="header.back" />
    <q-card class="q-ma-lg">
      <q-card-section>
        <span class="text-h4" style="color:black">
          {{ selectedRole.name }}
        </span>
        <br>
      </q-card-section>
      <q-separator/>
      <q-card-section>
        <div class="row">
          <div class="col-md-6 col-sm-12">
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
      rolePermissions: []
    }
  },
  mounted () {
    this.fetch()
  },
  methods: {
    fetch () {
      this.$store.dispatch('permissions/getRole', this.$route.params.id).then(() => {
        this.setPermissions()
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
