import Vue from 'vue'
import App from './App.vue'
import VueRouter  from 'vue-router'
import VueCookies from 'vue-cookies'
import VueResource from 'vue-resource'
import BootstrapVue from 'bootstrap-vue'
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'
import Routes from './Routes.js'
import login from './login.vue'
import nav from './nav.vue'
import period from './period.vue'

import publicPeriod from './public/publicPeriod.vue'
import publicDay from './public/publicDay.vue'
import forall from './forall.vue'

Vue.use(VueRouter)
Vue.use(VueResource)
Vue.use(VueCookies)
Vue.use(BootstrapVue)

Vue.component('period',period)

Vue.component('publicDay',publicDay)
Vue.component('publicPeriod',publicPeriod)


const router = new VueRouter({
   
   routes : Routes,
   mode   : 'history'
});


new Vue({
  el: '#app',
  render: h => h(App),
  router: router 
})
