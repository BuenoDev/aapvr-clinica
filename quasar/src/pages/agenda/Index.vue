<template>
  <div class="">
    <div class="row">
      <div class="col-md-3 col-sm-12">
        <q-card class="right-form">
          <q-card-section>
            <q-select :options="[]" label="Prestador">
            </q-select>
          </q-card-section>
          <q-card-section>
            <div class="row">
              <div class="col-8">
                <q-select :options="[]" label="Paciente">
                </q-select>
              </div>
              <div class="col-4">
                <q-btn icon="plus_one" class="q-ma-md q-ml-xl" round color="positive"/>
              </div>
            </div>
          </q-card-section>
          <q-card-section>
            detalhes paciente
            <q-input label="Nome" disable square outlined class="q-mb-md"></q-input>
            <q-input label="Telefone" disable square outlined class="q-mb-md"></q-input>
            <q-input label="Idade" disable square outlined class="q-mb-md"></q-input>
          </q-card-section>
        </q-card>
      </div>
      <div class="col-md-8 col-sm-12 q-ml-lg">
        <FullCalendar
          defaultView="dayGridMonth"
          :plugins="calendarPlugins"
          :locales="locale"
          locale="ptbr"
          lang="PT_BR"
          :weekends="false"
          :events="[
            { title: 'event 1', date: '2019-12-13' },
            { title: 'event 2', date: '2019-12-12' }
          ]"
          />
      </div>
    </div>
  </div>
</template>
<script>
import { mapGetters } from 'vuex'
// import locale from '@fullcalendar/core/locales/pt-br'
import FullCalendar from '@fullcalendar/vue'
import dayGridPlugin from '@fullcalendar/daygrid'

export default {
  components: {
    FullCalendar // make the <FullCalendar> tag available
  },
  computed: {
    ...mapGetters('auth', [
      'authUser'
    ])
  },
  data () {
    return {
      calendarPlugins: [ dayGridPlugin ]
    }
  },
  mounted () {
    console.log({
      user: this.authUser,
      can: this.authUser.can('visualizar-agenda'),
      role: this.authUser.hasRole('admin')
    })
  }
}
</script>
<style lang="scss" scoped>
.right-form{
  margin: 50px 30px 0px 20px !important;
}
</style>
