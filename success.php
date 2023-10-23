<?php
	include_once'inc/header.php';
	//include 'inc/slider.php';
?>
<?php 
    if(isset($_GET['orderid']) && $_GET['orderid'] == 'order'){
    	$customer_id = Session::get('customer_id');
    	$insertOrder = $ct->insertOrder($customer_id);
    	$del_cart = $ct -> del_all_data_cart();
    	header('Location:success.php');
    }
   
?>
<style>
	h2.success_order{
		text-align: 	center;
		color: 	red;
	}
	p {
		text-align: center;
		padding: 8px;
		font-size: 17px;
	}
</style>

<form action="" method="post">
 <div class="main">
    <div class="content">
    	<div class="section group">
    		<h2 class="success_order">SUCCESS ORDER</h2>
    		<?php
    			$customer_id = Session::get('customer_id');
    			$get_amount = $ct ->getAmountPrice($customer_id);
    			if($get_amount){
    				$amount = 0;
    				while($result = $get_amount ->fetch_assoc()){
    					$price = $result['price'];
    					$amount +=$price;
    				}
    			}

    		?>
    		<p class="susscess_note">Total Price You Have Bought From My Website : <?php 
    		$vat = $amount * 0.1;
    		$total = $vat + $amount;
    		echo $fm->format_currency($total).' '.'VNĐ';
    		?></p>
    		<p class="susscess_note">We will contact as soon as possible. Please see your order details here <a href="orderdetails.php">click here</a></p>
		</div>
 </div>
</div>

	
</form>	
<?php
	include 'inc/footer.php';
?>
