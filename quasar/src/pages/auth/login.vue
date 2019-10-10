<template>
  <div class="row">
    <div class='col-md-3 fixed-center'>
        <q-card>
          <q-card-section class="card-header">
            <span class="text-h4 ">
              Login
            </span>
          </q-card-section>
          <q-card-section>
            <br>
            <q-input square outlined v-model="email" label="email" >
              <template v-slot:before>
                <q-icon name="person" />
              </template>
            </q-input>
          </q-card-section>
          <q-card-section>
            <q-input square outlined v-model="password" type='password' label="Senha" >
              <template v-slot:before>
                <q-icon name="vpn_key" />
              </template>
            </q-input>
          </q-card-section>
          <q-card-section>
             <q-btn color="primary" text-color="white" label="Entrar" />
             <q-btn color="secondary" text-color="white" label="Cadastrar" to="/cadastro"/>
          </q-card-section>
        </q-card>
    </div>
  </div>
</template>
<script>
export default {
  data () {
    return {
      email: '',
      password: ''
    }
  },
  methods: {
    submit () {
      this.$axios.post('auth/login', {
        email: this.email,
        password: this.password
      }).then(response => {
        console.log(response)
      })
    }
  }
}
</script>
<style lang="scss" >
.card-header{
  background-color: $primary;
}
.card-header .text-h4{
  color: white;
}

</style>
