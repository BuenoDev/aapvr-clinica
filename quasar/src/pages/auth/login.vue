<template>
  <div class="row">
    <div class='col-md-3 fixed-center'>
        <q-card>
          <q-card-section class="card-header">
            <span class="text-h5" style="color: white;">
              Login
            </span>
          </q-card-section>
          <q-card-section>
            <form @submit="login">
              <!-- email -->
              <q-card-section>
                <q-input square outlined v-model="form.email" ref="email" type="email" label="email" :rules="[val => val.length > 0 || 'Digite seu email']" lazy-rules>
                  <template v-slot:before>
                    <q-icon name="person" />
                  </template>
                </q-input>
              </q-card-section>
              <!-- password -->
              <q-card-section>
                <q-input square outlined v-model="form.password" ref="password" type='password' label="Senha"  :rules="[val => val.length > 0 || 'Digite sua senha']" lazy-rules>
                  <template v-slot:before>
                    <q-icon name="vpn_key" />
                  </template>
                </q-input>
              </q-card-section>
              <!-- remember checkbox -->
              <q-card-section>
                <q-checkbox v-model="form.remember" label="Lembrar-me"/>
              </q-card-section>
              <!-- btn group -->
              <q-card-section>
                <q-btn color="primary" class="full-width q-mb-sm" text-color="white" label="Entrar" type="submit"/>
                <q-btn color="secondary" class="full-width" text-color="white" label="Cadastrar" to="/cadastro"/>
              </q-card-section>
            </form>
          </q-card-section>
        </q-card>
    </div>
  </div>
</template>
<script>
import { mapGetters } from 'vuex'
export default {
  data () {
    return {
      form: {
        email: '',
        password: '',
        remember: false
      }
    }
  },
  computed: {
    ...mapGetters('auth', [
      'token'
    ])
  },
  methods: {
    login () {
      this.$refs.email.validate()
      this.$refs.password.validate()
      console.log('log')
      if (
        this.$refs.email.hasError ||
        this.$refs.password.hasError
      ) {
        this.$q.notify('Verifique seu email e senha e tente novamente')
      } else {
        this.$store.dispatch('auth/rememberMe', this.remember)
        this.$store.dispatch('auth/login', this.form)
          .then(response => {
            this.$router.push('/home')
          })
          .catch(error => {
            var msg
            switch (error.request.status) {
              case 0:
                msg = 'Sem conexão a internet. Verifique sua conexão e tente mais tarde.'
                break
              case 401:
                msg = 'Usuário ou senha inválidas. Por favor,verifique suas credenciais e tente novamente.'
                break
              default:
                msg = 'Houve um erro inesperado. Codigo ' + error.request.status
            }
            this.$q.notify({
              message: msg,
              color: 'negative'
            })
            console.error(error)
          })
      }
    }
  },
  beforeCreate () {
    this.$store.dispatch('auth/loginWithToken').then(resolve => {
      if (resolve) this.$router.push('/home')
    })
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
