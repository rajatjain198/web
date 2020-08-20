<?php
require('./mysqli_connect.php');
require('./admin/functions.inc.php');
session_start();
$otp=get_safe_value($con,$_POST['otp']);
$type=get_safe_value($con,$_POST['type']);
if($type=='email'){
    if($otp==$_SESSION['EMAIL_OTP']){
        echo "done";
    }else{
        echo "no";
    }
	
}


?>