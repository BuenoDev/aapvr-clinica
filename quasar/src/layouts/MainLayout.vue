<template>
  <q-layout view="hHh lpR lFf">

    <q-header elevated class="bg-primary text-white">
      <q-toolbar>
        <q-btn dense flat round icon="menu" @click="left = !left" />

        <q-toolbar-title>
          <q-avatar>
            <img src="/statics/logo.webp">
             <!-- <img src="https://static.wixstatic.com/media/769b46_80e632a9b8e64f80a2b12a0fce072515~mv2.png/v1/fill/w_84,h_78,al_c,q_80,usm_0.66_1.00_0.01/769b46_80e632a9b8e64f80a2b12a0fce072515~mv2.webp" > -->
          </q-avatar>
          AAPVR - Associação de Aposentados e Pensionistas de Volta Redonda
        </q-toolbar-title>
        <span @click="logout">
          Sair
        </span>
      </q-toolbar>
    </q-header>

    <q-drawer show-if-above v-model="left" side="left" elevated :width="220"  v-if="authUser" >
      <!-- drawer content -->
        <q-img class="absolute-top" src="/statics/material.png" style="height: 110px; z-index: 2">
            <div class="absolute-bottom bg-transparent">
              <!-- <q-avatar size="56px" class="q-mb-sm">
                <img src="https://cdn.quasar.dev/img/boy-avatar.png">
              </q-avatar> -->
              <div class="text-weight-bold">{{ authUser.name }}</div>
              <div>
                <span v-for="(role, index) in authUser.roles" :key="index">{{ role }}</span>
              </div>
              <div>{{ authUser.email }}</div>
            </div>
        </q-img>
        <q-list padding class="menu-list" style="margin-top:110px">
          <q-item :active="activeRoute === '/home'" to="/home" clickable v-ripple>
              <q-item-section avatar>
                <q-icon name="pie_chart" />
              </q-item-section>
              <q-item-section>
                Dashboard
              </q-item-section>
          </q-item>
          <q-item :active="activeRoute === '/agenda'" to="/agenda" clickable v-ripple v-if="authUser.can('visualizar-agenda')">
              <q-item-section avatar>
                <q-icon name="calendar_today" />
              </q-item-section>
              <q-item-section>
                Agenda
              </q-item-section>
          </q-item>
          <q-item :active="activeRoute === '/prontuario'" to="/prontuario" clickable v-ripple v-if="authUser.can('visualizar-prontuario')">
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
          <q-item :active="activeRoute === '/faturamento'" clickable v-ripple>
              <q-item-section avatar>
                <q-icon name="attach_money" />
              </q-item-section>
              <q-item-section>
                Financeiro
              </q-item-section>
          </q-item>
        <q-expansion-item icon="file_copy" label="Faturamento" v-if="authUser.hasRole('admin')">
            <q-item :active="activeRoute === '/grupoprocedimento'" to="/grupoprocedimento" dense clickable v-ripple v-if="authUser.hasRole('admin')" >
                <q-item-section avatar>
                  <q-icon name="add" />
                </q-item-section>
                <q-item-section>
                  Grupo
                </q-item-section>
            </q-item>
            <q-item :active="activeRoute === '/procedimento'" to="/procedimento" dense clickable v-ripple v-if="authUser.hasRole('admin')" >
                <q-item-section avatar>
                  <q-icon name="add" />
                </q-item-section>
                <q-item-section>
                  Procedimento
                </q-item-section>
            </q-item>
        </q-expansion-item>
        <q-expansion-item
          icon="settings"
          label="Configurações"
          v-if="authUser.can('visualizar-permissoes')"
        >
          <q-item :active="activeRoute === '/permissoes'" to="/permissoes" dense clickable v-ripple v-if="authUser.hasRole('admin')" >
                <q-item-section avatar>
                  <q-icon name="pan_tool" />
                </q-item-section>
                <q-item-section>
                  Grupos e permissões
                </q-item-section>
          </q-item>
          <q-expansion-item icon="supervised_user_circle" label="Cadastros" v-if="authUser.hasRole('admin')">
              <q-item :active="activeRoute === '/prestador'" to="/prestador" dense clickable v-ripple v-if="authUser.hasRole('admin')" >
                  <q-item-section avatar>
                    <q-icon name="add" />
                  </q-item-section>
                  <q-item-section>
                    Prestador
                  </q-item-section>
              </q-item>
              <q-item :active="activeRoute === '/especialidade'" to="/especialidade" dense clickable v-ripple v-if="authUser.hasRole('admin')" >
                  <q-item-section avatar>
                    <q-icon name="add" />
                  </q-item-section>
                  <q-item-section>
                    Especialidade
                  </q-item-section>
              </q-item>
              <q-item :active="activeRoute === '/unidade'" to="/unidade" dense clickable v-ripple v-if="authUser.hasRole('admin')" >
                  <q-item-section avatar>
                    <q-icon name="add" />
                  </q-item-section>
                  <q-item-section>
                    Unidade
                  </q-item-section>
              </q-item>
              <q-item :active="activeRoute === '/convenio'" to="/convenio" dense clickable v-ripple v-if="authUser.hasRole('admin')" >
                <q-item-section avatar>
                    <q-icon name="add" />
                  </q-item-section>
                  <q-item-section>
                  Convênio
                  </q-item-section>
              </q-item>
              <q-item :active="activeRoute === '/conselho'" to="/conselho" dense clickable v-ripple v-if="authUser.hasRole('admin')" >
                <q-item-section avatar>
                    <q-icon name="add" />
                  </q-item-section>
                  <q-item-section>
                  Conselho
                  </q-item-section>
              </q-item>
              <q-item :active="activeRoute === '/paciente'" to="/paciente" dense clickable v-ripple v-if="authUser.hasRole('admin')" >
                  <q-item-section avatar>
                    <q-icon name="add" />
                  </q-item-section>
                  <q-item-section>
                    Pacientes
                  </q-item-section>
              </q-item>
              <q-item :active="activeRoute === '/tipo-prestador'" to="/tipo-prestador" dense clickable v-ripple v-if="authUser.hasRole('admin')" >
                  <q-item-section avatar>
                    <q-icon name="add" />
                  </q-item-section>
                  <q-item-section>
                    Tipo de Prestador
                  </q-item-section>
              </q-item>

          </q-expansion-item>
        </q-expansion-item>
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
