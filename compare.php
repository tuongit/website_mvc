<?php
	include_once 'inc/header.php';
	//include 'inc/slider.php';
?>
<?php
	$login_check = Session::get('customer_login');
   if($login_check== false){
   	echo "<script>window.location='login.php'</script>";

   }
?>
<style>
	.cartpage h1 {
		color: #dd0e0f;
		font-weight: bold;
	}
	.main h2{
		color: #000;
		font-weight: bold;

	}
	.main .heading-title{
		text-align: center;
		color: red;
		font-size: 32px;
		font-weight: bold;
		font-family: font-family: 'Monda', sans-serif;
	}
	.cartpage .tblone th{
		background: #000;
	}
	
	.cartpage table.tblone img{
		width: 50px;
		height: 50px;
	}
</style>
 <div class="main">
    <div class="content">
    	<div class="cartoption">		
			<div class="cartpage">
			    	<h1>COMPARE PRODUCT</h1>
			    	<?php
			    	if(isset($update_quantity_cart)){
			    		echo $update_quantity_cart;
			    	}
			    	?>
			    	<?php
			    	if(isset($del_pro_cart)){
			    		echo $del_pro_cart;
			    	}
			    	?>
						<table class="tblone">
							<tr>
								<th width="15%">ID Compare</th>
								<th width="20%">Product Name</th>
								<th width="35%">Image</th>
								<th width="15%">Price</th>
								<th width="15%">Action</th>
								
							</tr>
							<?php
							$customer_id = Session::get('customer_id');
							$get_compare = $product->get_compare($customer_id);
							if($get_compare){
								$i=0;
								while($result = $get_compare->fetch_assoc())
								{
									$i++;
							?>
							<tr>
								<td> <?php echo $i;?></td>
								<td> <?php echo $result['productName']?></td>
								<td><img src="admin/uploads/<?php echo $result['image']?>" alt=""/></td>
								<td> <?php echo $fm->format_currency($result['price'])." "."VNĐ"?></td>
								
								<td><a href="details.php?proid=<?php echo $result['productId']?>">View</a></td>
							</tr>
							<?php
								
								}	
							}
							?>
						</table>
					 
					
					</div>
					<div class="shopping">
						<div>
							<center><a href="index.php"> <img src="images/shop.png" alt="" /></a></center>
						</div>
						
					</div>
    	</div>  	
       <div class="clear"></div>
    </div>
 </div>
</div>
<?php
	include 'inc/footer.php';
?>
   