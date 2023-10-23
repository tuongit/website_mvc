<?php
	include'inc/header.php';
	// include 'inc/slider.php';
?>
<?php
	  if(!isset($_GET['catid']) || $_GET['catid'] == NULL){
     	echo "<script>window.location= '404.php' </script>";
     }else {
    	$id = $_GET['catid'];
    }
   // if($_SERVER['REQUEST_METHOD'] == 'POST'){
   // 	$catName = $_POST['catName'];
   // }
?>
<style>
	.main .images_1_of_4{
		width: 23.8%;
	}

	.grid_1_of_4 .probycate_name{

		font-family: 'Monda', sans-serif;
		font-size: 20px;
		font-weight: bold;
		color: #000;

	}
</style>
 <div class="main">
    <div class="content">
    	<div class="content_top">
    		<?php
	      		$name_cat = $cat->get_name_by_cat($id);
	      		if($name_cat){
	      			$result_name = $name_cat->fetch_assoc();


	      	?>
    		<div class="heading">
    		<h3>CATEGORIES: <?php echo $result_name['catName']?></h3>
    		</div>
    		<div class="clear"></div>
    		<?php
    			}
    		?>
    	</div>
	      <div class="section group">
	      	<?php
	      		$productbycat = $cat->get_product_by_cat($id);
	      		if($productbycat){
	      			while($result = $productbycat->fetch_assoc()){

	      	?>
				<div class="grid_1_of_4 images_1_of_4">
					 <a href="details.php?proid=<?php echo  $result['productId']?>"><img src="admin/uploads/<?php echo $result['image']?>" width="300px" height="250px" alt="" /></a>
					 <p class="probycate_name"><?php echo $result['productName']?> </p>
					 <!-- <p><?php echo $fm->textShorten($result['product_desc'], 50)?></p> -->
					 <p><span class="price"><?php echo $fm->format_currency($result['price']).' '.'VNĐ'?></span></p>
				     <div class="button"><span><a href="details.php?proid=<?php echo  $result['productId']?>" class="details">Details</a></span></div>
				</div>

				<?php
	      			}
	      		}
	      		else{
	      			echo 'Category Not AVAIABLE!!!!';
	      		}
				?>
				
			</div>

	
	
    </div>
 </div>
</div>
<?php
	include 'inc/footer.php';
?>
   