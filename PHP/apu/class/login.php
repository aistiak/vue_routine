<?php
include ("connect.php"); 
//echo "Connected successfully";

if($_SERVER['REQUEST_METHOD'] === 'GET'){

	$name = $_GET['name'];
	$password = $_GET['password'];


	$sql = "SELECT id,password FROM user where name='".$name."';";
	$result = $conn->query($sql);

	if ($result->num_rows > 0) {
    // output data of each row

		while($row = $result->fetch_assoc()) {
			$user_id = $row['id'];

			if($password === $row['password']){
				
                // if password patches then save and send a token 
				$token = generateRandomString();
				$sql = "insert into token_holder (user_id,token) values(".$user_id.",'".$token."')";
				//$sql = "inset into token_holder (user_id,token) values(2,'dim')";
				//$result = $conn->query($sql);
				//echo (string) $result; 
				if ($conn->query($sql) === TRUE) {
					$tok = new stdClass();
					$tok->token = $token;
					$tok->code = "200";
					echo json_encode($tok);
					return;
				} else {
					$myObj = new stdClass();
					$myObj->code = "401";
					$myObj->msg = "error" ;
					echo json_encode($myObj);
					return;
				}
				return ;
			}
		}
	} 
	$conn->close();

	$myObj = new stdClass();
	$myObj->code = "401";
	$myObj->msg = "wrong user name or password";
	echo json_encode($myObj);
	return ;



} 
function generateRandomString($length = 20) {
	$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	$charactersLength = strlen($characters);
	$randomString = '';
	for ($i = 0; $i < $length; $i++) {
		$randomString .= $characters[rand(0, $charactersLength - 1)];
	}
	return $randomString;
}

?>