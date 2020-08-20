<?php
        ob_start();
     include('header.php') ;
     ?>
     
     <?php
    /*Banner Area*/
    include('./Template/_banner-area.php');

    /*Top Sale*/
    include('./Template/_top-sale.php');

    /*Special Price*/
    include('./Template/_special-price.php');

    /*Banner Ads*/
    include('./Template/_banner-ads.php');

    /*New Launch*/
    include('./Template/_new-launch.php');

    /*Latest Blog*/
    include('./Template/_blogs.php');
?>

<?php
include('footer.php');
?>