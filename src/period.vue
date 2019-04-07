<template>


<div>

	

			<div v-if="show_main" class="card" style="width: 18rem;">
			  <div class="card-body">
			  	<p>{{msg}}</p>
			    <h5 class="card-title">{{period.course_name}}  ({{period.course_code}})</h5>

			    <h6 class="card-subtitle mb-2 text-muted">time : {{period.time}}</h6>

			    <p class="card-text">teacher : {{period.teacher_name}}</p>
			
			    <b-button variant="danger" @click='del_period' >delete</b-button>
			    
			  </div>
			</div>

</div>

</template>


<script>

export default {
	props:['period','day'],	
	data(){
		return{
			show_main: true,
			msg : '',
		}
	},

	methods : {

	 	del_period : function(){
	 		this.msg = 'deleting...'
	 		this.show_main = false
	 		this.msg = ''

	 		console.log(this.period.time)

	 		let endpoint = 'http://localhost/apu/class/delclass.php'
	 		let params = {

	 			day : this.day ,
	 			token : $cookies.get('class_token'),
	 			teacher_id : this.period.teacher_id,
	 			course_name : this.period.course_name,
	 			time : this.period.time ,
	 		}
	 		console.log(params)
	 		this.$http.get(endpoint,{params:params}).then(response => {
	 			response.text()
	 		}).then(result =>{
	 		 	console.log(result)
	 		})
	 	}
	}

}

</script>