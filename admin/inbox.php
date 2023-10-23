<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../helpers/format.php'?>

<?php 
	$filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/../classes/cart.php');
?>
<?php
	$ct = new cart();
	if(isset($_GET['shiftid'])){
		$id = $_GET['shiftid'];
		$shifted = $ct ->shifted($id);
		if($shifted){
			echo "<script>window.location='inbox.php'</script>";
		}
	}
	if(isset($_GET['delid'])){
		$id = $_GET['delid'];
		$del_shifted = $ct ->del_shifted($id);
		if($del_shifted){
			echo "<script>window.location='inbox.php'</script>";
		}
	}
?>

        <div class="grid_10">
            <div class="box round first grid">
                <h2>Đơn Hàng Đã Đặt</h2>
                <div class="block">   
                	<?php
                		if(isset($shifted)){
                		echo $shifted;
                	}  
                	?>  
                	<?php
                		if(isset($del_shifted)){
                		echo $del_shifted;
                	}  
                	?>  
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>No.</th>
							<th>Order Time</th>
							<th>Order Code</th>
							<th>Customer Name</th>
							<th>Action</th>
							<th>Status</th>
						</tr>
					</thead>
					<tbody>
						<?php 
						$ct = new cart();
						$fm = new Format();
						$get_inbox_cart =$ct-> get_inbox_cart();
						if($get_inbox_cart){
							$i = 0;
							while($result = $get_inbox_cart->fetch_assoc()){
								$i++;
						?>
						<tr class="odd gradeX">
							<td><?php echo $i?></td>
							<td><?php echo $fm->formatDate($result['date_created'])?></td>
							<td><?php echo $result['order_code']?></td>
							<td><?php echo $result['name']?></td>
							<td><a href="customer.php?customerid=<?php echo $result['customer_id']?>&order_code=<?php echo $result['order_code']?>">View Order</a></td>
							<td>
								<?php 
									if($result['status']== 0){
								?>
									<a href="?shiftid=<?php echo $result['order_code']?>">Tình Trạng Mới</a>
								<?php 
									}elseif($result['status'] == '1') {
								?>
									<?php echo 'Đang Vận Chuyển...'?>
								<?php
									}elseif($result['status'] == '2'){
								?>
									<a href="?delid=<?php echo $result['order_code']?>">Đã Nhận | Xóa</a>
								<?php
									}
								?>
							</td>
						</tr>
						<?php
							}
						}
						?>
						
					</tbody>
				</table>
               </div>
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
