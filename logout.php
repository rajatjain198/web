<?php


session_start();
//if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !==true){
  //  header("location: signup.php");    
//}else{
$_SESSION = array();
unset($_SESSION["first_name"]);
unset($_SESSION["user_id"]);
unset($_SESSION["loggedin"]);
header("location: index.php");
//}
?>