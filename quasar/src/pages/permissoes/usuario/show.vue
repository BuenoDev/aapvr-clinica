<template>
  <div v-if="user" class="q-pa-md">
    <default-page-header :config="header.config" :backTo="header.back" />
    <q-card class="q-ma-lg">
      <q-card-section>
        <span class="text-h4" style="color:black">
          {{ user.name }}
        </span>
      </q-card-section>
      <q-card-section>
        <div class="row">
          <div class="col-3">
            <h5>
              Grupos
            </h5>
            <q-list bordered separator>
              <q-item clickable v-ripple v-for="role in user.roles" :key="role">
                <q-item-section>
                  {{ role }}
                </q-item-section>
                <q-item-section side>
                  <q-icon color="negative" name="delete" style="font-size: x-large"/>
                </q-item-section>
              </q-item>
            </q-list>
          </div>
          <div class="col-4 offset-3">
            <h5>
              Permissões
            </h5>
            <q-list bordered separator>
              <q-item clickable v-ripple v-for="permission in user.permissions" :key="permission">
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
  </div>
</template>
<script>
// import mapGetters from 'Vuex'
import defaultPageHeader from '../../../components/defaultPageHeader'
export default {
  // computed: {
  //   ...mapGetters('permissions', [
  //     ''
  //   ])
  // },
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
      user: null
    }
  },
  beforeCreate () {
    this.$store.dispatch('permissions/getUser', this.$route.params.id).then(user => {
      this.user = user
    })
  }
}
</script>
