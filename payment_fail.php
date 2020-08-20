<?php
include('./mysqli_connect.php');
$payment_mode=$_POST['mode'];
$pay_id=$_POST['mihpayid'];
$status=$_POST["status"];
$firstname=$_POST["firstname"];
$amount=$_POST["amount"];
$txnid=$_POST["txnid"];
$posted_hash=$_POST["hash"];
$key=$_POST["key"];
$productinfo=$_POST["productinfo"];
$email=$_POST["email"];
$res=mysqli_query($con,"UPDATE orders SET payment_status='$status', mihpayid='$pay_id' where txnid='$txnid'");	
if($res){
    header('location:sorry.php');
}
?>