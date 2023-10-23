 <?php
	include_once'inc/header.php';
	//include 'inc/slider.php';
?>
<style>
	.main h2 {
	 font-size: 33px;
    color: #000;
    font-weight: bold;
    text-align: center;
	}
</style>
 <div class="main">
    <div class="container">			
		
		<div class="wrap-content">
			<?php
				$newId = $_GET['shownewid'];
				$show_new_details = $news->getnewbyId($newId);
      		if($show_new_details){
      		 	while($result_news_details = $show_new_details->fetch_assoc()){
      	?>
			<div class="row">
				<h2><?php echo $result_news_details['title']?></h2>
				<div class="col-sm-7 mb-3">
				 <p><?php echo $result_news_details['description']?></p>
				</div>
				 <div class="col-sm-3">
				 	<img src="admin/uploads/<?php echo $result_news_details['image']?>" alt="" width="300px" height="220px"/></a>
				</div>
			</div>

			<?php
				}
      	}
			?>
		</div>
		
    </div>
</div>
<?php
	include_once'inc/footer.php';
	//include_once 'inc/slider.php';
 ?>