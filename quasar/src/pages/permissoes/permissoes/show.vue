<template>
  <div v-if="selectedPermission" class="q-pa-md">
    <default-page-header :config="header.config" :backTo="header.back" />
    <q-card class="q-ma-lg">
      <q-card-section>
        <span class="text-h4" style="color:black">
          {{ selectedPermission.name }}
        </span>
        <br>
      </q-card-section>
      <q-separator/>
      <q-card-section>
        <div class="row">
          <div class="col-md-4 col-sm-12">
            <span class="text-h5">
              Grupos
            </span>
            <q-list bordered separator class="q-mt-md permission-list">
              <q-item clickable v-ripple v-for="role in roles" :key="role.id">
                <q-item-section>
                  {{ role.name }}
                </q-item-section>
                <q-item-section side>
                    <q-btn
                      size="sm"
                      color="primary"
                      icon="visibility"
                      :to="`/permissoes/grupos/${role.id}`"
                      :loading="loading"
                    />
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
      'selectedPermission'
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
      roles: []
    }
  },
  mounted () {
    this.fetch()
  },
  methods: {
    fetch () {
      this.$store.dispatch('permissions/selectPermission', this.$route.params.id).then(() => {
        this.$axios.get(`/permission/${this.selectedPermission.id}/roles`).then(response => {
          this.roles = response.data
        }).catch(error => {
          console.error(error)
          this.$q.notify({
            message: 'Não foi possivel carregar os grupos ligados a essa permissão.',
            color: 'negative'
          })
        })
        this.$axios.get(`/permission/${this.selectedPermission.id}/users`).then(response => {
          this.users = response.data
        }).catch(error => {
          console.error(error)
          this.$q.notify({
            message: 'Não foi possivel carregar os usuários ligados a essa permissão.',
            color: 'negative'
          })
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
