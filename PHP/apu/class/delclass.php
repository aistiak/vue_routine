<?php
include('connect.php');

if($_SERVER['REQUEST_METHOD'] === 'GET'){

	$day = $_GET['day'];
	$token = $_GET['token'];
	$time = $_GET['time'];

	$teacher_id = $_GET['teacher_id'];
	$course_name = $_GET['course_name'];

	if(is_null($day) || is_null($token) || is_null($teacher_id) || is_null($course_name)){

		$obj = new stdClas();
		$obj->error = 'not enough info.';
		echo json_encode($obj);
		reutun;
	}

	// make the period slot 0 (false /not taken)
	$slot = $day."_slot";
	$sql = sprintf("update %s set slot=0 where time='%s'",$slot,$time);	
	$result = $conn->query($sql);
	

	$sql = "select * from token_holder";
	$result = $conn->query($sql);


		while ($row = $result->fetch_assoc()) {
			# code...
			if($token === $row['token']){

				$sql = sprintf("delete from %s where teacher_id=%s && course_name='%s'",$day,$teacher_id,$course_name);
				$result = $conn->query($sql);

				if($result === TRUE){
					$obj = new stdClass();
					$obj->success = 'data deleted.';
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