<?php
    // header.php
    include ('header.php');
    require('./admin/functions.inc.php');
    require('./mysqli_connect.php');
?>
<?php
if(!isset($_SESSION['loggedin'])||$_SESSION['loggedin']!==true){
    header('location:login.php');
}
?>
<?php
$user_id=$_SESSION['user_id'];
$details=mysqli_query($con,"SELECT * FROM orders WHERE user_id='$user_id' LIMIT 1");
if($details){
$row=mysqli_fetch_array($details);
if(mysqli_num_rows($details)==1){
$name=$row['name'];
$mobile=$row['mobile'];
$address=$row['address'];
$email=$row['email'];
$city=$row['city'];
$state=$row['state'];
$pincode=$row['pincode'];
}else{
    $name='';
    $mobile='';
    $address='';
    $email='';
    $city='';
    $state='';
    $pincode='';
    
}
}else{
    $name='';
    $mobile='';
    $address='';
    $email='';
    $city='';
    $state='';
    $pincode='';
    
}

$payment_type='';
$order_status='';
$added_on='';
$user_id=$_SESSION['user_id'];
$item_id='';
$total_price='';

if($_SERVER['REQUEST_METHOD']=="POST"){
if(isset($_POST['place'])){
$name=get_safe_value($con,$_POST['name']);
$mobile=get_safe_value($con,$_POST['mobile']);
$address=get_safe_value($con,$_POST['address']);
$email=get_safe_value($con,$_POST['email']);
$city=get_safe_value($con,$_POST['city']);
$state=get_safe_value($con,$_POST['state']);
$pincode=get_safe_value($con,$_POST['pincode']);
$txnid = substr(hash('sha256', mt_rand() . microtime()), 0, 20);
$payment_type=$_POST['payment'];
$added_on=date('Y-m-d h:i:s');
$total_price=$_POST['total_price'];
$payment_status='Pending';
$order_status='Placed';
$sql="INSERT INTO orders(user_id,name,mobile,email,address,city,state,pincode,payment_type,total_price,payment_status,order_status,added_on,txnid) VALUES('$user_id','$name','$mobile','$email','$address','$city','$state','$pincode','$payment_type','$total_price','$payment_status','$order_status','$added_on','$txnid')";
$res=mysqli_query($con,$sql);
if($res){
    $order_id=mysqli_insert_id($con);

    foreach($_SESSION['cart'] as $key=>$val){
        $qty=$val['qty'];
    $result=mysqli_query($con,"INSERT INTO order_detail(order_id,product_id,qty) VALUES('$order_id','$key','$qty')");
    }

    unset($_SESSION['cart']);
    if($payment_type=='payu'){
        $MERCHANT_KEY = "gtKFFx"; 
        $SALT = "eCwWELxi";
        $hash_string = '';
        //$PAYU_BASE_URL = "https://secure.payu.in";
        $PAYU_BASE_URL = "https://test.payu.in";
        $action = '';
        $posted = array();
        if(!empty($_POST)) {
          foreach($_POST as $key => $value) {    
            $posted[$key] = $value; 
          }
        }
        $formError = 0;
        
        $posted['txnid']=$txnid;
        $posted['amount']=$total_price;
        $posted['firstname']=$name;
        $posted['email']=$email;
        $posted['phone']=$mobile;
        $posted['productinfo']="productinfo";
        $posted['key']=$MERCHANT_KEY ;
        $hash = '';
        $hashSequence = "key|txnid|amount|productinfo|firstname|email|udf1|udf2|udf3|udf4|udf5|udf6|udf7|udf8|udf9|udf10";
        if(empty($posted['hash']) && sizeof($posted) > 0) {
          if(
                  empty($posted['key'])
                  || empty($posted['txnid'])
                  || empty($posted['amount'])
                  || empty($posted['firstname'])
                  || empty($posted['email'])
                  || empty($posted['phone'])
                  || empty($posted['productinfo'])
                 
          ) {
            $formError = 1;
          } else {    
            $hashVarsSeq = explode('|', $hashSequence);
            foreach($hashVarsSeq as $hash_var) {
              $hash_string .= isset($posted[$hash_var]) ? $posted[$hash_var] : '';
              $hash_string .= '|';
            }
            $hash_string .= $SALT;
            $hash = strtolower(hash('sha512', $hash_string));
            $action = $PAYU_BASE_URL . '/_payment';
          }
        } elseif(!empty($posted['hash'])) {
          $hash = $posted['hash'];
          $action = $PAYU_BASE_URL . '/_payment';
        }
        
        
        $formHtml ='<form method="post" name="payuForm" id="payuForm" action="'.$action.'"><input type="hidden" name="key" value="'.$MERCHANT_KEY.'" /><input type="hidden" name="hash" value="'.$hash.'"/><input type="hidden" name="txnid" value="'.$posted['txnid'].'" /><input name="amount" type="hidden" value="'.$posted['amount'].'" /><input type="hidden" name="firstname" id="firstname" value="'.$posted['firstname'].'" /><input type="hidden" name="email" id="email" value="'.$posted['email'].'" /><input type="hidden" name="phone" value="'.$posted['phone'].'" /><textarea name="productinfo" style="display:none;">'.$posted['productinfo'].'</textarea><input type="hidden" name="surl" value="http://127.0.0.1/Website/payment_complete.php" /><input type="hidden" name="furl" value="http://127.0.0.1/Website/payment_fail.php"/><input type="submit" style="display:none;"/></form>';
        echo $formHtml;
        echo '<script>document.getElementById("payuForm").submit();</script>';

    }else{
        unset($_SESSION['cart']);
        header('location:thank.php');
    }
}else{
    echo "Errorrrrrrrr";
}

}

}


?>
<!-- Address area -->
<section id="register">
        <div class="row m-0">
            <div class="col-lg-8 offset-lg-2">
                <div class="text-center pb-5">
                    <h1 class="login-title text-dark">Delivery and Payment</h1>
                    <h4 class="p-3 m-0 font-ubuntu text-black-50">Select Address</h4>
                    
                </div>
                <div class="d-flex justify-content-center">
                    <form action="cart_order.php" method="post" enctype="multipart/form-data" id="reg-form">
                    <div class="form-row my-4">
                        <div class="col">
                                <input type="text" value="<?php echo $name;  ?>" name="name" id="name" class="form-control" placeholder="Name*" required>
                            </div>  
                        <div class="col">
                                <input type="text" value="<?php echo $mobile;  ?>" required name="mobile" id="mobile" class="form-control" placeholder="Mobile*">
                            </div>
                        </div>   
                    <div class="form-row">
                            <div class="col">
                                <input type="text" value="<?php echo $address;  ?>" name="address" id="city" class="form-control" placeholder="Delivery Address*" required>
                            </div>
                            <input type="hidden" name="total_price" value="<?php echo $_POST['total_price'];?>">
                        </div>
                        <div class="form-row my-4">
                        <div class="col">
                                <input type="email" value="<?php echo $email;  ?>" name="email" id="email" class="form-control" placeholder="Email*" required>
                            </div>  
                            <div class="col">
                                <input type="text" value="<?php echo $city;  ?>" name="city" id="city" class="form-control" placeholder="City*" required>
                            </div>
                        </div>
                        <div class="form-row my-4">
                             
                            <div class="col">
                                <input type="text" value="<?php echo $pincode;  ?>" required name="pincode" id="pincode" class="form-control" placeholder="Pincode*">
                            </div>
                            <div class="col">
                                <input type="text" value="<?php echo $state;  ?>" required name="state" id="state" class="form-control" placeholder="State*">
                            </div>
                        </div>
                        <h4 class="p-3 m-3 font-ubuntu text-black-50 text-center">Select Payment Mode</h4>
                        
                        <div class="form-check form-check-inline">
                                <input type="radio" name="payment" id="cod" class="form-control" value="cod" required>
                                <label for="cod" class="form-radio-label font-ubuntu text-black-50">Cash On Delivery</label><br>
                                
                        </div>
                        <div class="form-check form-check-inline">
                        <input type="radio" name="payment" id="payu" class="form-control" value="payu" required>
                                <label for="payu" class="form-radio-label font-ubuntu text-black-50">Payment Portal PayU</label> <br>   
                        </div>
                        

                        <div class="submit-btn text-center my-5">
                            <button type="submit" name="place" class="btn btn-warning rounded-pill text-dark px-5">Place Order</button>
                        </div>
                       

                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- #Address area -->













<?php
    // footer.php
    include ('footer.php');
?>