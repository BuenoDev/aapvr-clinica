<template>
    <div class="q-mt-lg">
       <default-page-header
        :config="headerConfig"
        backTo="/conselho"
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
                  <div class="col-3">
                  <q-input :disable="!edit" class="q-mb-sm" type="number" square dense outlined ref="numero" v-model="form.numero" label="Número" :rules="rules.numero" lazy-rules />
                  </div>
                  </div>
                  <div class="row">
                  <div class="col-2">
                  <q-input :disable="!edit" class="q-mb-sm" square dense outlined ref="sigla" v-model="form.sigla" label="Sigla" :rules="rules.sigla" lazy-rules />
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
    ...mapGetters('conselho', [
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
          route: '/conselho',
          label: 'Conselhos'
        },
        {
          icon: '',
          route: '',
          label: 'Visualizar'
        }
      ],
      form: {
        numero: null,
        sigla: null,
        nome: null
      },
      rules: {
        nome: [
          val => val.length > 0 || 'Campo Obrigatório'
        ],
        numero: [
          val => val.length > 0 || 'Campo Obrigatório'
        ],
        sigla: [
          val => val.length > 0 || 'Campo Obrigatório'
        ]
      },
      edit: false
    }
  },
  methods: {
    ...mapActions(['conselho'], [
      'deleteConselho'
    ]),
    editForm () {
      this.edit = true
    },
    deleteForm () {
      this.$q.dialog({
        title: 'Apagar Conselho',
        message: 'Deseja realmente apagar este Conselho? Esta ação não poderá ser revertida!',
        cancel: 'Cancelar'
      }).onOk(() => {
        this.$store.dispatch('conselho/deleteConselho', this.form.id).then(() => {
          console.log('delete')
          this.$q.notify({
            message: 'O Conselho foi Removido',
            color: 'positive'
          })
        })
        this.$router.push('/conselho')
      })
    },
    submit () {
      this.$refs.form.validate().then(() => {
        console.log('validated')
        this.$axios.put('/conselho/' + this.form.id, this.form).then(response => {
          console.log(response)
          this.$q.notify({
            message: 'O conselho foi editado com sucesso',
            color: 'positive'
          })
          this.$router.push('/conselho')
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
  }
}

</script>
