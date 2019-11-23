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
                  Cadastrar Grupo de Procedimento
                </span>
                <q-separator/>
              </q-card-section>
              <q-card-section>
                <q-form ref="form" @submit.prevent = 'submit' autofocus greedy>
                  <q-input class="q-mb-sm" square dense outlined ref="descricao" v-model="form.descricao" label="descrição" :rules="rules.descricao" lazy-rules />
                 <!-- telefones -->
                 <!-- endereços -->
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
          route: '/grupoprocedimento',
          label: 'Grupo Procedimento'
        },
        {
          icon: 'person',
          route: '/criar',
          label: 'Cadastro'
        }
      ],
      form: {
        descricao: null
      },
      rules: {
        descricao: [
          val => val !== null || 'Campo Obrigatório',
          val => val.length > 5 || 'A descrição deve ter ao menos 5 caracteres'
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
        this.$axios.post('/grupoprocedimento', this.form).then(response => {
          console.log(response)
          this.$q.notify({
            message: 'Grupo cadastrado com sucesso',
            color: 'positive'
          })
          this.$router.push('/grupoprocedimento')
          this.$store.dispatch('grupoprocedimento/refresh')
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
