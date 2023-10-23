<?php
	include_once'inc/header.php';
	//include 'inc/slider.php';
?>
<?php 
    if(!isset($_GET['proid']) || $_GET['proid'] == NULL){
    	echo "<script>window.location= '404.php' </script>";
    }else {
    	$id = $_GET['proid'];
    }

	$customer_id = Session::get('customer_id');//lay customer id trong class customer da khai bao
   if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['compare'])){
   	$productid = $_POST['productid'];
   	$insertCompare = $product->insertCompare($productid, $customer_id);
   }
   if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['wishlist'])){
   	$productid = $_POST['productid'];
   	$insertWishlist = $product->insertWishlist($productid, $customer_id);
   }
   if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])){
   	$quantity = $_POST['quantity'];
   	$insertCart= $ct->add_to_cart($quantity, $id);
   }
   if(isset($_POST['comment_submit'])){
   	$comment = $cs->insert_comment();
   }
   
?>
<style>
	.main .span_3_of_2 h2 {
		font-weight: bold;
		font-size: 32px;
	}

	.main .span_3_of_2 p {
		color: #000;

	}

	.main .product-desc h2{
		background: #000;
	}

	.main .product-desc p{
		color: #000;
	}

	.add-cart .buysubmit{
		background:#CC3636 ;
	}

	.button_details input[type=submit] {
		float: left;
		margin: 0px 5px;
		background: linear-gradient( to right top, #006421, #016a28, #01712f, #017736, #017e3d, #01894b );
	}

	.col-md-8 {
		margin-left: 10px;
	}

	.col-md-8 h4 {
		color: #000;
		font-weight: bold;
	}
	.rightsidebar h2{
		color: #000;
		font-weight: bold;

	}

	.rightsidebar li a{
		color: #000;
		text-decoration: none;
		
	}

</style>
 <div class="main">
    <div class="content">
    	<div class="section group">
    		<?php
    		$get_product_details = $product->get_details($id);
    		if($get_product_details){
    			while($result_details = $get_product_details -> fetch_assoc()){

    			?>
				<div class="cont-desc span_1_of_2">				
					<div class="grid images_3_of_2">
						<img src="admin/uploads/<?php echo $result_details['image']?>" alt="" />
					</div>
					<div class="desc span_3_of_2">
						<h2><?php echo $result_details['productName']?></h2>
						 <!-- <p><?php echo $fm->textShorten($result_details['product_desc'], 20)?></p> -->
				
						<div class="price">
							<p><b>Price: </b><span class="price"><?php echo $fm->format_currency($result_details['price'])." "."VNĐ"?></span></p>
							<p><b>Category:</b> <span><?php echo $result_details['catName']?></span></p>
							<p><b>Brand:</b><span><?php echo $result_details['brandName']?></span></p>
						</div>
						<div class="add-cart">
							<form action="" method="post">
								<input type="number" class="buyfield" name="quantity" value="1" min="1"/>
								<input type="submit" class="buysubmit" name="submit" value="Buy Now"/><br/>
								<?php
								if(isset($addToCart)) {
									echo '<span style="color:red; font-size:18px;">PRODUCT ALREADY ADDED</span>';
								}
								?>
							</form>				
						</div>
						<div class="add-cart">
							<div class="button_details">
								<form action="" method="POST">
								<!-- <a href="?wlist<?php echo $result_details['productId']?>" class="buysubmit">Save to Wishlist</a>
								<a href="?compare<?php echo $result_details['productId']?>" class="buysubmit">Compare to Wishlist</a> -->
								<input type="hidden" name="productid" value="<?php echo $result_details['productId']?>" />
								 <?php
								  		$login_check = Session::get('customer_login');
								  		if($login_check){
								  			echo '<input type="submit" class="buysubmit" name="compare" value="Compare Product" />'.' ';
								  			
								  		 }else{
								  		 	echo '';
								  		 }
								  ?>
								</form>	
								<form action="" method="POST">
								<!-- <a href="?wlist<?php echo $result_details['productId']?>" class="buysubmit">Save to Wishlist</a>
								<a href="?compare<?php echo $result_details['productId']?>" class="buysubmit">Compare to Wishlist</a> -->
								<input type="hidden" name="productid" value="<?php echo $result_details['productId']?>" />
								 <?php
								  		$login_check = Session::get('customer_login');
								  		if($login_check){
								  			echo '<input type="submit" class="buysubmit" name="wishlist" value="Save To Wishlist" />'; 
								  		 }else{
								  		 	echo '';
								  		 }
								  ?>
								</form>		
							</div>	
							<div class="clear "></div>	
							<p><?php
								if (isset($insertCompare)) {
									echo $insertCompare;
								}
							?>
							<?php
								if (isset($insertWishlist)) {
									echo $insertWishlist;
								}
								?>
							</p>
						</div>

					</div>
					<div class="product-desc">
						<h2>Product Details</h2>
					 	<p><?php echo ($result_details['product_desc'])?></p>
			    </div>
				
				</div>
				<?php
				}
    		}
				?>
				<div class="rightsidebar span_3_of_1">
					<h2>CATEGORIES</h2>
					<ul>
						<?php
							$getall_category = $cat ->show_category_frontend();
							if($getall_category)
							{
								while($result_allcat = $getall_category->fetch_assoc())
								{


						?>
				      <li><a href="productbycat.php?catid=<?php echo $result_allcat['catId']?>"> <?php echo $result_allcat['catName']?></a></li>
				      <?php
				      		}
							}
				      ?>
    				</ul>
    	
 				</div>
 		</div>
 	</div>
 	<div class="binhluan">
 		<div class="row"> 
	 		<div class="col-md-8">
	 			<h4>Ý Kiến Của Bạn</h4>
	 			
	 			<form action="" method="POST">
	 				<p><input type="hidden" value="<?php echo $id ?>" name="productIdComment"></p>
			 		<p><input type="text" placeholder="Điền tên....." class="form-control" name="nameUser" /></p>
			 		<p><textarea rows="5" style="resize: none;" placeholder="bình luận..." class="form-control" name="descriptionComment"></textarea></p>
			 		<?php
		 				if (isset($comment)) {
		 					echo $comment;
		 				}
	 				?>
			 		<p><input type="submit" name="comment_submit" class="btn btn-danger" value="Gửi bình luận" /></p>
		 		</form>
	 		</div>
 		</div>
 	</div>
	</div>
	
   <?php
	include 'inc/footer.php';
?>
   