<template>
    <div class="q-mt-lg">
       <default-page-header
        :config="headerConfig"
        backTo="/procedimento"
        />
        <div class="row justify-center">
          <div class="col-lg-6 col-md-8 col-sm-12">
            <q-card class=" q-mb-xl q-mt-lg">
              <q-card-section >
                <span class="text-h4" style="color:black">
                  {{ form.nome }}
                  <q-btn label="Editar" size="sm" class="q-ma-md" color="primary" @click="editForm" v-if="authUser.can('editar-prestador')"/>
                  <q-btn label="Apagar" size="sm"  color="negative" @click="deleteForm" v-if="authUser.can('editar-prestador')"/>
                </span>
                <q-separator/>
              </q-card-section>
              <q-card-section>
                <q-form ref="form" @submit.prevent = 'submit' autofocus greedy>
                  <div class="row">
                     <div class="col-md-12">
                       <!-- TODO: verificar por que o select nao muda de valor automaticamente -->
                        <q-select :disable="!edit" square dense outlined v-model="form.grupoProcedimento" :options="options" label="Grupo" :loading="loading.grupo" class="q-mb-lg"/>
                      </div>
                      <div class="col-md-4">
                        <q-input :disable="!edit" class="q-mb-xs" mask="###########" square dense outlined ref="codigo" v-model="form.codigo" label="Código" :rules="rules.codigo" lazy-rules />
                      </div>
                      <div class="col-md-12">
                        <q-input :disable="!edit" square dense outlined ref="procedimento" v-model="form.procedimento" label="Nome do Procedimento" :rules="rules.procedimento" lazy-rules />
                      </div>
                      <div class="col-md-2">
                         <q-select :disable="!edit" square dense outlined v-model="form.status" :options="status" label="Status" class="q-mb-sm"/>
                     </div>
                      </div>
                   <q-btn type="submit" label="enviar" v-if="edit"/>
                </q-form>
              </q-card-section>
            </q-card>
          </div>
        </div>
    </div>
</template>

<script>
import defaultPageHeader from '../../../components/defaultPageHeader'
import { mapGetters, mapActions } from 'vuex'

export default {
  components: {
    defaultPageHeader
  },
  computed: {
    ...mapGetters('procedimento', [
      'selected'
    ]),
    ...mapGetters('grupoprocedimento', [
      'grupoprocedimentos'
    ]),
    ...mapGetters('auth', [
      'authUser'
    ])
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
          route: '/procedimento',
          label: 'Procedimento'
        },
        {
          icon: '',
          route: '',
          label: 'Visualizar'
        }
      ],
      form: {
        codigo: null,
        procedimento: null,
        status: null,
        grupoProcedimento: null
      },
      options: [],
      loading: {
        grupo: false
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
      ],
      edit: false
    }
  },
  methods: {
    ...mapActions(['procedimento'], [
      'deleteProcedimento'
    ]),
    editForm () {
      this.edit = true
    },
    mapOptions (options) {
      return options.map(item => {
        return {
          label: item.descricao,
          value: item.id
        }
      })
    },
    deleteForm () {
      this.$q.dialog({
        title: 'Apagar Procedimento',
        message: 'Deseja realmente apagar este Procedimento? Esta ação não poderá ser revertida!',
        cancel: 'Cancelar'
      }).onOk(() => {
        this.$store.dispatch('procedimento/deleteProcedimento', this.form.id).then(() => {
          console.log('delete')
          this.$q.notify({
            message: 'O Procedimento foi Removido',
            color: 'positive'
          })
        })
        this.$router.push('/procedimento')
      })
    },
    submit () {
      this.$refs.form.validate().then(() => {
        console.log('validated')
        this.$axios.put('/procedimento/' + this.form.id, this.form).then(response => {
          console.log(response)
          this.$q.notify({
            message: 'Procedimento foi editado com sucesso',
            color: 'positive'
          })
          this.$router.push('/procedimento')
        }).catch(error => {
          console.error(error)
          this.$q.notify({
            message: error.message,
            color: 'negative'
          })
        })
      })
    }
  },
  mounted () {
    this.options = this.mapOptions(this.grupoprocedimentos)
    if (this.options.length === 0) this.loading.grupo = true

    this.$store.dispatch('grupoprocedimento/refresh').then(() => {
      this.options = this.mapOptions(this.grupoprocedimentos)
      this.loading.grupo = false
    })
    this.form = this.selected
    let gp = this.selected.grupoprocedimento
    this.form.grupoProcedimento = {
      value: gp.id,
      label: gp.descricao
    }
  }
}

</script>
