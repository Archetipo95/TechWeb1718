<?php
    require('connection.php');
    require('msg.php');
    require('tools.php');
    
    $postName = array(
        "username",
        "name",
        "surname",
        "birthday",
        "email",
        "oldPassword"
    );
    $toBeChanged = array();
    
    /*
     **true at 1st post not empty
     */
    function checkPost() {
        global $postName;
        for ($i = 0; $i < count($postName); $i++) {
            if (!empty($_POST[$postName[$i]])) {
                return true;
            }
        }
        return false;
    }
    
    /*
     **find element to change
     */
    function toBeChanged() {
        global $postName, $toBeChanged;
        for ($i = 0; $i < count($postName); $i++) {
            if (!empty($_POST[$postName[$i]])) {
                array_push($toBeChanged, "$i");
            }
        }
    }
    
    if (checkPost()) {
        global $postName, $toBeChanged;
        toBeChanged();
        session_start();
        $userID = $_SESSION["userID"];
        $errors;
        
        for ($i = 0; $i < count($toBeChanged); $i++) {
            switch ($toBeChanged[$i]) {
                case 0: //username
                    $username = sanitize($_POST["username"]);
                    $result   = select("SELECT u_id FROM user WHERE username='$username';");
                    
                    if (checkPresence($result->num_rows) && $username != '') {
                        $userID = $_SESSION["userID"];
                        update("UPDATE user SET username = '$username' WHERE u_id = '$userID' ");
                        session_start();
                        $_SESSION["username"] = $username;
                    } else {
                        $errors = $errors . "Username already taken or not valid";
                    }
                    break;
                case 1: //name
                    $name = sanitize($_POST["name"]);
                    if ($name != '')
                        update("UPDATE user SET name = '$name' WHERE u_id = '$userID' ");
                    else
                        $errors = $errors . " Name not valid";
                    break;
                case 2: //surname
                    $surname = sanitize($_POST["surname"]);
                    if ($surname != '')
                        update("UPDATE user SET surname = '$surname' WHERE u_id = '$userID' ");
                    else
                        $errors = $errors . " Surname not valid";
                    break;
                case 3: //birthday
                    $birthday = $_POST["birthday"];
                    update("UPDATE user SET birthday = '$birthday' WHERE u_id = '$userID' ");
                    break;
                case 4: //email
                    $email = $_POST["email"];
                    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                        $result = select("SELECT u_id FROM user WHERE email='$email';");
                        if (checkPresence($result->num_rows)) {
                            update("UPDATE user SET email = '$email' WHERE u_id = '$userID' ");
                        } else {
                            $errors = $errors . " Email already used";
                        }
                    } else {
                        $errors = $errors . " Email not valid";
                    }
                    break;
                case 5: //oldpassword
                    if (!empty($_POST['newPassword']) && !empty($_POST['newPasswordConfirm'])) {
                        $oldPassword        = $_POST['oldPassword'];
                        $newPassword        = $_POST['newPassword'];
                        $newPasswordConfirm = $_POST['newPasswordConfirm'];
                        if (checkPasswordLenght($newPassword) && confirmPassword($newPassword, $newPasswordConfirm)) {
                            $result = select("SELECT password FROM user WHERE u_id = '$userID' ");
                            $row    = $result[0];
                            echo $row[0];
                            if ($oldPassword == $row[0]) {
                                update("UPDATE user SET password = '$newPassword' WHERE u_id = '$userID' ");
                            } else {
                                $errors = $errors . " Old password is wrong";
                            }
                        } else {
                            $errors = $errors . " New password too short or different from confirm";
                        }
                    } else {
                        $errors = $errors . +" New password or confirm empty";
                    }
                    break;
            }
        }
        if ($errors === NULL)
            $errors = "Everything was updated";
        sendMessage("$errors");
    } else {
        sendMessage("Nothing to change");
    }
?>