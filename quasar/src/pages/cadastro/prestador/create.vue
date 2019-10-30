<template>
    <div>
        <div class="row">
          <span class=text-h4>
            Cadastrar prestador
          </span>
          <div class="offset-23 col-8">
            <q-card>
              <form @submit.prevent = 'submit'>
                  <q-card-section>
                    <q-input class="q-mb-sm" square outlined ref="nome" v-model="form.nome" label="nome" :rules="rules.nome" lazy-rules />
                  </q-card-section>
                  <q-card-section>
                    <q-input class="q-mb-sm" square outlined ref="nrConselho" v-model="form.nrConselho" label="nrConselho" :rules="rules.nrConselho" lazy-rules />
                  </q-card-section>
                  <q-card-section>
                    <q-input class="q-mb-sm" square outlined ref="cpf" v-model="form.cpf" label="cpf" :rules="rules.cpf" lazy-rules />
                  </q-card-section>
                  <q-card-section>
                    <q-input class="q-mb-sm" square outlined ref="rg" v-model="form.rg" label="rg" :rules="rules.rg" lazy-rules />
                  </q-card-section>
                  <q-card-section>
                    <q-input class="q-mb-sm" square outlined ref="cep" v-model="form.cep" label="cep" :rules="rules.cep" lazy-rules />
                  </q-card-section>
                  <q-card-section>
                    <q-input class="q-mb-sm" square outlined ref="logradouro" v-model="form.logradouro" label="logradouro" :rules="rules.logradouro" lazy-rules />
                  </q-card-section>
                  <q-card-section>
                    <q-input class="q-mb-sm" square outlined ref="bairro" v-model="form.bairro" label="bairro" :rules="rules.bairro" lazy-rules />
                  </q-card-section>
                  <q-card-section>
                    <q-input class="q-mb-sm" square outlined ref="cidade" v-model="form.cidade" label="cidade" :rules="rules.cidade" lazy-rules />
                  </q-card-section>
                  <q-card-section>
                    <q-input class="q-mb-sm" square outlined ref="complemento" v-model="form.complemento" label="complemento" :rules="rules.complemento" lazy-rules />
                  </q-card-section>
                  <q-card-section>
                    <q-input class="q-mb-sm" square outlined ref="uf" v-model="form.uf" label="uf" :rules="rules.uf" lazy-rules />
                  </q-card-section>
                  <q-card-section>
                    <q-btn type="submit" label="enviar"/>
                  </q-card-section>
              </form>
            </q-card>
          </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios'
export default {
  data () {
    return {
      form: {
        nome: null,
        nrConselho: null,
        cpf: null,
        rg: null,
        cep: null,
        logradouro: null,
        bairro: null,
        cidade: null,
        complemento: null,
        uf: null,
        ativo: null
      },
      rules: {
        nome: [
          val => val.length > 5 || 'O nome deve ter ao menos 5 caracteres'
        ],
        nrConselho: [
          val => val.length || 'O numero do conselho deve ter ao menos 5 caracteres'
        ],
        cpf: [
          val => val.length || 'O cpf deve ter ao menos 5 caracteres'
        ],
        rg: [
          val => val.length || 'O rg deve ter ao menos 10 caracteres'
        ]
        // cep: [
        //   val => val.length < 8 || 'O cep deve ter ao menos 8 caracteres'
        // ],
        // logradouro: [
        //   val => val.lenght  || 'Message'
        // ],
        // bairro: [
        //   val => bool || 'Message'
        // ],
        // cidade: [
        //   val => bool || 'Message'
        // ],
        // complemento: [
        //   val => bool || 'Message'
        // ],
        // uf: [
        //   val => bool || 'Message'
        // ],
        // ativo: [
        //   val => bool || 'Message'
        // ]
      },
      mask: {
        cep: '#####-###'
      }
    }
  },
  watch: {
    'form.cep': function () {
      if (this.form.cep.length === 8) this.fetchCEP()
      // this.fetchCEP()
    }
  },
  methods: {
    fetchCEP () {
      //  this.$axios({ url: `/ws/${this.form.cep}/json`, baseURL: 'https://viacep.com.br/' }).then(response => {
      axios.get(`https://viacep.com.br/ws/${this.form.cep}/json`).then(response => {
        console.log(response)
      }).catch(error => {
        console.error(error)
        this.$q.notify({
          message: error.message,
          color: 'negative'
        })
      })
    },
    submit () {
      this.$axios.post('/prestador', this.form.data).then(response => {
        console.log(response)
      }).catch(error => {
        console.error(error)
        this.$q.notify({
          message: error.message,
          color: 'negative'
        })
      })
    }
  }
}

</script>
