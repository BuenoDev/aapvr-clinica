<template>
    <div class="q-mt-lg">
       <default-page-header
        :config="headerConfig"
        backTo="/prestador"
        />
        <q-dialog v-model="assignUserDialog" width="600px">
            <!-- <span class="text-h4">
              Atribuir a usuário
            </span> -->
            <!-- <p>{{ tableCol }}</p> -->
            <q-table :data="users" :columns="tableCol" rows-per-page-label="Registros por página:"
              loading-label="Carregando..." row-key="id">
              <template v-slot:top>
                  <fuse-input class="full-width" :data="unlinkedUsers" :keys="['email']" @result="setResult" />
                </template>
              <template v-slot:body-cell-actions="props">
                <q-td key="actions" :props="props">
                  <q-btn split size="sm" color="primary" icon="done" @click="selectUser(props.row)" />
                </q-td>
              </template>
            </q-table>
        </q-dialog>
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
                <div class="row">
                  <div class="col-lg-4 col-sm-12">
                    <q-btn color="positive" class="q-ma-sm" text-color="white" label="Cadastrar novo usuário" @click="newUserClick" />
                  </div>
                  <div class="col-lg-4 col-sm-12">
                    <q-btn color="primary" class="q-ma-sm" text-color="white" label="Atribuir a usuário existente" @click="assignUserClick" />
                  </div>
                  <div class="col-lg-4 col-sm-12">
                    <q-btn color="negative" class="q-ma-sm" text-color="white" label="Criar sem atribuir usuario" @click="noUserClick" />
                  </div>
                </div>
              </q-card-section>
              <q-card-section>
                <!-- TODO: definir desabilitar form de forma independente pra cada modulo -->
                <!-- TODO: Verificar alterações na mutation quanto ao usuario cadastrado por associação -->
                <q-form ref="form" @submit.prevent = 'submit' autofocus greedy :disabled="disable.form">
                  <!-- nome -->
                  <q-input class="q-mb-sm" square dense outlined
                            v-model="form.perfil.nome"
                            label="nome"
                            ref="nome"
                            :rules="rules.nome"
                            :disabled="disable.nome"
                            lazy-rules
                            />
                  <!-- email -->
                  <q-input class="q-mb-sm" square dense outlined
                            type="email"
                            v-if="form.user"
                            v-model="form.user.email"
                            label="Email"
                            ref="email"
                            :rules="rules.email"
                            :disabled="disable.email"
                            lazy-rules
                            />
                  <!-- cpf -->
                  <q-input class="q-mb-sm" square dense outlined
                            ref="cpf"
                            v-model="form.perfil.cpf"
                            label="CPF"
                            :mask="mask.cpf"
                            :rules="rules.cpf"
                            :disabled="disable.cpf"
                            lazy-rules
                            />
                  <!-- rg -->
                  <q-input class="q-mb-sm" square dense outlined
                            ref="rg"
                            v-model="form.perfil.rg"
                            label="RG"
                            :mask="mask.rg"
                            :rules="rules.rg"
                            :disabled="disable.rg"
                            lazy-rules
                            />
                  <!-- Tipo -->
                  <q-select class="q-mb-lg" square dense outlined
                            v-model="form.prestador.tipoPrestador"
                            :options="tiposPrestadorOptions"
                            label="Tipo de Prestador"
                            :loading="false"
                            />
                  <q-separator class="q-mb-lg"/>
                  <div v-if="form.prestador.tipoPrestador !== null && form.prestador.tipoPrestador.label.toLowerCase() === 'medico'">
                    <span class="text-h6" style="color:black">
                      Medicos
                    </span>
                    <!-- conselho -->
                    <q-input class="q-mb-sm q-mt-md" square dense outlined
                             ref="nrConselho"
                             label="numero do conselho"
                             v-model="form.prestador.nrConselho"
                             :rules="rules.nrConselho"
                             lazy-rules
                             />

                    <!-- TODO: verificar select nao modificando valores no edit  -->
                    <!-- TODO: verificar select com input nao limpando o campo e,
                    se possivel, adicionar tags -->

                    <!-- especialidades -->
                    <q-select class="q-mb-lg" square dense outlined multiple use-input
                              input-debounce="1"
                              label="Especialidade"
                              ref="especialidade"
                              v-model="form.prestador.especialidades"
                              :options="especialidadesOptions"
                              :loading="especialidadeLoading"
                              @filter="filterEspecialidade"
                              />
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
import fuseInput from '../../../components/fuseInput'
import defaultPageHeader from '../../../components/defaultPageHeader'
import { mapGetters } from 'vuex'

export default {
  components: {
    defaultPageHeader,
    fuseInput
  },
  computed: {
    ...mapGetters('especialidade', [
      'especialidades'
    ]),
    ...mapGetters('permissions', [
      'unlinkedUsers'
    ]),
    ...mapGetters('tipoprestador', [
      'tiposPrestador'
    ]),
    especialidadesInitialOptions () {
      return this.especialidades.map(obj => {
        return {
          value: obj.id,
          label: obj.nome
        }
      })
    },
    tiposPrestadorOptions () {
      return this.tiposPrestador.map(obj => {
        return {
          value: obj.id,
          label: obj.nome
        }
      })
    }
  },
  data () {
    return {
      users: [],
      tableCol: [
        {
          label: 'Email',
          name: 'email',
          field: 'email',
          align: 'center'
        },
        {
          label: 'Selecionar',
          name: 'actions',
          field: 'id',
          align: 'center'
        }
      ],
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
      disable: {
        form: true,
        email: true,
        nome: false,
        rg: false,
        cpf: false
      },
      assignUserDialog: false,
      form: {
        user: null,
        perfil: {
          nome: null,
          cpf: null,
          rg: null
        },
        prestador: {
          nrConselho: null,
          tipoPrestador: null,
          especialidades: []
        },
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
      especialidadeLoading: false,
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
    selectUser (row) {
      this.form.user = {
        email: row.email,
        id: row.id
      }
      this.disable.form = false
      this.assignUserDialog = false

      this.disable.rg = true
      this.disable.cpf = true
      this.disable.nome = true
      this.disable.email = true
      this.form.perfil = row.perfil
    },
    newUserClick () {
      this.form.user = {
        email: null
      }
      this.disable.form = false

      this.disable.rg = false
      this.disable.cpf = false
      this.disable.nome = false
      this.disable.email = false
    },
    assignUserClick () {
      if (this.unlinkedUsers.length === 0) {
        this.$q.loading.show({
          message: 'Carregando ususários'
        })
      } else {
        this.users = this.unlinkedUsers
        this.assignUserDialog = true
      }
      this.$store.dispatch('permissions/getUnlinkedUsers').then(() => {
        this.$q.loading.hide()
        this.users = this.unlinkedUsers
        this.assignUserDialog = true
      })
    },
    noUserClick () {
      this.form.user = null
      this.disable.form = false
      this.disable.email = true
    },
    setResult (result) {
      if (result.length > 0) this.users = result
      else this.users = this.unlinkedUsers
    },
    // TODO: Verificar erro de cors
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
    fetchData () {
      if (this.especialidades.length === 0) {
        this.especialidadeLoading = true
        this.$store.dispatch('especialidade/refresh')
          .then(() => { this.especialidadeLoading = false })
          .catch(() => { this.especialidadeLoading = false })
      }
      if (this.tiposPrestador.length === 0) {
        this.$store.dispatch('tipoprestador/refresh')
      }
    },
    submit () {
      this.$refs.form.validate().then(result => {
        this.$axios.post('/prestador', this.form).then(response => {
          // Remove usuario sem prestador da lista
          if (this.form.user !== null) {
            this.$store.dispatch('removeUnlinked', this.form.user.id)
          }
          this.$q.notify({
            message: 'Prestador cadastrado com sucesso',
            color: 'positive'
          })
          this.$router.push('/prestador')
          this.$store.dispatch('prestador/refresh')
        }).catch(error => {
          console.error(error)
          let message = ''
          if (error.response.data.message.includes('users_email_unique')) {
            message = 'Este email ja esta em uso'
          } else message = error.message
          this.$q.notify({
            message: message,
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
    this.fetchData()
  }
}

</script>
