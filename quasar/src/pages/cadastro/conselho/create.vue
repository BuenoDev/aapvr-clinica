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
                  Cadastrar Conselhos
                </span>
                <q-separator/>
              </q-card-section>
              <q-card-section>
                <q-form ref="form" @submit.prevent = 'submit' autofocus greedy>
                  <div class="row">
                  <div class="col-3">
                  <q-input class="q-mb-sm" type="number" square dense outlined ref="numero" v-model="form.numero" label="Número" :rules="rules.numero" lazy-rules />
                  </div>
                  </div>
                  <div class="row">
                  <div class="col-2">
                  <q-input class="q-mb-sm" square dense outlined ref="sigla" v-model="form.sigla" label="Sigla" :rules="rules.sigla" lazy-rules />
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
          route: '/conselho',
          label: 'Conselho'
        },
        {
          icon: 'person',
          route: '/criar',
          label: 'Cadastro'
        }
      ],
      form: {
        numero: null,
        sigla: null,
        nome: null
      },
      rules: {
        numero: [
          val => val !== null || 'Campo Obrigatório'
        ],
        sigla: [
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
        this.$axios.post('/conselho', this.form).then(response => {
          console.log(response)
          this.$q.notify({
            message: 'Conselho cadastrado com sucesso',
            color: 'positive'
          })
          this.$router.push('/conselho')
          this.$store.dispatch('conselho/refresh')
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
