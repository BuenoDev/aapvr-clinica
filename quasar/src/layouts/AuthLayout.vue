<template>
  <q-layout view="hHh lpR fFf">

    <q-header elevated class="bg-primary text-white">
      <q-toolbar>
        <q-toolbar-title>
          <q-avatar>
            <!-- <img src="https://cdn.quasar.dev/logo/svg/quasar-logo.svg"> -->
            <img src="https://static.wixstatic.com/media/769b46_80e632a9b8e64f80a2b12a0fce072515~mv2.png/v1/fill/w_84,h_78,al_c,q_80,usm_0.66_1.00_0.01/769b46_80e632a9b8e64f80a2b12a0fce072515~mv2.webp">
          </q-avatar>
          AAPVR - Associação de Aposentados de Volta Redonda
        </q-toolbar-title>
      </q-toolbar>
    </q-header>

    <q-page-container>
      <router-view />
    </q-page-container>

  </q-layout>
</template>

<script>
export default {
  data () {
    return {
    }
  }
}
</script>
