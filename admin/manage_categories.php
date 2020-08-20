<?php 
require('top.inc.php');
$categories='';
$msg='';
if(isset($_GET['id'])&&$_GET['id']!=''){
    $id=get_safe_value($con,$_GET['id']);
    $res=mysqli_query($con,"SELECT * FROM categories where id='$id'");
    $row=mysqli_fetch_assoc($res);
    $categories=$row['categories'];

}
if(isset($_POST['submit'])){    
    $categories=get_safe_value($con,$_POST['categories']);
    $res=mysqli_query($con,"SELECT * FROM categories where categories='$categories'");
    $check=mysqli_num_rows($res);
    if($check>0){
        $msg="Category Already Exist";
    }
    if($msg==''){
    if(isset($_GET['id'])&&$_GET['id']!=''){
        mysqli_query($con,"UPDATE categories set categories='$categories' WHERE id='$id'");
    }else{
        mysqli_query($con,"INSERT INTO categories(categories,status) values('$categories','1')");
    }
        header('location:categories.php');
    die();
}
}
?>
  <div class="content pb-0">
            <div class="animated fadeIn">
               <div class="row">
                  <div class="col-lg-12">
                     <div class="card">
                        <div class="card-header"><strong>Categories</strong></div>
                        <form method="post">
                        <div class="card-body card-block">
                           <div class="form-group"><label for="categories" class=" form-control-label">Name</label><input type="text" name="categories" placeholder="Enter category name" class="form-control" value="<?php echo $categories?>" required></div>
                           <button id="payment-button" type="submit" name="submit" class="btn btn-lg btn-info btn-block">
                           <span id="payment-button-amount">Submit</span>
                           </button>
                           <div class="field_error"><?php echo $msg; ?></div>
                        </div>
                        </form> 
                     </div>
                  </div>
               </div>
            </div>
         </div>
       
         <?php 
         require('footer.inc.php');
         ?>