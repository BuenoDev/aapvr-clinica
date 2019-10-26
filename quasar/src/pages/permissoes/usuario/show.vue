<template>
  <div v-if="selected" class="q-pa-md">
    <default-page-header :config="header.config" :backTo="header.back" />
    <q-card class="q-ma-lg">
      <q-card-section>
        <span class="text-h4" style="color:black">
          {{ selected.name }}
        </span>
        <br>
        <span class="text-h7">
          {{ selected.email }}
        </span>
      </q-card-section>
      <q-separator/>
      <q-card-section>
        <div class="row">
          <div class="col-md-3 col-sm-12">
            <span class="text-h5">
              Grupos
            </span>
            <q-btn size="sm" class="q-ml-md" @click="openRoleDialog" :disabled="this.roles.length === 0">
              Adicionar
            </q-btn>
            <q-list bordered separator v-if="this.selected.roles.length > 0" class="q-mt-md">
              <q-item clickable v-ripple v-for="role in selected.roles" :key="role">
                <q-item-section>
                  {{ role }}
                </q-item-section>
                <q-item-section side>
                  <q-icon color="negative" name="delete" style="font-size: x-large" @click="removeRole(role)"/>
                </q-item-section>
              </q-item>
            </q-list>
            <p  v-if="this.selected.roles.length === 0" class="q-mt-md">
              Este usuário nao pertence a nenhum grupo
            </p>
          </div>
          <div class="col-md-4 offset-md-3 col-sm-12">
            <span class="text-h5">
              Permissões
            </span>
            <q-btn size="sm" class="q-ml-md" @click="openPermissionDialog" :disabled="this.roles.length === 0">
              Adicionar
            </q-btn>
            <q-list bordered separator class="q-mt-md">
              <q-item clickable v-ripple v-for="permission in selected.permissions" :key="permission">
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
    <q-dialog v-model="roleDialog" @hide="setRolesList">
      <q-card>
        <q-card-section class="row items-center">
          <div class="text-h6">Atribuir grupo</div>
          <q-space />
          <q-btn icon="close" flat round dense v-close-popup />
        </q-card-section>

        <q-card-section>
          <div class="row" v-for="(role, index) in addRolesList" :key="index" >
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
          <q-btn @click="confirmRoles" :loading="loading" class="full-width">
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
      'roles',
      'selected'
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
      roleDialog: false,
      permissiomDialog: false,
      loading: false,
      addRolesList: []
    }
  },
  mounted () {
    this.fetch()
  },
  methods: {
    fetch () {
      this.$store.dispatch('permissions/getUser', this.$route.params.id).then(() => {
        this.setRolesList()
      })
    },
    setRolesList () {
      this.addRolesList = this.roles.map(role => {
        return {
          id: role.id,
          name: role.name,
          has: this.userHasRole(role.name)
        }
      })
    },
    userHasRole (role) {
      return this.selected.roles.includes(role)
    },
    removeRole (role) {
      this.$store.dispatch('permissions/revokeRole', {
        user: this.selected.id,
        role: role
      }).then(() => {
        this.fetch()
      })
    },
    openRoleDialog () {
      this.roleDialog = true
    },
    openPermissionDialog () {
      this.permissiomDialog = true
    },
    confirmRoles () {
      this.loading = true
      let userRoles = this.addRolesList.filter(role => role.has).map(role => role.name)
      console.log(userRoles)
      this.$store.dispatch('permissions/syncUserRoles', {
        roles: userRoles,
        user_id: this.selected.id
      }).then(() => {
        this.loading = false
        this.roleDialog = false
        this.fetch()
      })
    }
  }
}
</script>
