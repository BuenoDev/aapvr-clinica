<template>
    <div class="q-mt-lg">
       <default-page-header
        :config="headerConfig"
        backTo="/convenio"
        />
        <div class="row justify-center">
          <div class="col-lg-6 col-md-8 col-sm-12">
            <q-card class=" q-mb-xl q-mt-lg">
              <q-card-section >
                <span class="text-h4" style="color:black">
                  <q-btn label="Editar" size="sm" class="q-ma-md" color="primary" @click="editForm" v-if="authUser.can('editar-prestador')"/>
                  <q-btn label="Apagar" size="sm"  color="negative" @click="deleteForm" v-if="authUser.can('editar-prestador')"/>
                </span>
                <q-separator/>
              </q-card-section>
              <q-card-section>
                <q-form ref="form" @submit.prevent = 'submit' autofocus greedy>
                  <div class="row">
                  <div class="col-4">
                  <q-toggle :disable="!edit" v-model="form.tipo" ref="tipo" label="Particular" lazy-rules/>
                  </div>
                  </div>
                  <div class="row">
                  <div class="col-4">
                  <q-input :disable="!edit" class="q-mb-sm" type="number" square dense outlined ref="regans" v-model="form.regans" label="Regra ANS" :rules="rules.regans" lazy-rules />
                  </div>
                  <div class="col-9">
                  <q-input :disable="!edit" class="q-mb-sm" square dense outlined ref="nome" v-model="form.nome" label="Nome" :rules="rules.nome" lazy-rules />
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
    ...mapGetters('convenio', [
      'selected'
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
          route: '/convenio',
          label: 'Convênios'
        },
        {
          icon: '',
          route: '',
          label: 'Visualizar'
        }
      ],
      form: {
        tipo: null,
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
      },
      edit: false
    }
  },
  methods: {
    ...mapActions(['convenio'], [
      'deleteConvenio'
    ]),
    editForm () {
      this.edit = true
    },
    deleteForm () {
      this.$q.dialog({
        title: 'Apagar Convênio',
        message: 'Deseja realmente apagar este Convênio? Esta ação não poderá ser revertida!',
        cancel: 'Cancelar'
      }).onOk(() => {
        this.$store.dispatch('convenio/deleteConvenio', this.form.id).then(() => {
          console.log('delete')
          this.$q.notify({
            message: 'O Convênio foi Removido',
            color: 'positive'
          })
        })
        this.$router.push('/convenio')
      })
    },
    submit () {
      this.$refs.form.validate().then(() => {
        console.log('validated')
        this.$axios.put('/convenio/' + this.form.id, this.form).then(response => {
          console.log(response)
          this.$q.notify({
            message: 'O Convênio foi editado com sucesso',
            color: 'positive'
          })
          this.$router.push('/convenio')
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
    console.log(this.selected)
    this.form = this.selected
    this.form.tipo === 1 ? this.form.tipo = true : this.form.tipo = false
  }
}

</script>
