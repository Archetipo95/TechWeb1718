<?php

require('connection.php');
require('msg.php');

if(isset($_POST['email']) && isset($_POST['password'])){
		
	/*save varialble*/
	$password = $_POST['password'];
	$email = $_POST['email'];
	
	/*find out password*/
	$getUser = "SELECT * FROM user WHERE email='$email'";
	$result = $connection->query($getUser);
	
	/*check if email exist in db*/
	if($result->num_rows === 1){
		$row = mysqli_fetch_row($result);
		/*
		$row[0] is User ID
		$row[1] is Username
		$row[2] is Name
		$row[3] is Surname
		$row[4] is Bday
		$row[5] is email
		$row[6] is User_Type
		$row[7] is Password
		$row[8] is Avatar
		$row[9] is Id_library
		*/
		/*check password correctness*/
		if(password_verify($password,$row[7])){
			/*find out username*/
			session_start();
			$_SESSION["username"] = $row[1];
			header("Location:../main.html");
		}else{
			sendMessage("Login Failed");
		}
	}else{
		sendMessage("Login Failed");
	}
}

?>
