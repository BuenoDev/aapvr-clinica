<template>
    <div class="q-mt-lg">
       <default-page-header
        :config="headerConfig"
        backTo="/especialidade"
        />
        <div class="row justify-center">
          <div class="col-lg-6 col-md-8 col-sm-12">
            <q-card class=" q-mb-xl q-mt-lg">
              <q-card-section >
                <span class="text-h4" style="color:black">
                  {{ form.nome }}
                  <q-btn label="Editar" size="sm" class="q-ma-md" color="primary" @click="editForm" v-if="authUser.can('editar-especialidade')"/>
                  <q-btn label="Apagar" size="sm"  color="negative" @click="deleteForm" v-if="authUser.can('editar-especialidade')"/>
                </span>
                <q-separator/>
              </q-card-section>
              <q-card-section>
                <q-form ref="form" @submit.prevent = 'submit' autofocus greedy>
                  <q-input :disable="!edit" class="q-mb-sm" square dense outlined ref="nome" v-model="form.nome" label="nome" :rules="rules.nome" lazy-rules />
                  <q-input :disable="!edit" class="q-mb-sm" square dense outlined ref="codigo" v-model="form.codigo" label="codigo" :rules="rules.codigo" lazy-rules />
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
    ...mapGetters('especialidade', [
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
          route: '/',
          label: 'Home'
        },
        {
          icon: 'document',
          route: '/especialidade',
          label: 'especialidade'
        },
        {
          icon: '',
          route: '',
          label: 'Visualizar'
        }
      ],
      form: {
        nome: null,
        codigo: null
      },
      rules: {
        nome: [
          val => val !== null || 'Campo Obrigatório',
          val => val.length > 5 || 'O nome deve ter ao menos 5 caracteres'
        ],
        codigo: [
          val => val !== null || 'Campo Obrigatório'
        ]
      },
      edit: false
    }
  },
  methods: {
    ...mapActions(['especialidade'], [
      'deleteEspecialidade'
    ]),
    editForm () {
      this.edit = true
    },
    deleteForm () {
      this.$q.dialog({
        title: 'Apagar Especialidade',
        message: 'Deseja realmente apagar esta especialidade? Esta ação não poderá ser revertida!',
        cancel: 'Cancelar'
      }).onOk(() => {
        this.deleteEspecialidade().then(() => {
          console.log('delete')
          this.$q.notify({
            message: 'Especialidade Removida',
            color: 'positive'
          })
        })
        this.$router.push('/especialidade')
      })
    },
    submit () {
      this.$refs.form.validate().then(() => {
        console.log('validated')
        this.$axios.put('/especialidade/' + this.form.id, this.form).then(response => {
          console.log(response)
          this.$q.notify({
            message: 'Especialidade editada com sucesso',
            color: 'positive'
          })
          this.$router.push('/especialidade')
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
