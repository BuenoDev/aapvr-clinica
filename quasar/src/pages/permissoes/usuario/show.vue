<template>
  <div v-if="selectedUser" class="q-pa-md">
    <default-page-header :config="header.config" :backTo="header.back" />
    <q-card class="q-ma-lg">
      <q-card-section>
        <span class="text-h4" style="color:black">
          {{ selectedUser.name }}
        </span>
        <br>
        <span class="text-h7">
          {{ selectedUser.email }}
        </span>
      </q-card-section>
      <q-separator/>
      <q-card-section>
        <div class="row">
          <div class="col-md-3 col-sm-12">
            <span class="text-h5">
              Grupos
            </span>
            <q-btn size="sm" class="q-ml-md" @click="syncRoles" :disabled="!this.roleChanged" :loading="loading">
              Sincronizar
            </q-btn>
            <q-list bordered separator dense class="q-mt-md">
              <q-item :clickable="!authUser.can('editar-permissoes')" v-ripple v-for="role in userRoles" :key="role.id">
                <q-item-section>
                  {{ role.name }}
                </q-item-section>
                <q-item-section side>
                  <q-toggle v-model="role.has" :disabled="!authUser.can('editar-permissoes')" @input="roleChanged = true" :key="role.id"/>
                </q-item-section>
              </q-item>
            </q-list>
          </div>
          <div class="col-md-4 offset-md-3 col-sm-12">
            <span class="text-h5">
              Permissões
            </span>
            <q-btn size="sm" class="q-ml-md" @click="syncPermissions" :disabled="!this.permissionChanged" :loading="loading">
              Sincronizar
            </q-btn>
            <q-list bordered separator dense class="q-mt-md">
              <q-item clickable v-ripple v-for="permission in userPermissions" :key="permission.id">
                <q-item-section>
                  {{ permission.name }}
                </q-item-section>
                <q-item-section side>
                  <q-toggle v-model="permission.can" :disabled="!authUser.can('editar-permissoes')" @input="permissionChanged = true" :key="permission.id"/>
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
      'roles',
      'permissions',
      'selectedUser'
    ]),
    ...mapGetters('auth', [
      'authUser'
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
            route: '/show',
            label: 'Visualizar usuário'
          }
        ],
        back: '/permissoes'
      },
      userRoles: [],
      userPermissions: [],
      roleChanged: false,
      permissionChanged: false,
      loading: false
    }
  },
  mounted () {
    this.fetch()
  },
  methods: {
    fetch () {
      this.$store.dispatch('permissions/selectUser', this.$route.params.id).then(() => {
        this.setUserRoles()
        this.setUserPermissions()
      })
    },
    setUserRoles () {
      this.userRoles = this.roles.map(role => {
        return {
          id: role.id,
          name: role.name,
          has: this.userHasRole(role.name)
        }
      })
    },
    setUserPermissions () {
      this.userPermissions = this.permissions.map(permission => {
        return {
          id: permission.id,
          name: permission.name,
          can: this.can(permission.name)
        }
      })
    },
    can (permission) {
      return this.selectedUser.permissions.includes(permission)
    },
    userHasRole (role) {
      return this.selectedUser.roles.includes(role)
    },
    syncRoles () {
      this.loading = true
      let userRoles = this.userRoles.filter(role => role.has).map(role => role.name)
      this.$store.dispatch('permissions/syncUserRoles', {
        roles: userRoles,
        user_id: this.selectedUser.id
      }).then(() => {
        this.fetch()
        this.loading = false
        this.roleChanged = false
        this.permissionChanged = false
        this.$q.notify('Grupos alterados!')
      }).catch(error => {
        this.$q.notify({
          message: error,
          color: 'negative'
        })
      })
    },
    syncPermissions () {
      this.loading = true
      let userPermissions = this.userPermissions.filter(permissions => permissions.can).map(role => role.name)
      this.$store.dispatch('permissions/syncUserPermissions', {
        permissions: userPermissions,
        user_id: this.selectedUser.id
      }).then(() => {
        this.fetch()
        this.loading = false
        this.roleChanged = false
        this.permissionChanged = false
      }).catch(error => {
        this.$q.notify({
          message: error,
          color: 'negative'
        })
      })
    }
  }
}
</script>
