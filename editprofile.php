<?php
	include_once'inc/header.php';
	//include 'inc/slider.php';
?>
<?php 
$login_check = Session::get('customer_login');
   if($login_check== false){
   	header('Location:login.php');

   }
?>
<?php
	$id = Session::get('customer_id');
	if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['save'])) {
		$Update_customers = $cs -> update_customers($_POST,$id);
	}
?>

 <div class="main">
    <div class="content">
    	<div class="section group">
    		<div class="content_top">
	    		<div class="heading">
	    		<h3>EDIT PROFILE CUSTOMERS</h3>
    		</div>
			<form action="" method="post">
 			<table class="tblone">
 				<tr>
 				<?php 
 					if(isset($Update_customers)){
 						echo '<td colspan="3">'.$Update_customers.'</td>';
 					}
	 				?>
 				<?php>
 				
 					
 					
 				</tr>
 				
 				<?php
	 				$get_customers = $cs -> show_customers($id);
	 				if($get_customers)
	 				{
	 					while($result = $get_customers ->fetch_assoc())
	 					{
 				?>
 				<tr>
 					<td>Name</td>
 					<td>:</td>
 					<td><input type="text" name="name" value="<?php echo $result['name']?>" /></td>
 					
 				</tr>
 				

 				<tr>
 					<td>Phone</td>
 					<td>:</td>
 					<td><input type="text" name="phone" value="<?php echo $result['phone']?>" /></td>
 					
 				</tr>
 				<!-- <tr>
 					<td>Country</td>
 					<td>:</td>
 					
 				</tr> -->
 				<tr>
 					<td>Zipcode</td>
 					<td>:</td>
 					<td><input type="text" name="zipcode" value="<?php echo $result['zipcode']?>" /></td>
 					
 				</tr>
 				<tr>
 					<td>Email</td>
 					<td>:</td>
 					<td><input type="text" name="email" value="<?php echo $result['email']?>" /></td>
 					
 				</tr>
 				<tr>
 					<td>Address</td>
 					<td>:</td>
 					<td><input type="text" name="address" value="<?php echo $result['address']?>" /></td>
 					
 				</tr>
 				<tr>
 					<td colspan="3"><input type="submit" name="save" value="Save" class="grey" /></td>
 				</tr>
 				<?php
 					}
 				}
 				?>
 			</table>
 		</form>
 		</div>
 	</div>
	</div>
	
   <?php
	include 'inc/footer.php';
?>
   