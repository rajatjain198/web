
<?php

// header.php
    include ('header.php');
?>
 <?php
 
if(isset($_SESSION['loggedin']))
    {
        header("location: index.php");
        die();
    }
    ?>
    <?php
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            if(isset($_POST['continue'])){
            require ('register-process.php');
        }
    }
    ?>

    <!-- registration area -->
    <section id="register">
        <div class="row m-0">
            <div class="col-lg-8 offset-lg-2">
                <div class="text-center pb-5">
                    <h1 class="login-title text-dark">Register</h1>
                    <p class="p-1 m-0 font-ubuntu text-black-50">Register and enjoy additional features</p>
                    <span class="font-ubuntu text-black-50">Already have an Account? <a href="login.php">Login</a></span>
                </div>
                <div class="d-flex justify-content-center">
                    <form action="register.php" method="post" enctype="multipart/form-data" id="reg-form">
                        <div class="form-row">
                            <div class="col">
                                <input type="text" value="<?php if(isset($_POST['firstName'])) echo $_POST['firstName'];  ?>" name="firstName" id="firstName" class="form-control" placeholder="First Name">
                            </div>
                            
                            <div class="col">
                                <input type="text" value="<?php if(isset($_POST['LastName'])) echo $_POST['LastName'];  ?>" name="LastName" id="LastName" class="form-control" placeholder="Last Name">
                            </div>
                        </div>
                        <span class="text-danger" id="name_error"></span>
                        <div class="form-row my-4">
                            <div class="col">
                                <input type="text" value="<?php if(isset($_POST['mobile'])) echo $_POST['mobile'];  ?>" required name="mobile" id="mobile" class="form-control" placeholder="Mobile*">
                            </div>
                        </div>
                        <span class="text-danger" id="mobile_error"></span>

                        <div class="form-row my-4">
                            <div class="col">
                                <input type="email" value="<?php if(isset($_POST['email'])) echo $_POST['email'];  ?>" required name="email" id="email" class="form-control" placeholder="Email*">
                                <span id="email_otp_result" class="text-danger text-left"></span>    
                            </div>
                            
                            <button type="button" class="btn btn-dark rounded-pill text-light px-5 email_sent_otp" onclick="email_sent_otp()">Verify Email</button>
                        </div>
                        
                            <div class="form-row my-4">    
                            <span class="text-danger" id="email_error"></span>
                            
                            <div class="col">
                            <input type="text" name="email_otp" id="email_otp" class="form-control email_verify_otp" placeholder="OTP">
                            </div>
                        
                            <button type="button" class="btn btn-dark rounded-pill text-light px-5 email_verify_otp" onclick="email_verify_otp()">Verify OTP</button>
                        
                        </div>
                        
                        <div class="form-row my-4">
                            <div class="col">
                                <input type="password" required name="password" id="password" class="form-control" placeholder="password*">
                            </div>
                        </div>
                        <span class="field_error" id="password_error"></span>
                        <div class="form-row my-4">
                            <div class="col">
                                <input type="password" required name="confirm_pwd" id="confirm_pwd" class="form-control" placeholder="Confirm Password*">
                                <small id="confirm_error" class="text-danger"></small>
                            </div>
                        </div>
                        <span class="field_error" id="name_error"></span>
                        <div class="form-check form-check-inline">
                            <input type="checkbox" name="agreement" class="form-check-input" required>
                            <label for="agreement" class="form-check-label font-ubuntu text-black-50">I agree <a href="#">term, conditions, and policy </a>(*) </label>
                        </div>

                        <div class="submit-btn text-center my-5">
                            <button type="submit" name="continue" class="btn btn-warning rounded-pill text-dark px-5" onclick="user_register()" id="btn_register" disabled>Continue</button>
                        </div>
                       

                    </form>
                </div>
            </div>
        </div>
    </section>
    
    <!-- #registration area -->
<script>
function email_sent_otp(){
    jQuery('#email_error').html(''); 
    var email=jQuery('#email').val();
    if(email==''){
        jQuery('#email_error').html('Please Enter Email Id'); 
    }else{
        jQuery('.email_sent_otp').html('Please Wait');
        jQuery('.email_sent_otp').attr('disabled',true);
        jQuery.ajax({
            url: 'send_otp.php',
            type:'post',
            data:'email='+email+'&type=email',
            success:function(result){
                if(result=='done'){ 
                    jQuery('#email').attr('readonly',true);
                    jQuery('.email_verify_otp').show();
                    jQuery('.email_sent_otp').hide();
                }else if(result=='email_present'){
                    jQuery('.email_sent_otp').html('Send OTP');
                    jQuery('.email_sent_otp').attr('readonly',false);
                    jQuery('#email_error').html('Email Already Registered'); 
                }else{
                    jQuery('.email_sent_otp').html('Send OTP');
                    jQuery('.email_sent_otp').attr('readonly',false);
                    jQuery('#email_error').html('Please Try after Sometime'); 
                }
            }
        });
    
    }
}
function email_verify_otp(){
    jQuery('#email_error').html(''); 
    var email_otp=jQuery('#email_otp').val();
    if(email_otp==''){
        jQuery('#email_otp_result').html('Please Enter OTP'); 
    }else{
        jQuery.ajax({
            url: 'check_otp.php',
            type:'post',
            data:'otp='+email_otp+'&type=email',
            success:function(result){
                if(result=='done'){
                    jQuery('.email_verify_otp').hide();
                    jQuery('#email_otp_result').html('Email Verified');   
                    jQuery('#btn_register').attr('disabled',false);

                }else{
                    jQuery('#email_otp_result').html('Please Enter Valid OTP'); 
                }
            }
        });
    
    }
}

</script>

<?php
    // footer.php
    include ('footer.php');
?>