<template>
  <div v-if="selectedRole" class="q-pa-md">
    <default-page-header :config="header.config" :backTo="header.back" />
    <q-card class="q-ma-lg">
      <q-card-section>
        <span class="text-h4" style="color:black">
          {{ selectedRole.name }}
        </span>
        <br>
        <span class="text-h7">
          {{ selectedRole.email }}
        </span>
      </q-card-section>
      <q-separator/>
      <q-card-section>
        <div class="row">
          <div class="col-md-6 col-sm-12">
            <span class="text-h5">
              Permissões
            </span>
            <q-btn size="sm" class="q-ml-md" @click="openPermissionDialog" :disabled="true">
              Adicionar
            </q-btn>
            <q-list bordered separator class="q-mt-md permission-list">
              <q-item clickable v-ripple v-for="permission in selectedRole.permissions" :key="permission">
                <q-item-section>
                  {{ permission }}
                </q-item-section>
                <q-item-section side>
                  <q-icon color="negative" name="delete" style="font-size: x-large"/>
                </q-item-section>
              </q-item>
            </q-list>

          </div>
        </div>
      </q-card-section>
    </q-card>
    <q-dialog v-model="roleDialog" @hide="setPermissionsList">
      <q-card>
        <q-card-section class="row items-center">
          <div class="text-h6">Atribuir grupo</div>
          <q-space />
          <q-btn icon="close" flat round dense v-close-popup />
        </q-card-section>

        <q-card-section>
          <div class="row" v-for="(role, index) in addPermissionsList " :key="index" >
            <div class="col-8">
              {{ role.name }}
            </div>
            <div class="col-4">
              <q-toggle
                v-model="role.has"
              />
            </div>
            <q-separator/>
          </div>
        </q-card-section>
        <q-card-section>
          <q-btn @click="confirmPermissions" :loading="loading" class="full-width">
            Confirmar
          </q-btn>
        </q-card-section>
      </q-card>
    </q-dialog>
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
      roleDialog: false,
      permissiomDialog: false,
      loading: false,
      addPermissionsList: []
    }
  },
  mounted () {
    this.fetch()
  },
  methods: {
    fetch () {
      this.$store.dispatch('permissions/getRole', this.$route.params.id).then(() => {
        // this.setPermissionsList()
      })
    },
    setPermissionsList () {
      this.addPermissionsList = this.permissions.map(permission => {
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
    // removeRole (role) {
    //   this.$store.dispatch('permissions/revokeRole', {
    //     user: this.selectedUser.id,
    //     role: role
    //   }).then(() => {
    //     this.fetch()
    //   })
    // },
    openPermissionDialog () {
      this.permissiomDialog = true
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
