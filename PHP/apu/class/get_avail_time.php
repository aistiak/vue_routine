<?php

include("connect.php");

	if($_SERVER['REQUEST_METHOD'] === 'GET'){

		$token = $_GET['token'];
		$day   = $_GET['day'];

		if(is_null($token) || is_null($token)){

			$err = new stdClass();
			$err->code = "401";
			$err->error = "not enough info.";

			echo json_encode($err);
			return ; 
		}

		$slot_name = $day."_slot";
		$sql = sprintf("select * from %s",$slot_name);
		$result = $conn->query($sql);

		$response = [];
		while ($row = $result->fetch_assoc()) {
			# code...
			/*$temp = new stdClass();
			$temp->time = $row['time'];*/

			if($row['slot'] === '0'){
				array_push($response,$row['time']);
			}

		}

		$obj = new stdClass();
		$obj->code = "200";
		$obj->response = $response;

		echo json_encode($obj);
		$conn->close();
		return;


	}