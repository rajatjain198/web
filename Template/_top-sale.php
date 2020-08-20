<?php

    shuffle($product_shuffle);

    // request method post
    if($_SERVER['REQUEST_METHOD'] == "POST"){
        if (isset($_POST['top_sale_submit'])){
            // call method addToCart
            $Cart->addProduct($_POST['item_id'],1);
            header('location: ' .$_SERVER['PHP_SELF']);
        }
        if(isset($_POST['wish_delete'])){
          $deletedrecord = $Cart->deleteCart($_POST['item_id'],$_SESSION['user_id'],'wishlist');
        }
        if(isset($_POST['wish_submit'])){
          $Cart->addToCart($_SESSION['user_id'],$_POST['item_id'] );
        }
    }
?>

<section id="top-sale">
        <div class=" container py-5">
          <h4 class="font-rubik font-size-20">Top Sales</h4>
          <hr>
          <!--Owl-->
          <div class="owl-carousel owl-theme">
            <?php foreach($product_shuffle as $item){ ?>
            <div class="item py-2">
              <div class="product font-rale">
                <a href="<?php printf('%s?item_id=%s','product.php',$item['item_id']);?>"><img src="./assets/<?php echo $item['item_image'];?>" alt="product1"class="img-fluid"></a>
                <div class="text-center">
                  <h6><?php echo $item['item_name'];?></h6>
                  <div class=" rating text-warning font-size-12">
                    <span><i class="fas fa-star"></i></span>
                    <span><i class="fas fa-star"></i></span>
                    <span><i class="fas fa-star"></i></span>
                    <span><i class="fas fa-star"></i></span>
                    <span><i class="far fa-star"></i></span>
                  </div>
                  <div class="price py-2">
                    
                  <span>₹<?php echo $item['item_price'];?></span>
                    
                  </div>
                  <form method="post">
                    <?php
                          if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']==''){
                          }else{
                            if (in_array($item['item_id'], $Cart->getCartId($product->getCart($_SESSION['user_id'],'wishlist')) ?? [])){
                              echo '<button type="submit" name="wish_delete" class="btn  text-danger bg-white py-0 px-0 mx-0 my-0"><i class="fas fa-heart"></i></button>';
                            }else{
                              echo '<button type="submit" name="wish_submit" class="btn bg-white py-0 px-0 mx-0 my-0"><i class="far fa-heart"></i></button>';  
                            }
                          }
                            ?>
                  <input type="hidden" name="item_id" value="<?php echo $item['item_id'];?>">  
                </form>
                  
                  <form method="post">
                    <input type="hidden" name="item_id" value="<?php echo $item['item_id'];?>">
                    <input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id'];?>">
                    <?php 
                    if(!isset($_SESSION['cart']) || !isset($_SESSION['cart'][$item['item_id']])){
                      echo '<button type="submit" name="top_sale_submit" class="btn btn-warning font-size-12">Add to Cart</button>';
                    }else{
                      
                        echo '<button type="submit" disabled class="btn btn-success font-size-12">In the Cart</button>';
                    
                  }
                    ?>
                  
                  </form>
                  
                </div>  
              </div>
            </div>
            <?php }?>
          </div>
          <!--!Owl-->
        </div>
      </section>
      <!--!Top Sale-->