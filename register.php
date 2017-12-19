<?php
require('connection.php');

if(isset($_POST['email']) && isset($_POST['password']) && isset($_POST['psw-repeat'])){
    
    $errore=false;
    
    //pasaggio password
    $password = $_POST['password'];
    $passwordConfirm = $_POST['psw-repeat'];
    
    //controllo password
    if(strlen($_POST['password']) < 3){
		echo 'Password is too short.';
        $errore= true;
        $connection->close();
        
	}
	if(strlen($_POST['psw-repeat']) < 3){
		echo 'Confirm password is too short.';
        $errore= true;
        $connection->close();
	}
	if($_POST['password'] != $_POST['psw-repeat']){
		echo 'Passwords do not match.';
        $errore= true;
        $connection->close();
    }
    
    //passaggio email
    $email = $_POST['email'];
    // controlo validità email
    if(filter_var($email,FILTER_VALIDATE_EMAIL)){
        $query="SELECT u_id FROM utente WHERE email='$email'";      //
        $result = $connection->query($query);                       // 
        if ($result->num_rows > 0){                                 // controllo se è già presente nel db  
            $errore=true;											//
            $connection->close();									//
        }else{                                                      //
            $errore=false;											//
        }
    }else{
        echo 'non valida';
    }
	
	echo $errore;
	
	if($errore == false){
		$pass_hash = password_hash($password,PASSWORD_BCRYPT);
    	$insertQuery = "INSERT INTO `my_wavesound`.`utente` (`email`, `pass`) VALUES ('$email', '$pass_hash');";
		echo $insertQuery;
    	$result = $connection->query($insertQuery);
    
	}
}

$connection->close();

        

//        if($result){
//            echo "User Created Successfully.";
//            //send mail
//            $to = $_POST['email'];
//            $subject = "Registration Confirmation";
//            $res = mysqli_query($connection, "SELECT u_id FROM utente WHERE email = '$email'");
//            $current_id = mysqli_fetch_array($res);
//            $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"."activate.php?id=" . $current_id;
//            $body = "Click this link to activate your account. <a href='" . $actual_link . "'>" . $actual_link . "</a>";
//            $mailHeaders = "From: Admin\r\n";
//            if(mail($to, $subject, $body, $mailHeaders)) {
//                $message = "You have registered and the activation mail is sent to your email. Click the activation link to activate you account.";	
//            }
//            unset($_POST);
//            header('Location: main.html');  
//        }else{
//            echo "User Registration Failed";
//        }
    

?>