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
                  Cadastrar Unidade
                </span>
                <q-separator/>
              </q-card-section>
              <q-card-section>
                <q-form ref="form" @submit.prevent = 'submit' autofocus greedy>
                  <q-input class="q-mb-sm" square dense outlined ref="nome" v-model="form.nome" label="nome" :rules="rules.nome" lazy-rules />
                  <q-input class="q-mb-sm" square dense outlined ref="regans" v-model="form.regans" label="regans" :rules="rules.regans" lazy-rules />
                  <!-- endereços -->
                  <q-separator class="q-mb-sm"/>
                  <!-- <q-btn round icon="add" color="positive" size="sm" class="q-mr-sm" @click="addAddress"/> -->
                  <span class="text-h6" style="color:black">
                    Endereço
                  </span>
                  <q-separator class="q-mb-md q-mt-md"/>
                  <div  v-for="(endereco, addressIndex) in form.enderecos" :key="'address-' + addressIndex">
                    <div class="row">
                      <div class="col-6">
                        <q-input class="q-mb-md" square dense outlined ref="cep" :mask="mask.cep" v-model="endereco.cep" label="cep" lazy-rules :loading="endereco.cepLoading" @keyup="fetchCEP(endereco)"/>
                      </div>
                      <div class="col-4">
                        <!-- <q-select square dense outlined v-model="endereco.tipo" :options="addressOptions" label="Tipo" class="q-ml-sm"/> -->
                      </div>
                      <div class="col-2">
                         <!-- <q-btn color="white" text-color="black" label="Remover" class="q-ml-md" :disabled="form.enderecos.length === 1" @click="removeAddress(addressIndex)"/> -->
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-6">
                        <q-input class="q-mb-sm" square dense outlined ref="bairro" v-model="endereco.bairro" label="bairro" :rules="rules.bairro" lazy-rules />
                      </div>
                      <div class="col-4">
                        <q-input class="q-mb-sm q-ml-sm" square dense outlined ref="cidade" v-model="endereco.cidade" label="cidade" :rules="rules.cidade" lazy-rules />
                      </div>
                      <div class="col-2">
                        <q-input class="q-mb-sm q-ml-sm" square dense outlined ref="uf" v-model="endereco.uf" label="uf" mask="AA" :rules="rules.uf" lazy-rules />
                      </div>
                    </div>
                    <q-input class="q-mb-sm" square dense outlined ref="logradouro" v-model="endereco.logradouro" label="logradouro" :rules="rules.logradouro" lazy-rules />
                    <q-input class="q-mb-sm" square dense outlined ref="complemento" v-model="endereco.complemento" label="complemento" :rules="rules.complemento" lazy-rules />
                    <q-separator class="q-mb-md"/>
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
import axios from 'axios'
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
          icon: 'business',
          route: '/unidade',
          label: 'Unidade'
        },
        {
          icon: 'person',
          route: '/criar',
          label: 'cadastro'
        }
      ],
      form: {
        nome: null,
        regans: null,
        enderecos: [
          {
            cep: null,
            tipo: 'Comercial',
            logradouro: null,
            bairro: null,
            cidade: null,
            complemento: null,
            uf: null,
            ativo: null,
            cepLoading: false
          }
        ]
      },
      rules: {
        nome: [
          val => val !== null || 'Campo Obrigatório',
          val => val.length > 5 || 'O nome deve ter ao menos 5 caracteres'
        ],
        regans: [
          val => true || 'O numero do conselho deve ter ao menos 5 caracteres'
        ],
        logradouro: [
          val => val !== null || 'Campo Obrigatório'
        ],
        bairro: [
          val => val !== null || 'Campo Obrigatório'
        ],
        cidade: [
          val => val !== null || 'Campo Obrigatório'
        ],
        uf: [
          val => val !== null || 'Campo Obrigatório'
        ]
      },
      mask: {
        cpf: '###.###.###-##',
        cep: '#####-###',
        rg: '##.###.###-#'
      },
      addressOptions: [
        'Residencial',
        'Comercial'
      ]
    }
  },
  methods: {
    fetchCEP (endereco) {
      //  this.$axios({ url: `/ws/${this.form.cep}/json`, baseURL: 'https://viacep.com.br/' }).then(response => {
      let cep = endereco.cep.replace('-', '')
      if (cep.length === 8) {
        endereco.cepLoading = true
        axios.get(`https://viacep.com.br/ws/${cep}/json`).then(response => {
          let data = response.data
          endereco.logradouro = data.logradouro
          endereco.bairro = data.bairro
          endereco.cidade = data.localidade
          endereco.uf = data.uf
        }).catch(error => {
          console.error(error)
          this.$q.notify({
            message: error.message,
            color: 'negative'
          })
        }).finally(() => {
          endereco.cepLoading = false
        })
      }
    },
    addAddress () {
      this.form.enderecos.push({
        cep: null,
        logradouro: null,
        bairro: null,
        cidade: null,
        complemento: null,
        uf: null,
        ativo: null
      })
    },
    removeAddress (index) {
      this.form.enderecos.splice(index, 1)
    },
    submit () {
      this.$refs.form.validate().then(result => {
        console.log({ then: result })
        this.$axios.post('/unidade', this.form).then(response => {
          console.log(response)
          this.$q.notify({
            message: 'Unidade cadastrada com sucesso',
            color: 'positive'
          })
          this.$router.push('/unidade')
          this.$store.dispatch('unidade/refresh')
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
