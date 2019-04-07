<template>


<div>

	

			<div v-if="show_main" class="card" style="width: 18rem;">
			  <div class="card-body">
			  	<p>{{msg}}</p>
			    <h5 class="card-title">{{period.course_name}}</h5>
			    <h6 class="card-subtitle mb-2 text-muted">time : {{period.time}}</h6>

			    <p class="card-text">teacher : {{period.teacher_name}}</p>
			
	
			    
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


	}

}

</script>