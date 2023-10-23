<style>
	.images_1_of_2 img {
	  height: 105px;
	  width: 95px;
	}
	.header_bottom_left{
		margin-top: 2px ;
	}
	.flexslider .slides li img{
		min-height: 253px;
	}
	.text .button a {
		background: linear-gradient( to right top, #006421, #016a28, #01712f, #017736, #017e3d, #01894b );
	}
	.listview_1_of_2 .list_2_of_1 h2{
		font-weight: bold;
	}
</style>
	<div class="header_bottom">
		<div class="header_bottom_left">
			<div class="section group">
				<?php
					$getLastestApsara = $product->getLastestApsara();
					if($getLastestApsara){
						while($resultApsara = $getLastestApsara->fetch_assoc() ){
								
				?>
				<div class="listview_1_of_2 images_1_of_2">
					<div class="listimg listimg_2_of_1">
						 <a href="details.php?proid=<?php echo $resultApsara['productId']?>"> <img src="admin/uploads/<?php echo $resultApsara['image']?>" alt="" /></a>
					</div>
				    <div class="text list_2_of_1">
						<h2>Apsara</h2>
						<p><?php echo $resultApsara['productName']?></p>
						<div class="button"><span><a href="details.php?proid=<?php echo $resultApsara['productId']?>">Add to cart</a></span></div>
				   </div>
			   </div>	
			   <?php
			   		}
			   	}
			   	?>
			   	<?php
					$getLastestHatesla = $product->getLastestHatesla();
					if($getLastestHatesla){
						while($resultHatesla = $getLastestHatesla->fetch_assoc() ){
								
				?>		
				<div class="listview_1_of_2 images_1_of_2">
					<div class="listimg listimg_2_of_1">
						  <a href="details.php?proid=<?php echo $resultHatesla['productId']?>"><img src="admin/uploads/<?php echo $resultHatesla['image']?>" alt="" / ></a>
					</div>
					<div class="text list_2_of_1">
						  <h2>HATESLA</h2>
						  <p><?php echo $resultHatesla['productName']?></p>
						  <div class="button"><span><a href="details.php?proid=<?php echo $resultHatesla['productId']?>">Add to cart</a></span></div>
					</div>
				</div>
			</div>
			 <?php
			   		}
			   	}
			   	?>
	   		<?php
			$getLastestDAndG = $product->getLastestDAndG();
			if($getLastestDAndG){
				while($resultDAndG = $getLastestDAndG->fetch_assoc() ){
						
				?>	
			<div class="section group">
				<div class="listview_1_of_2 images_1_of_2">
					<div class="listimg listimg_2_of_1">
						 <a href="details.php?proid=<?php echo $resultDAndG['productId']?>"> <img src="admin/uploads/<?php echo $resultDAndG['image']?>" alt="" width="50px" height="50px" /></a>
					</div>
				    <div class="text list_2_of_1">
						<h2>D&G TBD</h2>
						<p><?php echo $resultDAndG['productName']?></p>
						<div class="button"><span><a href="details.php?proid=<?php echo $resultDAndG['productId']?>">Add to cart</a></span></div>
				   </div>
			   </div>
			    <?php
			   		}
			   	}
			   	?>		
				<?php
					$getLastestEnVang = $product->getLastestEnVang();
					if($getLastestEnVang){
						while($resultEnVang = $getLastestEnVang->fetch_assoc() ){
								
				?>	
				<div class="listview_1_of_2 images_1_of_2">
					<div class="listimg listimg_2_of_1">
						  <a href="details.php?proid=<?php echo $resultEnVang['productId']?>"><img src="admin/uploads/<?php echo $resultEnVang['image']?>" alt="" /></a>
					</div>
					<div class="text list_2_of_1">
						  <h2>Én Vàng</h2>
						  <p><?php echo $resultEnVang['productName']?></p>
						  <div class="button"><span><a href="details.php?proid=<?php echo $resultEnVang['productId']?>">Add to cart</a></span></div>
					</div>
				</div>
				 <?php
			   		}
			   	}
			   	?>
			</div>
		  <div class="clear"></div>
		</div>
			 <div class="header_bottom_right_images">
		   <!-- FlexSlider -->
             
			<section class="slider">
				  <div class="flexslider">
					<ul class="slides">
						<?php
							$get_slider = $product->show_slider() ;
							if($get_slider){
								while($result_slider = $get_slider->fetch_assoc()){
						?>
						<li><img src="admin/uploads/<?php echo $result_slider['sliderImage']?>" alt="<?php echo $result_slider['sliderName']?>"/></li>
						<?php 
							}
						}
						?>
						
				    </ul>
				  </div>
	      </section>
<!-- FlexSlider -->
	    </div>
	  <div class="clear"></div>
  </div>	