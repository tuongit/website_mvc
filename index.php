
<?php
	include_once'inc/header.php';
	include_once 'inc/slider.php';
?>

<style >
	.main .images_1_of_4{
		width: 23.8%;
	}
	.content_top .heading h3 {
		color: #CC3636;
		font-weight: bold;
	}

	.content_bottom .heading h3 {
		color: #CC3636;
		font-weight: bold;
	}

	.grid_1_of_4 .productName{

		font-family: 'Monda', sans-serif;
		font-size: 20px;
		font-weight: bold;
		color: #000;

	}
	.images_1_of_4 .button .details{
			background-image: linear-gradient( to right top, #006421, #016a28, #01712f, #017736, #017e3d, #01894b );
			color: white;
	}

	.phanTrang a {
		display: inline-block;
		text-decoration: none;
		align-content: center;
	}

	.main .pagination>li:first-child>a, .pagination>li:first-child>span {
    margin-left: 480px;
   }
</style>
 <div class="main">
    <div class="content">
    	<div class="content_top">
    		<div class="heading">
    		<h3>Feature Products</h3>
    		</div>
    		<div class="clear"></div>
    	</div>
	      <div class="section group">
	      	<?php
					$product_feathered = $product->getproduct_feathered();
	      		if($product_feathered){
	      		 	while($result_product = $product_feathered->fetch_assoc()){

	      	?>
				<div class="grid_1_of_4 images_1_of_4">
					 <a href="details.php?proid=<?php echo $result_product['productId']?>" class="details"><img src="admin/uploads/<?php echo $result_product['image']?>" alt="" width="300px" height="230px" /></a>
					 <p class="productName"><?php echo $result_product['productName']?></p>
					 <!-- <p><?php echo $fm->textShorten($result_product['product_desc'], 20)?></p> -->

					 <p><span class="price"><?php echo $fm->format_currency($result_product['price'])." "."VNĐ"?></span></p>
				     <div class="button"><span><a href="details.php?proid=<?php echo $result_product['productId']?>" class="details">Details</a></span></div>
				</div>
				<?php
					}
	      	}
				?>
			</div>
			<div class="content_bottom">
	    		<div class="heading">
	    			<h3>New Products</h3>
	    		</div>
    			<div class="clear"></div>
    		</div>
			<div class="section group">
				<?php
					$product_new = $product->getproduct_new();
	      		if($product_new){
	      		 	while($result_new = $product_new->fetch_assoc()){

	      		
	      	?>
				<div class="grid_1_of_4 images_1_of_4">
					 <a  href="details.php?proid=<?php echo $result_new['productId']?>" class="details">
					 	<img src="admin/uploads/<?php echo $result_new['image']?>" alt="" width="300px" height="230px"/></a>
					 <p class="productName"><?php echo $result_new['productName']?> </p>
					 <!-- <p><?php echo $fm->textShorten($result_new['product_desc'], 20)?></p> -->
					 <p><span class="price"><?php echo $fm->format_currency($result_new['price'])." "."VND"?></span></p>
				     <div class="button"><span><a href="details.php?proid=<?php echo $result_new['productId']?>" class="details">Details</a></span></div>
				</div>

				<?php
					}
	      	}
				?>
			</div>
			<div class="phanTrang">
				<nav aria-label="Page navigation example">
				  <ul class="pagination">
					<?php
		    		$product_all = $product->get_all_product();
		    		$product_count = mysqli_num_rows($product_all);//đem so luong sp
		    		$product_button = ceil($product_count/4);//làm tròn
		    		$i = 1;
		    		
		    		for($i=1;$i<=$product_button;$i++){
		    			echo '<li class="page-item"><a class="page-link" href="index.php?trang='.$i.'">'.$i.'</a></li>';
		    			// echo '<a style="margin:0 5px; text-decoration:none;" href="index.php?trang='.$i.'">'.$i.'</a>';
		    		}
		    	?>
		    	 </ul>
		    	</nav>
	    </div>
    </div>
    
 </div>
</div>

<?php
	include 'inc/footer.php';
?>
   