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
            <q-input square outlined v-model="form.email" label="email" :rules="[val => val.length > 0]" lazy-rules>
              <template v-slot:before>
                <q-icon name="person" />
              </template>
            </q-input>
          </q-card-section>
          <q-card-section>
            <q-input square outlined v-model="form.password" type='password' label="Senha" >
              <template v-slot:before>
                <q-icon name="vpn_key" />
              </template>
            </q-input>
          </q-card-section>
          <q-card-section>
            <q-checkbox v-model="remember" label="Lembrar-me"/>
          </q-card-section>
          <q-card-section>
             <q-btn color="primary" class="full-width q-mb-sm" text-color="white" label="Entrar" @click="login"/>
             <q-btn color="secondary" class="full-width" text-color="white" label="Cadastrar" to="/cadastro"/>
          </q-card-section>
        </q-card>
    </div>
  </div>
</template>
<script>
export default {
  data () {
    return {
      form: {
        email: '',
        password: ''
      },
      remember: false
    }
  },
  methods: {
    login () {
      // this.$store.dispatch('auth/rememberMe', this.remember)
      this.$store.dispatch('auth/login', this.form)
        .then(response => {
          this.$router.push('/home')
          console.log(this.$store)
        })
        .catch(error => {
          this.$q.notify({
            message: 'Usuário ou senha inválidas. Por favor, tente novamente.',
            color: 'negative'
          })
          console.error(error)
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
