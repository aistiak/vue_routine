<template>

<div >
   <center>
    <b-button varient="" id="logout_button" @click="logout">logout</b-button>
	<h2> Routine Admin Panel </h2>
	<ul>

		<li v-for="day in days"><day v-bind:day="day"></day></li>
		<hr >

	</ul>
	</center>
</div>

</template>
<style scoped>
#logout_button{
	position: fixed;
    right: 1%;
    top: 1%;
}

ul li {
	display:table-row
}
li {
	margin-top:50px;
}

hr{
	color : green ;
}
</style>

<script>
import Vue from 'vue'
import day from './day.vue'


Vue.component('day',day)

export default{
	
	data(){
		return{
			days : ['sat','sun','mon','tue','wed']
		}
	},

	methods :{

		logout : function(){
			$cookies.set('class_token','null')
			window.location.href = '/login'
		}
	},

	created : function(){

		let cookie = $cookies.get('class_token')

		if ( cookie == 'null'){
			alert('you have to login first')
			window.location.href = '/login'
		}



	}
}


</script>