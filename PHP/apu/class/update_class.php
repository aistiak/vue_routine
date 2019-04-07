<?php
// untested endpoint
include('connect.php');

if($_SERVER['REQUEST_METHOD'] === 'GET'){

	$day = $_GET['day'];
	$token = $_GET['token'];

	$teacher_id = $_GET['teacher_id'];
	$course_name = $_GET['course_name'];


	$u_teacher_id = $_GET['u_teacher_id'];
	$u_course_name = $_GET['u_course_name'];
	$u_course_code = $_GET['u_course_code'];
	$u_time = $_GET['u_time'];


	if(is_null($day) || is_null($token) || is_null($teacher_id) || is_null($course_name)){

		$obj = new stdClas();
		$obj->error = 'not enough info.';
		echo json_encode($obj);
		reutun;
	}
	if(is_null($u_teacher_id) || is_null($u_course_code) || is_null($u_course_name) || is_null($u_time)){
		$obj = new stdClas();
		$obj->error = 'not enough info to update.';
		echo json_encode($obj);
		reutun; 
	}

	$sql = "select * from token_holder";
	$result = $conn->query($sql);

		while ($row = $result->fetch_assoc()) {
			# code...
			if($token === $row['token']){

				$sql = sprintf("UPDATE %s SET teacher_id = %s ,course_name = '%s', course_code = '%s', time = '%s' WHERE teacher_id=%s && course_name='%s'",$day,$u_teacher_id,$u_course_name,$u_course_code,$teacher_id,$course_name);
				$result = $conn->query($sql);

				if($result === TRUE){
					$obj = new stdClass();
					$obj->success = 'data updated.';
					echo json_encode($obj);
					reutun;
				}else{
					$obj = new stdClass();
					$obj->error = 'unexpected error.';
					echo json_encode($obj);
					reutun;
				}	
			}
		}


		$obj = new stdClass();
		$obj->error = 'unexpected error. line 47';
		echo json_encode($obj);
		return;		

	

}