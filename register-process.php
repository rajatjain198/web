<?php

require ('helper.php');
require ('mysqli_connect.php');

// error variable.
$error = array();
$email_er='';
$check_mobile='';
$firstName = validate_input_text($_POST['firstName']);
if (empty($firstName)){
    $error[] = "You forgot to enter your first Name";
}

$lastName = validate_input_text($_POST['LastName']);
if (empty($lastName)){
    $error[] = "You forgot to enter your Last Name";
}
$mobile = validate_input_text($_POST['mobile']);
if (empty($mobile)){
    $error[] = "You forgot to enter your Last Name";
}
$email = validate_input_email($_POST['email']);
if (empty($email)){
    $error[] = "You forgot to enter your Email";
}

$password = validate_input_text($_POST['password']);
if (empty($password)){
    $error[] = "You forgot to enter your password";
}

$confirm_pwd = validate_input_text($_POST['confirm_pwd']);
if (empty($confirm_pwd)){
    $error[] = "You forgot to enter your Confirm Password";
}
$email_er=mysqli_query($con,"SELECT email FROM user WHERE email=$email");
if(!empty($email_er)){
    echo "present";
    
}

$check_mobile=mysqli_num_rows(mysqli_query($con,"SELECT * FROM user WHERE mobile=$mobile"));
if($check_mobile>0){
    echo '<script>alert("Mobile No. Already Exist")</script>';
    $error[]="Mobile/Email  Already Exist";
}


if(empty($error)){
    // register a new user
    $hashed_pass = password_hash($password, PASSWORD_DEFAULT);
    
    // make a query
    $query = "INSERT INTO user (user_id, first_name, last_name, mobile, email, password, register_date )";
    $query .= "VALUES(' ', ?, ?, ?, ?, ?, NOW())";

    // initialize a statement
    $q = mysqli_stmt_init($con);

    // prepare sql statement
    mysqli_stmt_prepare($q, $query);

    // bind values
    mysqli_stmt_bind_param($q, 'sssss', $firstName, $lastName, $mobile, $email, $hashed_pass);

    // execute statement
    mysqli_stmt_execute($q);

    if(mysqli_stmt_affected_rows($q) == 1){

        // start a new session
        session_start();

        // create session variable
        //$_SESSION['user_id'] = mysqli_insert_id($con);

        header('location: login.php');
        exit();
    }else{
        print "Error while registration...!";
    }

}else{
    
}


















