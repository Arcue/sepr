<?php
session_start();

// variable declaration
$username = "";
$email  = "";
$errors = array();
$_SESSION['success'] = "";

// connect to database
$db = mysqli_connect('localhost', 'webuser', 'J2HRt9BlBMwkoxA2', 'projekt2');
if ($db == true){
    if(isset($_SESSION['username'])) {
        if ($userlist == true) {
            $sql = "SELECT * FROM Users JOIN webgroup ON Users.webgroup = webgroup.gid";
            $result = $db->query($sql);
        }
        //if ($currentuser == true){
        //    $sql = "SELECT * FROM Users WHERE username='.$_SESSION['username'].'"
        //}
    }
}
// LOGIN USER
if (isset($_POST['log_user'])) {
    $username = $db->real_escape_string($_POST['username']);
    //$unspassword = $db->real_escape_string($_POST['password']);
    $result = $db->query("SELECT * FROM Users WHERE username='$username'");
    $num_rows = $result->num_rows;
    if (empty($username)) { array_push($errors, "Username is required"); }

    elseif ($num_rows == 0) { array_push($errors, "Username doesn't exist"); }
    else{
        $saltresult = $db->query("SELECT salt FROM Users WHERE username='$username'");
        while ($row = $saltresult->fetch_object()) {
            $salt = $row->salt;
        }
        $saltresult->close();
        $password = hash('sha256', $salt.$_POST['password']);
        $matchcheck = $db->query("SELECT * FROM Users WHERE username='$username' and password='$password'");
        if(!(mysqli_num_rows($matchcheck) === 1)){ array_push($errors, "Wrong password!"); }
        else{
            $userrole="";
            $getrole = $db->query("SELECT groupname FROM Users JOIN webgroup ON Users.webgroup = webgroup.gid WHERE username='$username'");
            while ($row = $getrole->fetch_object()){
                $userrole = $row->groupname;
            }
            $lastvisited = date("d F Y H:i:s");
            $query = "UPDATE Users SET lastvisited='$lastvisited' WHERE username='$username'";
            if($db->query($query) === TRUE){

            } else {
                echo mysqli_error($db);
            }
            $_SESSION['username'] = $username;
            $_SESSION['userrole'] = $userrole;
            $_SESSION['userinfo'] = array(
            );
        }
    }

}

if (isset($_POST['deleteUser'])){
    $userToDelete = $db->real_escape_string($_POST['deleteUser']);
    $deleteQuery = "DELETE FROM Users WHERE username='$userToDelete'";  //because how register form works, usernames are unique, even tho it's not forced in sql
    if($db->query($deleteQuery)){
        array_push($errors, "User deleted succesfully! ".$userToDelete );
        header('Location:  ' . $_SERVER['users.php']);
    }
    else {
        array_push($errors, "Something went wrong!");
    }
}
// LOGOUT USER
if (isset($_POST['logout'])) {
    session_unset();
    header('Location:  ' . $_SERVER['index.php']);
}

// REGISTER USER
if (isset($_POST['reg_user'])) {
    // receive all input values from the form
    $username = $db->real_escape_string($_POST['username']);
    $email = $db->real_escape_string($_POST['email']);
    $password_1 = $db->real_escape_string($_POST['password_1']);
    $password_2 = $db->real_escape_string($_POST['password_2']);

    // form validation: ensure that the form is correctly filled
    if (empty($username)) { array_push($errors, "Username is required"); }

    $result = $db->query("SELECT * FROM Users WHERE username='$username'");
    $num_rows = $result->num_rows;

    if ($num_rows) { array_push($errors, "Username exists already"); }
    if (empty($email)) { array_push($errors, "Email is required"); }
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)) { array_push($errors, "Email is invalid"); }
    if (empty($password_1)) { array_push($errors, "Password is required"); }
    if ($password_1 != $password_2) {
        array_push($errors, "The two passwords do not match");
    }
    // register user if there are no errors in the form
    if (count($errors) == 0) {
        $bytes = openssl_random_pseudo_bytes(16);
        $salt = bin2hex($bytes);
        $password = hash('sha256', $salt.$password_1);
        $query = "INSERT INTO Users (username, password, salt, email) 
  			  VALUES('$username', '$password', '$salt', '$email')";
        if($db->query($query) === TRUE){

        } else {
            echo mysqli_error($db);
        }
        $_SESSION['username'] = $username;
        $_SESSION['success'] = "You are now logged in";
        header('Location: http://arcu.asuscomm.com/index.php');
    }

}
