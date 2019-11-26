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
                  Cadastrar Procedimento
                </span>
                <q-separator/>
              </q-card-section>
              <q-card-section>
                <q-form ref="form" @submit.prevent = 'submit' autofocus greedy>
                  <div class="row">
                     <div class="col-md-12">
                     <q-select square dense outlined v-model="form.grupo_procedimento_id" :options="options" label="Grupo" class="q-mb-lg"/>
                     </div>
                    <div class="col-md-4">
                  <q-input class="q-mb-xs" mask="###########" square dense outlined ref="codigo" v-model="form.codigo" label="Código" :rules="rules.codigo" lazy-rules />
                    </div>
                 <div class="col-md-12">
                  <q-input square dense outlined ref="procedimento" v-model="form.procedimento" label="Nome do Procedimento" :rules="rules.procedimento" lazy-rules />
                      </div>
                      <div class="col-md-2">
                  <q-select square dense outlined v-model="form.status" :options="status" label="Status" class="q-mb-sm"/>
                     </div>
                      </div>
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
import { mapGetters } from 'vuex'
import defaultPageHeader from '../../../components/defaultPageHeader'

export default {
  components: {
    defaultPageHeader
  },

  computed: {
    ...mapGetters('grupoprocedimento', [
      'grupoprocedimentos'
    ])
  },
  data () {
    return {
      options: [],
      value: [],
      headerConfig: [
        {
          icon: 'home',
          route: '/home',
          label: 'Home'
        },
        {
          icon: 'business',
          route: '/procedimento',
          label: 'Procedimento'
        },
        {
          icon: 'person',
          route: '/criar',
          label: 'Cadastro'
        }
      ],
      form: {
        codigo: null,
        procedimento: null,
        status: null,
        grupo_procedimento_id: null
      },
      rules: {
        codigo: [
          val => val !== null || 'Campo Obrigatório',
          val => val.length > 1 || 'O código deve ter ao menos 2 números',
          val => val.length < 12 || 'O código deve ter no máximo 11 números'
        ],
        procedimento: [
          val => val !== null || 'Campo Obrigatório',
          val => val.length > 4 || 'O código deve ter ao menos 5 caracteres'
        ]
      },
      status: [
        'Ativado',
        'Desativado'
      ]
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
        this.$axios.post('/procedimento', this.form).then(response => {
          console.log(response)
          this.$q.notify({
            message: 'Procedimento cadastrado com sucesso',
            color: 'positive'
          })
          this.$router.push('/procedimento')
          this.$store.dispatch('procedimento/refresh')
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
  },
  mounted () {
    this.$axios.get('/grupoprocedimento').then(response => {
      this.options = response.data.map(item => {
        return {
          label: item.descricao,
          value: item.id
        }
      })
    })
  }
}
</script>
