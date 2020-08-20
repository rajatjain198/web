<?php  
require_once('helper.php');
$error = array();

$email =$_POST['email'];
if (empty($email)){
    $error[] = "You forgot to enter your Email";
}

$password = $_POST['password'];
if (empty($password)){
    $error[] = "You forgot to enter your password";
}

if(empty($error)){
    // sql query
    $query = "SELECT user_id, first_name, last_name, mobile, email, password, FROM user WHERE email=?";
    
    $stmt=mysqli_prepare($con, $query);

    // bind parameter
    mysqli_stmt_bind_param($stmt, "s" , $email);
    //execute query
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);

    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

    if (!empty($row)){
        // verify password
        if(password_verify($password, $row['password'])){
            header("location: index.php");
            exit();
        }
    }else{
        print "You are not a member please register!";
    }

}else{
    echo "Please Fill out email and password to login!";
}
