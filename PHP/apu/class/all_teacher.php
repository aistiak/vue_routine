<?php

include("connect.php");

	if($_SERVER['REQUEST_METHOD'] === 'GET'){

		$token = $_GET['token'];


		if(is_null($token)){

			$err = new stdClass();
			$err->code = "401";
			$err->error = "invalid token.";
			echo json_encode($err);
			return ;	
		}

		$sql = "select * from teacher";
		
		$result = $conn->query($sql);

		$response = [];
		while ($row = $result->fetch_assoc()) {
			# code...
			$temp = new stdClass();
			$temp->id = $row['id'];
			$temp->name = $row['name'];
			array_push($response, $temp);
		}

		$obj = new stdClass();
		$obj->response = $response ;
		$obj->code = "200";

		echo json_encode($obj);

		$conn->close();

		return ;


	}