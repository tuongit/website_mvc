
<?php
	include_once'inc/header.php';
	//include 'inc/slider.php';
?>
<?php 
	$login_check = Session::get('customer_login');
   if($login_check== false){
   	header('Location:login.php');

   }
	$ct = new cart();
	if(isset($_GET['confirmid'])){
		$id = $_GET['confirmid'];
	
		$shifted_confirm = $ct ->shifted_confirm($id);
	}

?>
<style >
	.main h2{
		color: #000;
		font-weight: bold;

	}
	.main .heading-title{
		text-align: center;
	 	color: #dd0e0f;
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
    	<div class="section group">
    		<p class="heading-title">YOUR ORDER DETAILS</p>
		<div class="clear">
			
		</div>
	
			<div class="cartpage">
			    	<h2>Your Cart</h2>
						<table class="tblone">
							<tr>
								<th width="5%">ID</th>
								<th width="15%">Product Name</th>
								<th width="20%">Image</th>
								<th width="15%">Price</th>
								<th width="10%">Quantity</th>
								<th width="15%">Date</th>
								<th width="10%">Status</th>
								<th width="10%">Action</th>
								
							</tr>
							<?php 
								$customer_id = Session::get('customer_id');
								$get_cart_ordered =  $ct -> get_cart_ordered($customer_id);
								if($get_cart_ordered){
									$qty = 0;
									$i=0;
									while($result = $get_cart_ordered->fetch_assoc()){
										$i++;
							?>
							<tr>
								<td><?php echo $i?></td>
								<td><?php echo $result['productName']?></td>
								<td><img src="admin/uploads/<?php echo $result['image']?>" alt="" width="50px" height="50px" /></td>
								<td><?php echo $fm->format_currency($result['price']." "."VNĐ")?></td>
								<td><?php echo $result['quantity']?></td>
								<td><?php echo $fm->formatDate($result['date_ordere'])?></td>
								<td><?php if($result['status'] == '0'){
												echo 'Pending';?>
											<?php
											}else if($result['status'] == '1'){
											?>
												<a href="?confirmid=<?php echo $customer_id?>">Shifted</a>
												<?php
											}else if($result['status'] == '2'){
												echo 'Received';
											}
											
								?>
							</td>
								<?php
									if($result['status'] == '0'){
								?>
										<td><?php echo 'N/A';?></td>
								<?php
									}else if($result['status'] == '1'){
								?>
									<td><a href="?confirmid=<?php echo $customer_id?>">Confirm</a></td>
								<?php 
									}else if($result['status'] == '2'){
								?>
									<td><?php echo 'Received';?></td>
								<?php 
									} 
								?>
							</tr>
							<?php
								} 
							} 
							?>
							</div>
						</table>
	
	<div class="shopping">
		<div class="shopleft">
			<a href="index.php"> <img src="images/shop.png" alt="" /></a>
		</div>
		
	</div>
					
</div>

