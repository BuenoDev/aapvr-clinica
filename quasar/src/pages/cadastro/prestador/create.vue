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
                  Cadastrar Prestador
                </span>
                <q-separator/>
              </q-card-section>
              <q-card-section>
                <q-btn class="q-mr-md" color="positive" text-color="white" label="Cadastrar novo usuário" @click="newUserClick"/>
                <q-btn color="primary" text-color="white" label="Atribuir a usuário existente" @click="assignUserClick"/>
              </q-card-section>
              <q-card-section>
                <q-form ref="form" @submit.prevent = 'submit' autofocus greedy :disabled="disableForm">
                  <q-input class="q-mb-sm" square dense outlined ref="nome" v-model="form.nome" label="nome" :rules="rules.nome" lazy-rules />
                  <q-input class="q-mb-sm" type="email" square dense outlined ref="email" v-model="form.email" label="Email"  :rules="rules.email" lazy-rules v-if="form.options.newUser"/>
                  <q-input class="q-mb-sm" square dense outlined ref="cpf" v-model="form.cpf" label="CPF" :mask="mask.cpf" :rules="rules.cpf" lazy-rules />
                  <q-input class="q-mb-sm" square dense outlined ref="rg" v-model="form.rg" label="RG" :mask="mask.rg" :rules="rules.rg" lazy-rules />
                  <q-select square dense outlined v-model="form.role" :options="rolesOptions" label="Cargo" class="q-mb-lg"/>
                  <q-separator class="q-mb-lg"/>
                  <div v-if="form.role !== null && form.role.label === 'medico'">
                    <span class="text-h6" style="color:black">
                      Medicos
                    </span>
                    <q-input class="q-mb-sm q-mt-md" square dense outlined ref="nrConselho" v-model="form.medico.nrConselho" label="numero do conselho" :rules="rules.nrConselho" lazy-rules />
                    <q-select square dense outlined input-debounce="0" v-model="form.medico.especialidades" :options="especialidadesOptions" label="Especialidade" class="q-mb-lg" multiple use-input @filter="filterEspecialidade"/>
                  </div>
                  <!-- telefones -->
                  <q-btn round icon="add" color="positive" size="sm" class="q-mr-sm" @click="addPhone"/>
                  <span class="text-h6" style="color:black">
                    Telefones de Contato
                  </span>
                  <q-separator class="q-mb-md q-mt-md"/>
                  <div class="row" v-for="(telefone, phoneIndex) in form.telefones" :key="'phone-' + phoneIndex">
                    <div class="col-md-4">
                      <q-input class="q-mb-sm" square dense outlined :ref="`telefone${phoneIndex}`" :mask="phoneMask(telefone)" :rules="rules.telefone" v-model="telefone.numero" label="Telefone"/>
                    </div>
                    <div class="col-md-4">
                      <q-select square dense outlined v-model="telefone.tipo" :options="phoneOptions" label="Tipo" class="q-ml-sm">
                        <template v-slot:no-option>
                          <q-item>
                            <q-item-section class="text-grey">
                              Sem Resultados
                            </q-item-section>
                          </q-item>
                        </template>
                      </q-select>
                    </div>
                    <div class="col-md-2">
                       <q-btn color="white" text-color="black"  label="Remover" class="q-ml-md" :disabled="form.telefones.length === 1" @click="removePhone(phoneIndex)"/>
                    </div>
                  </div>
                  <!-- endereços -->
                  <q-separator class="q-mb-sm"/>
                  <q-btn round icon="add" color="positive" size="sm" class="q-mr-sm" @click="addAddress"/>
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
                        <q-select square dense outlined v-model="endereco.tipo" :options="addressOptions" label="Tipo" class="q-ml-sm"/>
                      </div>
                      <div class="col-2">
                         <q-btn color="white" text-color="black" label="Remover" class="q-ml-md" :disabled="form.enderecos.length === 1" @click="removeAddress(addressIndex)"/>
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
import Fuse from 'fuse.js'
import defaultPageHeader from '../../../components/defaultPageHeader'
import { mapGetters } from 'vuex'

export default {
  components: {
    defaultPageHeader
  },
  computed: {
    ...mapGetters('especialidade', [
      'especialidades'
    ]),
    ...mapGetters('permissions', [
      'roles'
    ]),
    disableForm () {
      return !(this.form.options.newUser || this.form.options.userId !== null)
      // return !this.form.options.newUser
    },
    especialidadesInitialOptions () {
      return this.especialidades.map(obj => {
        return {
          value: obj.id,
          label: obj.nome
        }
      })
    },
    rolesOptions () {
      return this.roles.map(obj => {
        return {
          value: obj.id,
          label: obj.name
        }
      })
    }
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
          route: '/prestador',
          label: 'Prestador'
        },
        {
          icon: 'person',
          route: '/criar',
          label: 'cadastro'
        }
      ],
      form: {
        options: {
          newUser: false,
          userId: null
        },
        medico: {
          nrConselho: null,
          especialidades: []
        },
        nome: null,
        cpf: null,
        rg: null,
        role: null,
        telefones: [
          {
            numero: null,
            tipo: 'Celular'
          }
        ],
        enderecos: [
          {
            cep: null,
            tipo: 'Residencial',
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
          val => val.length >= 5 || 'O nome deve ter ao menos 5 caracteres'
        ],
        email: [
          val => true || 'message'
        ],
        nrConselho: [
          val => true || 'O numero do conselho deve ter ao menos 5 caracteres'
        ],
        cpf: [
          val => val !== null || 'Campo Obrigatório',
          val => val.length > 11 || 'O cpf deve ter 11 caracteres'
        ],
        rg: [
          val => val !== null || 'O campo rg não pode estar vazio'
        ],
        telefone: [
          val => val !== null || 'Campo Obrigatório'
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
      phoneOptions: [
        'Residencial',
        'Celular',
        'Comercial'
      ],
      addressOptions: [
        'Residencial',
        'Comercial'
      ],
      especialidadesOptions: null
    }
  },
  methods: {
    newUserClick () {
      console.log('newUserClick')
      this.form.options.newUser = true
    },
    assignUserClick () {
      console.log('assign user')
    },
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
    addPhone () {
      this.form.telefones.push({
        numero: null,
        tipo: 'Residencial'
      })
    },
    removePhone (index) {
      this.form.telefones.splice(index, 1)
    },
    phoneMask (phone) {
      return phone.tipo === 'Celular' ? '(##) #####-####' : '(##) ####-####'
    },
    filterEspecialidade (param, update) {
      if (param === '') {
        update(() => {
          this.especialidadesOptions = this.especialidadesInitialOptions
        })
      } else {
        let fuse = new Fuse(this.especialidadesOptions, {
          shouldSort: true,
          threshold: 0.6,
          location: 0,
          distance: 100,
          maxPatternLength: 32,
          minMatchCharLength: 1,
          keys: ['label']
        })
        let result = fuse.search(param)
        update(() => {
          this.especialidadesOptions = result
        })
      }
    },
    submit () {
      this.$refs.form.validate().then(result => {
        console.log({ then: result })
        this.$axios.post('/prestador', this.form).then(response => {
          console.log(response)
          this.$q.notify({
            message: 'Prestador cadastrado com sucesso',
            color: 'positive'
          })
          this.$router.push('/prestador')
          this.$store.dispatch('prestador/refresh')
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
    if (this.roles.length === 0 || this.especialidades.length === 0) {
      this.$q.loading.show({
        message: 'Carregando cargos'
      })
      this.$store.dispatch('permissions/searchRole').then(() => {
        if (this.especialidades.length === 0) {
          this.$q.loading.show({
            message: 'Carregando especialidades'
          })
          this.$store.dispatch('especialidade/refresh').then(() => {
            this.especialidadesOptions = this.especialidadesInitialOptions
            this.$q.loading.hide()
          })
        } else {
          this.especialidadesOptions = this.especialidadesInitialOptions
          this.$q.loading.hide()
        }
      })
    }
  }
}

</script>
