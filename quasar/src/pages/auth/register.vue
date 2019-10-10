<template>
  <div class="container">
    <div class="row">
      <div class="col-sm-5 col-xs-12 fixed-center">
        <q-card class="my-card">
          <q-card-section class="card-header">
            <span class="text-h4 ">
              Cadastro
            </span>
          </q-card-section>
          <q-separator />
          <q-card-section>
          <q-input class="q-mb-sm" square outlined ref="name" v-model="form.name" label="Nome" :rules="rules.name" lazy-rules>
            <template v-slot:before>
              <q-icon name="person" />
            </template>
          </q-input>
          <q-input class="q-mb-sm" square outlined ref="email" v-model="form.email" label="Email" :rules="rules.email" lazy-rules>
            <template v-slot:before>
              <q-icon name="mail" />
            </template>
          </q-input>
          <q-input class="q-mb-sm" square outlined ref="password" v-model="form.password" type='password' label="Senha" :rules="rules.password"  lazy-rules>
            <template v-slot:before>
              <q-icon name="vpn_key" />
            </template>
          </q-input>
          <q-input class="q-mb-sm" square outlined ref="verify" v-model="verifyPassword" type='password' label="Verificar Senha" :rules="rules.verifyPassword"  lazy-rules>
            <template v-slot:before>
              <q-icon name="lock_open" />
            </template>
          </q-input>
          </q-card-section>
          <q-card-section class="row justify-end">
            <q-btn class="full-width" color="primary" text-color="white" label="Enviar" @click="submit"/>
          </q-card-section>
        </q-card>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  data () {
    return {
      form: {
        name: '',
        email: '',
        password: ''
      },
      verifyPassword: '',
      rules: {
        name: [
          val => val.length > 5 || 'O nome deve ter no minimo 5 caracteres!'
        ],
        email: [
          val => (val.includes('@') && val.includes('.com')) || 'Digite o email em um formato válido!'
        ],
        password: [
          val => val.length >= 6 || 'A senha precisa ter ao menos 6 caracteres.'
        ],
        verifyPassword: [
          val => val === this.form.password || 'O valor digitado não corresponde a senha.'
        ]
      }
    }
  },
  methods: {
    submit () {
      this.$refs.name.validate()
      this.$refs.email.validate()
      this.$refs.password.validate()

      if (
        this.$refs.name.hasError ||
        this.$refs.email.hasError ||
        this.$refs.password.hasError
      ) {
        this.$q.notify({
          color: 'negative',
          message: 'Verifique o formulario e tente novamente'
        })
      } else {
        this.$axios.post('/register', this.form).then(response => {
          console.log(response)
          this.$router.push('/login')
          this.$q.notify('Usuário Criado com sucesso')
        }).catch(error => {
          console.log(error)
        })
      }
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
