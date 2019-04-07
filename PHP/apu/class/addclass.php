<?php
include ("connect.php");


if ($_SERVER['REQUEST_METHOD'] === 'GET'){
   
   $day = $_GET['day'];
   $token = $_GET['token'];

   $teacher_id = $_GET['teacher_id'];
   $course_name = $_GET['course_name'];
   $course_code = $_GET['course_code'];
   $time = $_GET['time'];


   if(is_null($day) || is_null($token) || is_null($teacher_id) || is_null($course_code) || is_null($course_name) || is_null($time)){
     
      $obj = new stdClass();
      $obj->code = "401";
      $obj->error = 'not enough info.';
      echo json_encode($obj);
      return;
   }

   // mark the time slot on that day as 1 (one/true)
   $slot = $day."_slot";
   $sql = sprintf("update %s set slot=1 where time='%s'",$slot,$time);
   $result = $conn->query($sql);
   

   $sql = sprintf("select * from token_holder");
   $result = $conn->query($sql);

   while ($row = $result->fetch_assoc()) {   
   	# code...
   		if($token === $row['token']){

   			$sql = sprintf("insert into %s (teacher_id ,course_name,course_code,time ) values(%s,'%s','%s','%s')",$day,$teacher_id,$course_name,$course_code,$time);

   			if($conn->query($sql) === TRUE){
   				$obj = new stdClass();
   				$obj->success = 'added to '.$day.'day';
               $obj->code = "200";
   				echo json_encode($obj);
   			
   			}


   		}
   }
}