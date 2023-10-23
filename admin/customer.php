<?php 
	include 'inc/header.php';
	include 'inc/sidebar.php';
	include_once '../classes/customer.php';
	include_once '../classes/cart.php';
	include_once '../lib/session.php';
	include_once '../helpers/format.php'
?>
<?php 
		$ct = new cart();
		$fm = new Format();
		$cs = new customer(); 
?>
<?php
	if (!isset($_GET['customerid']) || $_GET['customerid'] == NULL) {
		echo "<script>window.location='inbox.php'</script>";
	}else {

 		$id = $_GET['customerid'];
 		$order_code = $_GET['order_code'];
	}
?>
<div class="grid_10">
   <div class="box round first grid">
    	<h2> THÔNG TIN KHÁCH HÀNG</h2>
    	<table class="data display datatable" id="example">
			 <thead>
				<tr>
					<th>Chi Tiết</th>
					<th>Thông Tin Khách Hàng</th>
					
				</tr>
			 </thead>
			 <tbody>
			 	<?php

 				$get_customers = $cs ->show_all_customers($id);
 				if($get_customers)
 				{
 					while($result = $get_customers ->fetch_assoc())
 					{


 				?>
					<tr>
	 					<td>Name</td>
	 					<td><?php echo $result['name'] ?></td>
	 				</tr>
	 				<tr>
 						<td>City</td>
 						<td><?php echo $result['city'] ?></td>
 					</tr>

	 				<tr>
	 					<td>Phone</td>
	 					<td><?php echo $result['phone'] ?></td>
	 				</tr>
	 				<tr>
	 					<td>Zipcode</td>
	 					<td><?php echo $result['zipcode'] ?></td>
	 				</tr>
	 				<tr>
	 					<td>Email</td>
	 					<td><?php echo $result['email'] ?></td>
	 				</tr>
	 				<tr>
	 					<td>Address</td>
	 					<td><?php echo $result['address'] ?></td>
	 				</tr>
	 					<?php
 					}
 				}
 				?>
			 </tbody>
		 </table>
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
		        <td><img src="uploads/<?php echo $result_order['image']?>" alt="" width="40px" height="45px"/></a></td>
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

<script type="text/javascript">
	$(document).ready(function () {
	    setupLeftMenu();

	    $('.datatable').dataTable();
	    setSidebarHeight();
	});
</script>
<?php include 'inc/footer.php';?>

