<?php
    // header.php
    include ('header.php');
    include('./mysqli_connect.php');
?>
 <?php
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
          $str=mysqli_real_escape_string($con,$_POST['search_str']);
          $sql="SELECT * FROM product WHERE status=1 AND item_name LIKE '%$str%'"; 
          $res=mysqli_query($con,$sql);  
          if (isset($_POST['search_submit'])){
            // call method addToCart
            $Cart->addProduct($_POST['item_id'],1);
            header('location: ' .$_SERVER['PHP_SELF']);
        }
        }else{
            header('location:index.php');
        }
        
    ?>
<section id="cart" class="py-3 mb-5">
    <div class="container-fluid w-75">
        <h5 class="font-baloo font-size-20">Search Result for "<?php echo $str?>"</h5>
        <!--  Order items   -->
        <div class="row">
            <div class="col-sm-9">
                <?php 
                   while($item=mysqli_fetch_assoc($res)) {
                      
                           
                        
                ?>
                <!-- Order item -->
                <div class="row border-top py-3 mt-3">
                    <div class="col-sm-2">
                    <a href="<?php printf('%s?item_id=%s','product.php',$item['item_id']);?>"> <img src="./assets/<?php echo $item['item_image'] ?? "./assets/products/1.png" ?>" style="height: 120px;" alt="cart1" class="img-fluid"></a>
                    </div>
                    <div class="col-sm-8">
                        <h5 class="font-baloo font-size-20"><?php echo $item['item_name'] ?? "Unknown"; ?></h5>
                        <small>by <?php echo $item['item_brand'] ?? "Brand"; ?></small>
                        <!-- product rating -->
                        <div class="d-flex">
                            <div class="rating text-warning font-size-12">
                                <span><i class="fas fa-star"></i></span>
                                <span><i class="fas fa-star"></i></span>
                                <span><i class="fas fa-star"></i></span>
                                <span><i class="fas fa-star"></i></span>
                                <span><i class="far fa-star"></i></span>
                            </div>
                            <a href="#" class="px-2 font-rale font-size-14">20,534 ratings</a>
                        </div>
                        <form method="post">
                    <input type="hidden" name="item_id" value="<?php echo $item['item_id'];?>">
                    <input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id'];?>">
                    <input type="hidden" name="search_str" value="<?php echo $str?>">
                    <?php 
                    if(!isset($_SESSION['cart']) || !isset($_SESSION['cart'][$item['item_id']])){
                      echo '<button type="submit" name="search_submit" class="btn btn-warning font-size-12">Add to Cart</button>';
                    }else{  
                        echo '<button type="submit" disabled class="btn btn-success font-size-12">In the Cart</button>';
                  }
                    ?>
                  
                  </form>
                        <!--  !product rating-->
                    </div>

                    <div class="col-sm-2 text-right">
                        <div class="font-size-20 text-danger font-baloo">
                            ₹<span class="product_price" data-id="<?php echo $item['item_id'] ?? '0'; ?>"><?php echo $item['item_price'] ?? 0; ?></span>
                        </div>
                    </div>
                </div>
                <!-- !cart item -->
                <?php
                    
                         // closing array_map function
                   }
                ?>
            </div>
            
        </div>
        <!--  !Order items   -->
    </div>
</section>
<!-- !Order section  -->







<?php
    // footer.php
    include ('footer.php');
?>