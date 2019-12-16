<template>
    <div class="q-mt-lg">
       <default-page-header
        :config="headerConfig"
        backTo="home"
        />
        <div class="row justify-center">
          <div class="col-lg-6 col-md-8 col-sm-12">
            <q-card class=" q-mb-xl q-mt-lg">
              <q-card-section >
                <span class="text-h5" style="color:black">
                  Cadastrar Tipo de Prestador
                </span>
                <q-separator/>
              </q-card-section>
              <q-card-section>
                <q-form ref="form" @submit.prevent = 'submit' autofocus greedy>
                  <q-input class="q-mb-sm" square dense outlined ref="nome" v-model="form.nome" label="nome" :rules="rules.nome" lazy-rules />
                  <q-btn type="submit" label="enviar"/>
                </q-form>
              </q-card-section>
            </q-card>
          </div>
        </div>
    </div>
</template>

<script>
// import axios from 'axios'
import defaultPageHeader from '../../../components/defaultPageHeader'

export default {
  components: {
    defaultPageHeader
  },
  data () {
    return {
      headerConfig: [
        {
          icon: 'home',
          route: '/',
          label: 'Home'
        },
        {
          icon: 'person',
          route: '/tipo-prestador',
          label: 'Tipo de Prestador'
        },
        {
          icon: 'person',
          route: '/criar',
          label: 'cadastro'
        }
      ],
      form: {
        nome: null
      },
      rules: {
        nome: [
          val => val !== null || 'Campo Obrigatório',
          val => val.length > 5 || 'O nome deve ter ao menos 5 caracteres'
        ]
      }
    }
  },
  methods: {
    submit () {
      this.$refs.form.validate().then(result => {
        this.$axios.post('/tipo-prestador', this.form).then(response => {
          console.log(response)
          this.$q.notify({
            message: 'Tipo de Prestador cadastrado com sucesso',
            color: 'positive'
          })
          this.$router.push('/tipo-prestador')
          // this.$store.dispatch('especialidade/refresh')
        }).catch(error => {
          this.$q.notify({
            message: error.message,
            color: 'negative'
          })
        })
      }).catch(error => {
        console.error(error)
        this.$q.notify({
          message: 'Verifique o formulário e tente novamente',
          color: 'negative'
        })
      })
    }
  }
}

</script>
