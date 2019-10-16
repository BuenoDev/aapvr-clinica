<template>
  <q-layout view="hHh lpR lFf">

    <q-header elevated class="bg-primary text-white">
      <q-toolbar>
        <q-btn dense flat round icon="menu" @click="left = !left" />

        <q-toolbar-title>
          <q-avatar>
            <img src="https://cdn.quasar.dev/logo/svg/quasar-logo.svg">
             <!-- <img src="https://static.wixstatic.com/media/769b46_80e632a9b8e64f80a2b12a0fce072515~mv2.png/v1/fill/w_84,h_78,al_c,q_80,usm_0.66_1.00_0.01/769b46_80e632a9b8e64f80a2b12a0fce072515~mv2.webp" > -->
          </q-avatar>
          AAPVR - Associação de Aposentados de Volta Redonda
        </q-toolbar-title>
        <span @click="logout">
          Sair
        </span>
      </q-toolbar>
    </q-header>

    <q-drawer show-if-above v-model="left" side="left" elevated :width="220">
      <!-- drawer content -->
          <q-img class="absolute-top" src="https://cdn.quasar.dev/img/material.png" style="height: 150px">
            <div class="absolute-bottom bg-transparent" v-if="authUser">
              <q-avatar size="56px" class="q-mb-sm">
                <img src="https://cdn.quasar.dev/img/boy-avatar.png">
              </q-avatar>
              <div class="text-weight-bold">{{ authUser.name }}</div>
              <div>{{ authUser.email }}</div>
            </div>
          </q-img>
        <q-list padding class="menu-list" style="margin-top:150px">
          <q-item :active="activeRoute === '/home'" to="home" clickable v-ripple>
              <q-item-section avatar>
                <q-icon name="pie_chart" />
              </q-item-section>
              <q-item-section>
                Dashboard
              </q-item-section>
          </q-item>
          <q-item :active="activeRoute === '/agenda'" to="agenda" clickable v-ripple>
              <q-item-section avatar>
                <q-icon name="calendar_today" />
              </q-item-section>
              <q-item-section>
                Agenda
              </q-item-section>
          </q-item>
          <q-item :active="activeRoute === '/prontuario'" to="prontuario" clickable v-ripple>
              <q-item-section avatar>
                <q-icon name="file_copy" />
              </q-item-section>
              <q-item-section>
                Prontuario
              </q-item-section>
          </q-item>
          <q-item :active="activeRoute === '/turmas'" clickable v-ripple>
              <q-item-section avatar>
                <q-icon name="people" />
              </q-item-section>
              <q-item-section>
                Turmas
              </q-item-section>
          </q-item>
          <q-item :active="activeRoute === '/financeiro'" clickable v-ripple>
              <q-item-section avatar>
                <q-icon name="attach_money" />
              </q-item-section>
              <q-item-section>
                Financeiro
              </q-item-section>
          </q-item>
        </q-list>
    </q-drawer>

    <q-page-container>
      <router-view />
    </q-page-container>

    <!-- <q-footer class="bg-grey-8 text-white">
      <q-toolbar>
        <q-toolbar-title>
          <q-avatar>
            <img src="https://cdn.quasar.dev/logo/svg/quasar-logo.svg">
          </q-avatar>
          Title
        </q-toolbar-title>
      </q-toolbar>
    </q-footer> -->

  </q-layout>
</template>

<script>
import { mapGetters } from 'vuex'

export default {
  data () {
    return {
      left: false
    }
  },
  computed: {
    ...mapGetters('auth', [
      'authUser'
    ])
  },
  methods: {
    activeRoute () {
      return this.$router.currentRoute.fullPath
    },
    logout () {
      this.$store.dispatch('auth/logout').then(response => {
        this.$q.notify('O usuário foi desconectado com sucesso!')
        this.$router.push('/login')
      }).catch(error => {
        console.error(error)
      })
    }
  },
  mounted () {
    this.$q.loading.show({
      message: 'Buscando informações do usuário'
    })
    this.$store.dispatch('auth/fetchUser').then(response => {
      this.$q.loading.hide()
    }).catch(error => {
      console.log('status:' + error.request.status)
      this.$q.loading.hide()
      this.$store.dispatch('auth/logout').finally(() => {
        this.$router.push('/login')
      })
    })
  }
}
</script>
