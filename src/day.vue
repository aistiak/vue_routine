<template>

<div>


	<div v-if="show_main">


		<h3> {{day}}</h3>
		<b-button variant="success" @click="add_period">add</b-button>
		<ul>

			<li v-for="period in periods" class="period-list">

					<period v-bind:period="period" v-bind:day="day"> {{period}}</period>

			</li>
		</ul>

	</div>


	<div v-if="add_new_period">




		<!-- 
			hear we will see the form to add a period 

		-->

				<div>

			        	  <h4>Enter details:</h4>

						  <div class="form-group">
						    <p> select teacher name </p>	
						    <b-form-select v-model="teacher" :options="teacher_name_list" placeholder="Enter Name"></b-form-select>		 
						  </div>
						  <div class="form-group">
						    
						    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Course Name" v-model="course_name">			 
						  </div>
						  <div class="form-group">
						    
						    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Course Code " v-model="course_code">			 
						  </div>
						  <div class="form-group">
							<p>select time </p>
						    <b-form-select class="form-control" v-model="time" :options="time_slot_list"></b-form-select>			 
						  </div>	
						  <button @click='submit_period'>submit</button><button @click='cancel_action'>cancel</button>
						  {{msg}}	  


				</div>


	</div>



   

</div>

</template>

<style >
.period-list{
	margin-top:40px;
}

</style>

<script>
import Vue from 'vue'
import period from './period.vue'

Vue.component('period',period)
export default{
	props:['day'],
	data(){
		return{
        	msg : '',
        	periods : '', 
        	show_main: true,
        	add_new_period :  false ,
        	teacher_name_list : '',
        	teacher_id_list : '',
        	time_slot_list : '',
        	course_name : '',
        	course_code : '',
        	time : '',
        	teacher : '',
		}
	},

	methods : {

		add_period : function(){
			console.log("add a class on " + this.day )

			// take the window to a separate form 
			//this.show_main = false 
			this.add_new_period = true

			/* populate time_slot based on availabe slots frm db */
			
			let endpoint = 'http://localhost/apu/class/get_avail_time.php';
			let params = {
				token: $cookies.get('class_token'),
				day : this.day
			}
			this.$http.get(endpoint,{params:params}).then(response => {

				return response.json()
			}).then(result => {

				if(result.code == 200){
					this.time_slot_list = result.response ;
				}
			})

		},
		submit_period : function(){
			//this.show_main = true 
			//this.add_new_period = false

			//todo 
			// submit new period add form

			let endpoint = 'http://localhost/apu/class/addclass.php'
			let selected_teacher_idx = this.teacher_name_list.indexOf(this.teacher);
			let selected_teacher_id = this.teacher_id_list[selected_teacher_idx];
			console.log()
			let params = {
			    token: $cookies.get('class_token'),
			    day : this.day,
				teacher_id : selected_teacher_id,
				course_name : this.course_name,
				course_code : this.course_code,
				time : this.time

 			}
 			console.log(params)
 			this.$http.get(endpoint,{params:params}).then(response =>  {
 				return response.text()
 			}).then(result => {

 				console.log(result)
				this.add_new_period = false
				this.course_name = "",
	        	this.course_code = "",
	        	this.time = ""
	        	this.teacher = ""
	        	window.location.href = '/main'
 			})

		},
		cancel_action : function(){
			this.add_new_period = false
		}
	},

	created : function(){

		
		let endpoint  = 'http://localhost/apu/class/getall.php';

		let params = {

			token : $cookies.get('class_token'),
			day : this.day

		}
		console.log(params)

		this.$http.get(endpoint,{params:params}).then(response => {
			return response.json()
		}).then(result => {
				// no code 200 for this time , returns an array 
				console.log(result)
				this.periods  = result ;
		})


		/* populate teacher name list */

		endpoint = 'http://localhost/apu/class/all_teacher.php'
		
		params = {

			token : $cookies.get('class_token')
		}
		this.$http.get(endpoint,{params:params}).then(response => {

			return response.json()

		}).then(result => {

			if(result.code == 200){
				this.teacher_name_list = result.response.map(teacher => teacher.name);
				this.teacher_id_list   = result.response.map(teacher => teacher.id);
				console.log(this.teacher_name_list)


			}else{
				console.log(result)
			}

		});


	}


}


</script>