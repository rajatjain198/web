<?php 
require('top.inc.php');
$categories_id='';
$name='';
$mrp='';
$price='';
$qty='';
$image='';
$short_desc='';
$description='';
$meta_title='';
$meta_keyword='';
$meta_desc='';

$msg='';
if(isset($_GET['id'])&&$_GET['id']!=''){
    $id=get_safe_value($con,$_GET['id']);
    $res=mysqli_query($con,"SELECT * FROM product where item_id='$id'");
    $row=mysqli_fetch_assoc($res);
    $categories_id=$row['categories_id'];
    $name=$row['item_name'];
    $mrp=$row['item_mrp'];
    $price=$row['item_price'];
    $qty=$row['qty'];
    $short_desc=$row['short_desc'];
    $description=$row['description'];
    $meta_title=$row['meta_title'];
    $meta_keyword=$row['meta_keyword'];
    $meta_desc=$row['meta_desc'];
    
}
if(isset($_POST['submit'])){    
    $categories_id=get_safe_value($con,$_POST['categories_id']);
    $name=get_safe_value($con,$_POST['name']);
    $mrp=get_safe_value($con,$_POST['mrp']);
    $price=get_safe_value($con,$_POST['price']);
    $qty=get_safe_value($con,$_POST['qty']);
   // $image=$_POST['image'];
    $short_desc=get_safe_value($con,$_POST['short_desc']);
    $description=get_safe_value($con,$_POST['description']);
    $meta_title=get_safe_value($con,$_POST['meta_title']);
    $meta_keyword=get_safe_value($con,$_POST['meta_keyword']);
    $meta_desc=get_safe_value($con,$_POST['meta_desc']);

    $res=mysqli_query($con,"SELECT * FROM product where item_name='$name'");
    $check=mysqli_num_rows($res);
    if($check>0){
        $msg="Product Already Exist";
    }
    if($msg==''){
    if(isset($_GET['item_id'])&&$_GET['item_id']!=''){
        mysqli_query($con,"UPDATE product set categories_id='$categories_id',item_name='$name',item_mrp='$mrp',item_price='$price',qty='$qty',short_desc='$short_desc',description='$description',meta_title='$meta_title',meta_desc='$meta_desc',meta_keyword='$meta_keyword' WHERE item_id='$id'");
    }else{
        $image=rand(111111111,999999999).'_'.$_FILES['image']['name'];
        move_uploaded_file($_FILES['image']['tmp_name'],'../assets/'.$image);
        mysqli_query($con,"INSERT INTO product(categories_id,item_name,item_mrp,item_price,qty,short_desc,description,meta_title,meta_desc,meta_keyword,status,item_image) values('$categories_id','$name','$mrp','$price','$qty','$short_desc','$description','$meta_title','$meta_desc','$meta_keyword','1','$image')");
    }
        header('location:product.php');
    die();
}
}
?>
  <div class="content pb-0">
            <div class="animated fadeIn">
               <div class="row">
                  <div class="col-lg-12">
                     <div class="card">
                        <div class="card-header"><strong>Product</strong></div>
                        <form method="post" enctype="multipart/form-data">
                        <div class="card-body card-block">
                           <div class="form-group"><label for="categories" class=" form-control-label">Name</label>
                        <select class="form-control" name="categories_id">
                            <option>Select Category</option>
                            <?php
                            $res=mysqli_query($con,"SELECT id,categories from categories order by categories desc");
                            while($row=mysqli_fetch_assoc($res)){
                                echo "<option value=".$row['id'].">".$row['categories']."</option>";
                            }
                            ?>
                        </select>
                        <div class="form-group"><label for="product_name" class=" form-control-label">Product Name</label><input type="text" name="product_name" placeholder="Enter Product Name" class="form-control" value="<?php echo $name?>" required></div>
                        <div class="form-group"><label for="product_mrp" class=" form-control-label">MRP</label><input type="text" name="mrp" placeholder="Enter Product MRP" class="form-control" value="<?php echo $mrp?>" required></div>                        
                        <div class="form-group"><label for="price" class=" form-control-label">Selling Price</label><input type="text" name="price" placeholder="Enter Selling Price" class="form-control" value="<?php echo $price?>" required></div>
                        <div class="form-group"><label for="qty" class=" form-control-label">Enter Quantity</label><input type="text" name="qty" placeholder="Enter Quantity" class="form-control" value="<?php echo $qty?>" required></div>    
                        <div class="form-group"><label for="image" class=" form-control-label">Image (Only .jpg,.png,.jpeg Formats)</label><input type="file" name="image" placeholder="Enter Image Path" class="form-control"  required ></div>
                        <div class="form-group"><label for="short_desc" class=" form-control-label">Short Description</label><textarea name="short_desc" placeholder="Enter Short Description" class="form-control"  required><?php echo $short_desc?></textarea></div>
                        <div class="form-group"><label for="desc" class=" form-control-label">Description</label><textarea name="description" placeholder="Enter Long Description" class="form-control"><?php echo $description?></textarea></div>
                        <div class="form-group"><label for="meta_title" class=" form-control-label">Meta Title</label><input type="text" name="meta_title" placeholder="Enter Meta Title" class="form-control" value="<?php echo $meta_title?>" ></div>
                        <div class="form-group"><label for="meta_desc" class=" form-control-label">Meta Description</label><textarea name="meta_desc" placeholder="Enter Meta Description" class="form-control" ><?php echo $meta_desc?></textarea></div>
                        <div class="form-group"><label for="meta_keyword" class=" form-control-label">Meta Keyword</label><input type="text" name="meta_keyword" placeholder="Enter Meta Keyword" class="form-control" value="<?php echo $meta_keyword?>" ></div>
                    </div>
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