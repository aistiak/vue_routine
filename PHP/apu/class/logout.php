<?php
include ("connect.php"); 


if($_SERVER['REQUEST_METHOD'] === 'GET'){
    
	$token = $_GET['token'];
    
       // search token in db then if found drop the row 

	$sql = "delete from token_holder where token='".$token."';";
	$result = $conn->query($sql);
	if ($conn->query($sql) === TRUE) {
		$response = new stdClass();
		$response->success = "logged out";
		echo json_encode($response);

	} else {
		echo "Error: " . $sql . "<br>" . $conn->error;
	}
}


?>