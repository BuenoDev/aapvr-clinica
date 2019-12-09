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
                  Cadastrar Convênios
                </span>
                <q-separator/>
              </q-card-section>
              <q-card-section>
                <q-form ref="form" @submit.prevent = 'submit' autofocus greedy>
                  <div class="row">
                  <div class="col-4">
                  <q-toggle v-model="form.tipo" ref="tipo" label="Particular" lazy-rules/>
                  </div>
                  </div>
                  <div class="row">
                  <div class="col-4">
                  <q-input class="q-mb-sm" type="number" square dense outlined ref="regans" v-model="form.regans" label="Regra ANS" :rules="rules.regans" lazy-rules />
                  </div>
                  <div class="col-9">
                  <q-input class="q-mb-sm" square dense outlined ref="nome" v-model="form.nome" label="Nome" :rules="rules.nome" lazy-rules />
                  </div>
                  </div>
                  <q-btn type="submit" label="enviar"/>
                </q-form>
              </q-card-section>
            </q-card>
          </div>
        </div>
    </div>
</template>

<script>
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
          route: '/home',
          label: 'Home'
        },
        {
          icon: 'business',
          route: '/convenio',
          label: 'Convênio'
        },
        {
          icon: 'person',
          route: '/criar',
          label: 'Cadastro'
        }
      ],
      form: {
        tipo: false,
        regans: null,
        nome: null
      },
      rules: {
        tipo: [
          val => val !== null || 'Campo Obrigatório'
        ],
        regans: [
          val => val !== null || 'Campo Obrigatório'
        ],
        nome: [
          val => val !== null || 'Campo Obrigatório',
          val => val.length > 5 || 'O Nome deve conter ao menos 5 caracteres'
        ]
      }
    }
  },
  methods: {
    addAddress () {
      this.form.enderecos.push({
        descricao: null
      })
    },
    submit () {
      this.$refs.form.validate().then(result => {
        console.log({ then: result })
        this.$axios.post('/convenio', this.form).then(response => {
          console.log(response)
          this.$q.notify({
            message: 'Convênio cadastrado com sucesso',
            color: 'positive'
          })
          this.$router.push('/convenio')
          this.$store.dispatch('convenio/refresh')
        }).catch(error => {
          console.error(error)
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
