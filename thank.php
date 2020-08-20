<?php
ob_start();
// include header.php file
include ('./header.php');
?>



<section id="cart" class="py-3 mb-5">
    <div class="container-fluid w-75">
        <h5 class="font-baloo font-size-20">Order has been Placed Successfully!</h5>
        
    <hr>
    <a href="my_order.php" class="py-2 bg-secondary rounded"><span class="font-size-16 px-2 text-white mx-8">Check Your Orders</span></a>
    <a href="cart.php" class="py-2 bg-secondary rounded"><span class="font-size-16 px-2 text-white mx-8">Go to Cart</span></a>
    <a href="index.php" class="py-2 bg-secondary rounded"><span class="font-size-16 px-2 text-white mx-8">Continue Shopping</span></a>
        </div>
        <!--  !shopping cart items   -->
    </>
</section>

        <?php
/*  include top sale section */
        include ('./Template/_top-sale.php');
  ?>
<?php
// include footer.php file
include ('./footer.php');
?>