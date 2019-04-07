<template>

<div >
   <center>

	<h2></h2>
	<ul>

		<li v-for="day in days"><publicDay v-bind:day="day"></publicDay></li>
		<hr >

	</ul>
	</center>
</div>

</template>
<style scoped>

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

export default{
	
	data(){
		return{
			days : ['sat','sun','mon','tue','wed']
		}
	},

	created : function(){

		return ;

	}
}


</script>