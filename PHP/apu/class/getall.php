<?php
include ("connect.php"); 	
if($_SERVER['REQUEST_METHOD'] === 'GET'){
   $token = $_GET['token'];
   $day   = $_GET['day'];
   $sql = sprintf("select * from token_holder where token='%s'",$token);
   $result = $conn->query($sql);
   
   $arr = [];
   while ($row = $result->fetch_assoc()) {
   	# code...

   	     if($row['token'] === $token){

   	     	$sql = sprintf('select * from %s',$day);
   	     	$result = $conn->query($sql);
   	     	while ($row = $result->fetch_assoc()) {
   	     		# code...
   	     		$response = new stdClass();
   	     		$response->teacher_id = $row['teacher_id'];
   	     		$response->course_name = $row['course_name'];
   	     		$response->course_code = $row['course_code'];
   	     		$response->time = $row['time'];
               // have to add teacher name 
               $sql = sprintf("select * from teacher where id=%s",$row['teacher_id']);
               $res = $conn->query($sql);

               while ($r = $res->fetch_assoc()) {
                  # code...
                  $response->teacher_name = $r['name'];
                  break;
               }

   	     		array_push($arr,$response);

   	     	}
   	     	echo json_encode($arr);
   	     	return;
   	     }
   }
}
