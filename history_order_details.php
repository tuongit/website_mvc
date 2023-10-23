<?php
	include_once'inc/header.php';
	//include 'inc/slider.php';
	include_once 'helpers/format.php';
?>
<!--  -->
<?php 
	$login_check = Session::get('customer_id');
	if ($login_check==false) {
			echo "<script>window.location= 'login.php' </script>";
	}
?>
<style>
	.main .heading h3 {
    font-family: 'Monda', sans-serif;
    font-size: 36px;
    color: #CC3636;
    font-weight: bold;
    text-transform: uppercase;
    padding-bottom: 10px;
</style>
 <div class="main">
    <div class="content">
    	<div class="section group">
    		<div class="content_top">
	    		<div class="heading">
	    		<h3>Chi Tiết Lịch Sử Đơn Hàng</h3>
    		</div>
    			<div class="clear"> </div>
    			<div class="wrapper_method">
    				 <table class="table table-hover">
					    <thead>
					      <tr>
					        <th>Tên Sản Phẩm</th>
					        <th>Hình Ảnh</th>
					        <th>Giá Sản Phẩm</th>
					        <th>Số Lượng</th>
					        <th>Thành Tiền</th>
					      </tr>
					    </thead>
					    <tbody>
					    	<?php 
					    		$order_code = $_GET['order_code'];
					    		$get_order = $cs ->show_order($order_code);
					    		if($get_order){
					    			$subtotal = 0;
					    			$total = 0;
					    			while($result_order = $get_order ->fetch_assoc()){
					    				$subtotal = $result_order['quantity'] * $result_order['price'];
					    				$total += $subtotal;
					    	?>
					      <tr>
					        <td><?php echo $result_order['productName']?></td>
					        <td><img src="admin/uploads/<?php echo $result_order['image']?>" alt="" width="40px" height="45px"/></a></td>
					        <td><?php echo $fm->format_currency($result_order['price'])." "."VND"?></td>
					        <td><?php echo $result_order['quantity']?></td>
					        <td><?php echo $fm->format_currency($subtotal)." "."VND"?></td>
					      </tr>
					     <?php
					     	}
					    		}
					     ?>
					     <tr>
					     	<td colspan="5"><b>Thành tiền: </b><?php echo $fm->format_currency($total)." "."VND"?></td>
					     </tr>
					    </tbody>
	     			</table>
    			 </div>
 		</div>
 	</div>
	</div>
	
   <?php
	include 'inc/footer.php';
?>
   