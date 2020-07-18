<?php
ob_start();
// include header.php file
include('header.php');
?>

<?php

// include cart items if not empty
count($product->getData('cart')) ? include('Template/_cart.php') : include('Template/NotFound/_cart_notFound.php');

// include _wishlist.php
include('Template/_wishlist.php');

// include _new-phones.php
include('Template/_new-phones.php');

?>

<?php
// include footer.php file
include('footer.php');
?>
