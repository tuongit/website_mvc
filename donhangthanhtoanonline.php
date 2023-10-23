<?php
	include_once 'inc/header.php';
	//include 'inc/slider.php';
?>

<?php
	if(isset($_GET['cartid'])){
		$cartid = $_GET['cartid'];
		$del_pro_cart = $ct->del_product_cart($cartid);
	}

  if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit']))
  {
   	$cartId = $_POST['cartId'];
   	$quantity = $_POST['quantities'];
   	$update_quantity_cart = $ct->update_quantity_cart( $quantity, $cartId);
   	if($quantity <= 0){
   		$del_pro_cart = $ct->del_product_cart($cartId);
   	}
  }
?>
<style>
	
	.shopping .shopleft{
		float: left;
		margin-top: 20px;
	}
	.shopping .shopright{
		float: right;
		margin-top: 20px;
		margin-right: 50px;
	}
	

</style>
 <div class="main">
    <div class="content">
    	<div class="cartoption">		
			<div class="cartpage">
			    	<h2>Your Cart</h2>
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
								<th width="20%">Tên sản phẩm</th>
								<th width="10%">Hình ảnh</th>
								<th width="15%">Đơn giá</th>
								<th width="25%">Số lượng</th>
								<th width="20%">Tổng tiền</th>
								<th width="10%">Action</th>
							</tr>
							<?php
							$get_product_cart = $ct->get_product_cart();
							if($get_product_cart){
								$subtotal = 0;
								$qty= 0;
								while($result = $get_product_cart->fetch_assoc())
								{
							?>
							<tr>
								<td> <?php echo $result['productName']?></td>
								<td><img src="admin/uploads/<?php echo $result['image']?>" alt=""/></td>
								<td> <?php echo $fm->format_currency($result['price'])." "."VNĐ"?></td>
								<td>
									<form action="" method="post">
										<input type="hidden" name="cartId" value="<?php echo $result['cartId']?>"/>
										<input type="number" name="quantities"  value="<?php echo $result['quantity']?>" min="0"/>
										<input type="submit" name="submit" value="Update"/>
									</form>
								</td>
								<td><?php
									$total = $result['price'] * $result['quantity'];
									echo $fm->format_currency($total)." "."VNĐ";
								?></td>
								<td><a href="?cartid=<?php echo $result['cartId']?>">Xóa</a></td>
							</tr>
							<?php
								$subtotal += $total;
								$qty =$qty + $result['quantity'];
								$vat = $subtotal * 0.1;
								$grandtotal = $subtotal + $vat;
								}	
							}
							?>
							
							<?php
								if($check_cart){

							?>

							
						</table>
						<table style="float:right;text-align:left;" width="40%">
							<tr>
								<th>Tổng tiền : </th>
								<td><?php 

										echo $fm->format_currency($subtotal)." "."VNĐ";
										Session::set('sum',$subtotal); 
										Session::set('qty', $qty);
										?></td>
							</tr>
							<tr>
								<th>Thuế VAT : </th>
								<td>10%</td>
							</tr>
							<tr>
								<th>Tổng tiền phải thanh toán:</th>
								 <td><?php echo $fm->format_currency($grandtotal)." "."VNĐ";?> </td> 
							</tr>
					   </table>
					   <div class="shopping">
							<div class="shopleft">
							
								<form action="index.php" method="">
									<button class="btn btn-danger">Mua Tiếp</button>
								</form>

							</div>
							<div class="shopright">
								<form action="congthanhtoan_mommo.php" method="POST">
									<input type="hidden" name="total_congthanhtoan" value="<?php echo $grandtotal ?>">
									<button class="btn btn-success" name="captureWallet">Thanh Toán QR Momo</button>
								</form>
								<p></p>
								<form action="congthanhtoan_atmmomo.php" method="POST">
									<input type="hidden" name="total_congthanhtoan" value="<?php echo $grandtotal ?>">
									<button class="btn btn-success" name="paywithATM">Thanh Toán ATM Momo</button>
								</form>
							</div>
							
						</div>
					   <?php
							}else{
								echo 'Your Cart is Empty!';
							}
					   ?>
					
					</div>

    	</div>  	
       <div class="clear"></div>
    </div>
 </div>
</div>
<?php
	include 'inc/footer.php';
?>
   