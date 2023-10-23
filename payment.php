<?php
	include_once'inc/header.php';
	//include 'inc/slider.php';
?>
<!--  -->
<style>
	h3.payment{
		text-align: center;
		font-size: 20px;
		font-weight: bold;
		text-decoration: none;
		color: #000;
		padding-bottom:20px ;
	}
	.wrapper_method{
		text-align: center;
		width: 550px;
		margin: 0 auto;
		border: 1px solid #666;
		padding: 20px;
		background: cornsilk;
	}

	.wrapper_method a {
		padding: 5px;
		background: red;
		color: #fff;
		text-decoration: none;
	}

	.main .heading h3 {
		color: #DD0E0F;
		font-weight: bold	;
	}
</style>
 <div class="main">
    <div class="content">
    	<div class="section group">
    		<div class="content_top">
	    		<div class="heading">
	    		<h3>PAYMENT METHOD</h3>
    		</div>
    			<div class="clear"> </div>
    			<div class="wrapper_method">
    				<h3 class="payment"> CHOOSE YOUR METHOD PAYMENT </h3>
    				<a class="payment_href" href="offlinepayment.php"> Offline Payment</a>
    				<a class="payment_href" href="donhangthanhtoanonline.php"> Online Payment</a>
    				<a style="background: grey" href="cart.php"><< Previous</a>
    			 </div>
 		</div>
 	</div>
	</div>
	
   <?php
	include 'inc/footer.php';
?>
   