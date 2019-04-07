<template>

<div class='main'>
    <p class='input'>{{warn}}</p>
    <b-form-input class='input' v-model="name" placeholder=" name"></b-form-input>
    <b-form-input class='input' v-model="password" placeholder="password" type="password"></b-form-input>
    <b-button  class="button" @click="login">login</b-button>
</div>

</template>



<style>

	.input{
	 position:relative;
	 margin-bottom:20px;
	 width:400px;
	}

	.main{
		position:relative;
		left:35%;
		margin-top:200px;
	}

	.button{
	 position: relative;
	 margin-right:630px;
	}
  body{
    background-color : #EEEEEE;
  }

</style>

<script>

export default {
	
	data(){
		return{
        warn : '',
        name : '',
        password : ''
		}
	},

	methods:{
       login : function (){
       		console.log(this.name);
       		console.log(this.password);
          this.warn = "wait...."   
             
       		// 
       		let endpoint = 'http://localhost/apu/class/login.php';
       		let prams = {
       		 	name : this.name,
       		 	password : this.password
       		}
       		this.$http.get(endpoint,{ params :prams}).then(response =>{
       			// if 200 ok
       			console.log(response.status)
            return response.json();

       		}, esponse => {
       		 	// if 401 
            console.log(response.status)
       		 	return response.json();
       		}).then(result => {
            
       		 	 if(result.code == 200){

                  // save the token in cookie
                   this.warn = 'login success'  
                   $cookies.set('class_token',result.token)
                   console.log($cookies.get('class_token'))
                   window.location.href = '/main'

             }else{
                console.log(result)
                //this.warn = result.error
             }

       		});

    
       }
	}
}

</script>

