<template>
    <div class="q-mt-lg">
       <default-page-header
        :config="headerConfig"
        backTo="/grupoprocedimento"
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
                  <q-input :disable="!edit" class="q-mb-sm" square dense outlined ref="descricao" v-model="form.descricao" label="Descrição" :rules="rules.descricao" lazy-rules />
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
    ...mapGetters('grupoprocedimento', [
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
          route: '/grupoprocedimento',
          label: 'Grupo Procedimento'
        },
        {
          icon: '',
          route: '',
          label: 'Visualizar'
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
      },
      edit: false
    }
  },
  methods: {
    ...mapActions(['grupoprocedimento'], [
      'deleteGrupoProcedimento'
    ]),
    editForm () {
      this.edit = true
    },
    deleteForm () {
      this.$q.dialog({
        title: 'Apagar Grupo',
        message: 'Deseja realmente apagar este Grupo de Procedimento? Esta ação não poderá ser revertida!',
        cancel: 'Cancelar'
      }).onOk(() => {
        this.$store.dispatch('grupoprocedimento/deleteGrupoProcedimento', this.form.id).then(() => {
          console.log('delete')
          this.$q.notify({
            message: 'O Grupo de Procedimento foi Removido',
            color: 'positive'
          })
        })
        this.$router.push('/grupoprocedimento')
      })
    },
    submit () {
      this.$refs.form.validate().then(() => {
        console.log('validated')
        this.$axios.put('/grupoprocedimento/' + this.form.id, this.form).then(response => {
          console.log(response)
          this.$q.notify({
            message: 'Grupo de Procedimento foi editado com sucesso',
            color: 'positive'
          })
          this.$router.push('/grupoprocedimento')
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
