<!-- Shopping cart section  -->

<?php
    
    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        if (isset($_POST['delete-cart-submit'])){
            $deletedrecord = $Cart->removeProduct($_POST['item_id']);
            header('location: ' .$_SERVER['PHP_SELF']);
        }
       // if (isset($_POST['proceed'])){
         //   header('location: cart_order.php');
            
        //}
        // save for later
        if (isset($_POST['qty-update'])){
            $val=$_POST['qty'];
            $Cart->updateProduct($_POST['item_id'],$_POST['qty']); 
        }
        if (isset($_POST['wishlist-submit'])){
            $deletedrecord = $Cart->removeProduct($_POST['item_id']);
            $Cart->addToCart($_SESSION['user_id'],$_POST['item_id'] );
        }
    }
?>

<section id="cart" class="py-3 mb-5">
    <div class="container-fluid w-75">
        <h5 class="font-baloo font-size-20">Shopping Cart</h5>

        <!--  shopping cart items   -->
        <div class="row">
            <div class="col-sm-9">
                <?php 
                    foreach ($_SESSION['cart'] as $item=>$val) :
                       
                     $cart = $product->getProduct($item);
                        $subTotal[] = array_map(function ($item){
                             
                ?>
                <!-- cart item -->
                <div class="row border-top py-3 mt-3">
                    <div class="col-sm-2">
                    <a href="<?php printf('%s?item_id=%s','product.php',$item['item_id']);?>">  <img src="./assets/<?php echo $item['item_image'] ?? "./assets/products/1.png" ?>" style="height: 120px;" alt="cart1" class="img-fluid"></a>
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
                        <!--  !product rating-->

                        <!-- product qty -->
                        <div class="qty d-flex pt-2">
                            <div class="d-flex font-rale w-25">
                            <form method="post">
                            <select name="qty" id="qty" class="form-control">
                                <option <?php echo ($_SESSION['cart'][$item['item_id']]['qty'] == "1")?'selected':"" ?> value="1">1</option>
                                <option <?php echo ($_SESSION['cart'][$item['item_id']]['qty'] == '2')?"selected":"" ?> value="2">2</option>
                                <option <?php echo ($_SESSION['cart'][$item['item_id']]['qty'] == '3')?"selected":"" ?> value="3">3</option>
                                <option <?php echo ($_SESSION['cart'][$item['item_id']]['qty'] == '4')?"selected":"" ?> value="4">4</option>
                                <option <?php echo ($_SESSION['cart'][$item['item_id']]['qty'] == '5')?"selected":"" ?> value="5">5</option>
                                <option <?php echo ($_SESSION['cart'][$item['item_id']]['qty'] == '6')?"selected":"" ?> value="6">6</option>
                                <option <?php echo ($_SESSION['cart'][$item['item_id']]['qty'] == '7')?"selected":"" ?> value="7">7</option>
                                <option <?php echo ($_SESSION['cart'][$item['item_id']]['qty'] == '8')?"selected":"" ?> value="8">8</option>
                                <option <?php echo ($_SESSION['cart'][$item['item_id']]['qty'] == '9')?"selected":"" ?> value="9">9</option>
                                <option <?php echo ($_SESSION['cart'][$item['item_id']]['qty'] == '10')?"selected":"" ?> value="10">10</option>
                            </select>
                                <input type="hidden" value="<?php echo $item['item_id'] ?? 0; ?>" name="item_id">
                                <button type="submit" name="qty-update" class="btn font-baloo text-success">Update</button>
                            </form>    
                        </div>

                            <form method="post">
                                <input type="hidden" value="<?php echo $item['item_id'] ?? 0; ?>" name="item_id">
                                <button type="submit" name="delete-cart-submit" class="btn font-baloo text-danger mr-3 border-right">Delete</button>
                            </form>
                            <form method="post">
                                <input type="hidden" value="<?php echo $item['item_id'] ?? 0; ?>" name="item_id">
                                <?php if(!isset($_SESSION['loggedin'])||$_SESSION['loggedin']==''){
                                }else{
                                    echo '<button type="submit" name="wishlist-submit" class="btn font-baloo text-dark">Save for Later</button>';
                                }?>
                            </form>
                           


                        </div>
                        <!-- !product qty -->

                    </div>

                    <div class="col-sm-2 text-right">
                        <div class="font-size-20 text-danger font-baloo">
                            ₹<span class="product_price" data-id="<?php echo $item['item_id'] ?? '0'; ?>"><?php echo $item['item_price'] ?? 0; ?></span>
                        </div>
                    </div>
                </div>
                <!-- !cart item -->
                <?php
                            return $item['item_price']*$_SESSION['cart'][$item['item_id']]['qty'];
                        }, $cart); // closing array_map function
                    endforeach;
                ?>
            </div>
            <!-- subtotal section-->
            <div class="col-sm-3">
                <div class="sub-total border text-center mt-2">
                    <h6 class="font-size-12 font-rale text-success py-3"><i class="fas fa-check"></i> Your order is eligible for FREE Delivery.</h6>
                    <div class="border-top py-4">
                      
                    <h5 class="font-baloo font-size-20">Subtotal ( <?php echo isset($subTotal) ? count($subTotal) : 0; ?> Product):&nbsp; <span class="text-danger">₹<span class="text-danger" id="deal-price"><?php echo isset($subTotal) ? $Cart->getSum($subTotal) : 0; ?></span> </span> </h5>
                    <form method="post" action="cart_order.php">
                    <input type="hidden" value="<?php echo isset($subTotal) ? $Cart->getSum($subTotal) : 0; ?>" name="total_price">
                    <button type="submit" name="proceed" class="btn btn-warning mt-3">Proceed to Buy</button>
                      </form>
                    </div>
                </div>
            </div>
            <!-- !subtotal section-->
        </div>
        <!--  !shopping cart items   -->
    </div>
</section>
<!-- !Shopping cart section  -->