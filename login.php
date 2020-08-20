<?php

//session_start();
// header.php
include ('header.php');
include ('helper.php');
?>

<?php
    $user = array();
   // require_once('./mysqli_connect.php');
   
  
   
    if(isset($_SESSION['loggedin']))
    {
        header("location: index.php");
        die();
    }
    require_once "mysqli_connect.php";
    
    $email = $password = "";
    $err = "";

    if ($_SERVER['REQUEST_METHOD'] == "POST"){
        if(empty(trim($_POST['email'])) || empty(trim($_POST['password'])))
        {
            $err = "Please enter email + password";
        }
        else{
            $email = trim($_POST['email']);
            $password = trim($_POST['password']);
        }
    
    
    if(empty($err))
    {
        $sql = "SELECT user_id, first_name, password FROM user WHERE email = ?";
        $stmt = mysqli_prepare($con, $sql);
        mysqli_stmt_bind_param($stmt, "s", $param_username);
        $param_username = $email;
        
        
        // Try to execute this statement
        if(mysqli_stmt_execute($stmt)){
            mysqli_stmt_store_result($stmt);
            if(mysqli_stmt_num_rows($stmt) == 1)
                    {
                        mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password);
                        if(mysqli_stmt_fetch($stmt))
                        {
                            if(password_verify($password, $hashed_password))
                            {
                                // this means the password is corrct. Allow user to login
                                session_start();
                                $_SESSION["first_name"] = $username;
                                $_SESSION["user_id"] = $id;
                                $_SESSION["loggedin"] = true;
    
                                //Redirect user to welcome page
                                $refurl = isset($_POST['refurl']) ? base64_decode($_POST['refurl']) : '';
                                if(!empty($refurl)){
                                    header("Location: $refurl");
                                    die();
                                }
                                else{
                                    header("Location: index.php");
                                    die();
                                }
                                
                            }else{
                                echo '<script>alert("Wrong Password")</script>';
                            }
                        }
    
                    }else{
                        header("location: register.php");
                        echo '<script>alert("User Not registered")</script>';
                        
                    }
    
        }
    }    
    
    
    }
?>

<!-- registration area -->
<section id="login-form">
    <div class="row m-0">
        <div class="col-lg-8 offset-lg-2">
            <div class="text-center pb-5">
                <h1 class="login-title text-dark">Login</h1>
                <p class="p-1 m-0 font-ubuntu text-black-50">Login and enjoy additional features</p>
                <span class="font-ubuntu text-black-50">Create a new Account <a href="register.php">Sign Up</a></span>
            </div>
            
            <div class="d-flex justify-content-center">
                <form action="login.php" method="post" enctype="multipart/form-data" id="log-form">
                <input type="hidden" name="refurl" value="<?php echo base64_encode($_SERVER['HTTP_REFERER']); ?>" />
                    <div class="form-row my-4">
                        <div class="col">
                            <input type="email" required name="email" id="email" class="form-control" placeholder="Email*">
                        </div>
                    </div>

                    <div class="form-row my-4">
                        <div class="col">
                            <input type="password" required name="password" id="password" class="form-control" placeholder="password*">
                        </div>
                    </div>

                    <div class="submit-btn text-center my-5">
                        <button type="submit" class="btn btn-warning rounded-pill text-dark px-5">Login</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</section>
<!-- #registration area -->


<?php
// footer.php
include ('footer.php');
?>