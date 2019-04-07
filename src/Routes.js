import login from './login.vue'
import main from './main.vue'
import nav from './nav.vue'
import forall from './forall.vue'

export default[
	 {path: '/' , component: forall},		
     {path: '/login',component: login},
     {path: '/main', component: main},
     {path: '/nav', component: nav}


]