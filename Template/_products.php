<!--   product  -->
<?php
 if($_SERVER['REQUEST_METHOD'] == "POST"){
    $item_id=$_POST['item_id'];
    if (isset($_POST['product_submit'])){
        // call method addToCart
        $Cart->addProduct($_POST['item_id'],$_POST['qty']);
        header('location:cart.php');
    }
}

?>
<?php

$item_id=$_GET['item_id'];
foreach($product->getData() as $item):
if($item['item_id']==$item_id):
?>

<section id="product" class="py-3">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <img src="./assets/<?php echo $item['item_image'];?>" alt="product" class="img-fluid">
                    <div class="form-row pt-4 font-size-16 font-baloo">
                        <div class="col">
                        <form action="order.php" method="post">
                        <input type="hidden" name="item_id" value="<?php echo $item['item_id'];?>">
                        <input type="hidden" name="qty" value="1" id="proqty">
                        <input type="hidden" name="total_price" value="<?php echo $item['item_price'];?>">
                        <button type="submit" name="buy" class="btn btn-success form-control">Proceed to Buy</button>
                        </form>
                    </div>
                        <div class="col">
                            
                        <form method="post">
                    <input type="hidden" name="item_id" value="<?php echo $item['item_id'];?>">
                    <input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id'];?>">
                    <?php 
                     if(!isset($_SESSION['cart']) || !isset($_SESSION['cart'][$item['item_id']])){
                        echo '<button type="submit" name="product_submit" class="btn btn-warning form-control">Add to Cart</button>';
                    }else{
                        echo '<button type="submit" disabled class="btn btn-success form-control">In the Cart</button>';
                        
                    }
                    ?>
                  
                  
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 py-5">
                    <h5 class="font-baloo font-size-20"><?php echo $item['item_name'];?></h5>
                    <small>by HerbsBazaar</small>
                    <div class="d-flex">
                        <div class="rating text-warning font-size-12">
                            <span><i class="fas fa-star"></i></span>
                            <span><i class="fas fa-star"></i></span>
                            <span><i class="fas fa-star"></i></span>
                            <span><i class="fas fa-star"></i></span>
                            <span><i class="far fa-star"></i></span>
                          </div>
                          <a href="#" class="px-2 font-rale font-size-14">20,534 ratings | 1000+ answered questions</a>
                    </div>
                    <hr class="m-0">

                    <!---    product price       -->
                        <table class="my-3">
                            <tr class="font-rale font-size-14">
                                <td>M.R.P:</td>
                                <td><strike>₹600.00</strike></td>
                            </tr>
                            <tr class="font-rale font-size-14">
                                <td>Deal Price:</td>
                                <td class="font-size-20 text-danger">₹<span><?php echo $item['item_price'];?></span><small class="text-dark font-size-12">&nbsp;&nbsp;Inclusive of all taxes</small></td>
                            </tr>
                            <tr class="font-rale font-size-14">
                                <td>You Save:</td>
                                <td><span class="font-size-16 text-danger">₹1.00</span></td>
                            </tr>
                        </table>
                    <!---    !product price       -->

                     <!--    #policy -->
                        <div id="policy">
                            <div class="d-flex">
                                <div class="return text-center mr-5">
                                    <div class="font-size-20 my-2 color-second">
                                        <span class="fas fa-retweet border p-3 rounded-pill"></span>
                                    </div>
                                    <a href="#" class="font-rale font-size-12">No <br> Replacement</a>
                                </div>
                                <div class="return text-center mr-5">
                                    <div class="font-size-20 my-2 color-second">
                                        <span class="fas fa-truck  border p-3 rounded-pill"></span>
                                    </div>
                                    <a href="#" class="font-rale font-size-12">HerbsBazaar<br>Deliverd</a>
                                </div>
                                <div class="return text-center mr-5">
                                    <div class="font-size-20 my-2 color-second">
                                        <span class="fas fa-check-double border p-3 rounded-pill"></span>
                                    </div>
                                    <a href="#" class="font-rale font-size-12">Top <br>Quality</a>
                                </div>
                            </div>
                        </div>
                      <!--    !policy -->
                        <hr>

                    <!-- order-details -->
                        <div id="order-details" class="font-rale d-flex flex-column text-dark">
                            <small>Delivery by : June 29  - July 1</small>
                            <small>Sold by <a href="#">HerbsBazaar </a>(4.5 out of 5 | 18,198 ratings)</small>
                            <small><i class="fas fa-map-marker-alt color-primary"></i>&nbsp;&nbsp;Deliver to Customer - 457001</small>
                        </div>
                     <!-- !order-details -->

                     <div class="row">
                         <div class="col-6">
                                <!-- color 
                                    <div class="color my-3">
                                      <div class="d-flex justify-content-between">
                                        <h6 class="font-baloo">Color:</h6>
                                        <div class="p-2 color-yellow-bg rounded-circle"><button class="btn font-size-14"></button></div>
                                        <div class="p-2 color-primary-bg rounded-circle"><button class="btn font-size-14"></button></div>
                                        <div class="p-2 color-second-bg rounded-circle"><button class="btn font-size-14"></button></div>
                                      </div>
                                    </div>
                                 !color -->
                         </div>
                         <div class="col-6">
                           <!-- product qty section -->  
                             <div class="qty d-flex">
                                 <h6 class="font-baloo">Qty</h6>
                                 <div class="px-4 d-flex font-rale">
                                 <select name="qty" id="qty" class="form-control" onchange="myFunction()">
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                                <option value="9">9</option>
                                <option value="10">10</option>
                            </select>
                                 </div>
                             </div>
                            <!-- !product qty section -->  
                         </div>
                     </div>
                     </form>
                     <script>
                        function myFunction() {
                        var x = document.getElementById("qty").value;
                        document.getElementById("proqty").value=x;
                        }
                    </script>
                    <!-- size -->
                        <div class="size my-3">
                            <h6 class="font-baloo">Size :</h6>
                            <div class="d-flex justify-content-between w-75">
                                <div class="font-rubik border p-2">
                                    <button class="btn p-0 font-size-16">200ml</button>
                                </div>
                                <div class="font-rubik border p-2">
                                    <button class="btn p-0 font-size-16">500ml</button>
                                </div>
                                <div class="font-rubik border p-2">
                                    <button class="btn p-0 font-size-16">750ml</button>
                                </div>
                            </div>
                        </div>
                    <!-- !size -->


                </div>

                <div class="col-12">
                    <h6 class="font-rubik">Product Description</h6>
                    <hr>
                    <p class="font-rale font-size-14">HANDMADE AYURVEDIC OIL –Jhamaajham Hair Oil Is Handmade In India By 100% Pure Hand-Picked & Assorted Natural Raw Herbs (Jadibooti). It Contains Amla, Bhringraj, Methi, Jatamansi, Kalonji, Almond Oil, Coconut Oil, Tea Leaf, Baheda, Amarbel, Etc. It’s A Great Elasticity Supplement For Hair By Replenish And Hydrating It With Natural Vitamins. It Rejuvenates Weak, Thin, Or Damaged Hair And Dry Scalp</p>
                    <p class="font-rale font-size-14">STIMULATE HAIR GROWTH – Rich In Natural Herbs, Oils And Extracts That Work Together To Promote Hair Growth, Reduce Dandruff, Reduce Hair-Fall, Strengthen Hair Roots And Deliver An Overall Healthier Head Of Hair. Jhamaajham Hair Oil Is A Natural Solution For Hair Growth In A Quick, Natural Way While Also Reducing Hair Loss</p>
                    <p class="font-rale font-size-14">CONTROL PREMATURE GRAYING - Jhamaajham Organic Hair Oil Helps Hair Follicles Get All The Nourishment They Need To Grow Healthy Hair. Regular Use Of Oil Helps Restore The Natural Texture And Color Of Your Hair And Stops New Grey Hair From The Roots</p>
                    <p class="font-rale font-size-14">NATURAL FRAGRANCE - Jhamaajham Hair Oil Has A Pleasant Fragrance Of Natural Herbs. It Gets Easily Absorbed In The Hair Roots Improving The Blood Circulation At The Root Of The Hair Bringing More Nutrients To Support Hair Growth Protect From Damage Hair</p>
                    <p class="font-rale font-size-14">SUITABLE FOR ALL HAIR TYPES: This Oil Can Be Used On Any Type Of Hair, Be It Curly, Straight, Textured, Thick, Thin, Fine, Coarse, Colour Treated, Etc. It Can Also Be Used On Any Type Of Scalp. Regular Use Of Oil Helps Restore The Natural Texture Of Your Hair And Adds Luster, Volume And Color</p>
                </div>
            </div>
        </div>
    </section>
<!--   !product  -->
<?php
endif;
endforeach;
?>