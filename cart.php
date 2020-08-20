<?php
ob_start();
// include header.php file
include ('./header.php');
?>

<?php
        
    /*  include cart items if it is not empty */
        //count($product->getData('cart')) ? include ('./Template/_cart-template.php') :  include ('./Template/notFound/_cart_notFound.php');
    /*  include cart items if it is not empty */
    
   if(!isset($_SESSION['cart'])|| $Cart->totalProduct()==0){
    include ('./Template/notFound/_cart_notFound.php');
   }else{
       
    include ('./Template/_cart-template2.php');
   }
   if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !==true){
        /*  include top sale section */
     }else{
           count($product->getCart($_SESSION['user_id'],'wishlist')) ? include ('./Template/_wishlist_template.php') :  include ('./Template/notFound/_wishlist_notFound.php');
        /*  include top sale section */
        }

    /*  include top sale section */
        include ('./Template/_new-launch.php');
    /*  include top sale section */

?>

<?php
// include footer.php file
include ('./footer.php');
?>


