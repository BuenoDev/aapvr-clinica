<template>
  <div class="fixed-center">
    <h1>Agenda</h1>
  </div>
</template>
<script>
import { mapGetters } from 'vuex'
export default {
  computed: {
    ...mapGetters('auth', [
      'authUser'
    ])
  },
  mounted () {
    console.log({
      user: this.authUser,
      can: this.authUser.can('visualizar-agenda'),
      role: this.authUser.hasRole('admin')
    })
  }
}
</script>
