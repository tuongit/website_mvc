 <?php
	include_once'inc/header.php';
	//include_once 'inc/slider.php';
 ?>
<style>
	.main .images_1_of_4{
		width: 23.8%;
	}

	.grid_1_of_4 .title_news{

		font-family: 'Monda', sans-serif;
		font-size: 20px;
		font-weight: bold;
		color: #000;

	}

	.content_bottom .heading h3 {
		color: #CC3636;
		font-weight: bold;
		text-align: center;
	}

	.phanTrang a {
		display: inline-block;
		text-decoration: none;
		align-content: center;
	}

	.main .pagination>li:first-child>a, .pagination>li:first-child>span {
    margin-left: 500px;
   }
</style>
 <div class="main">
    <div class="content">			
		<div class="content_bottom">
    		<div class="heading">
    			<h3>Tin Tức</h3>
    		</div>
			<div class="clear"></div>
		</div>
		<div class="section group">
			<?php
				$show_new = $news->get_new();
      		if($show_new){
      		 	while($result_news = $show_new->fetch_assoc()){	
      	?>
			<div class="grid_1_of_4 images_1_of_4">
				 <a  href="newsdetails.php?shownewid=<?php echo $result_news['newId']?>" class="details">
				 	<img src="admin/uploads/<?php echo $result_news['image']?>" alt="" width="300px" height="220px"/></a>
				 <p class="title_news"><?php echo $result_news['title']?> </p>
				 <!-- <p><?php echo $fm->textShorten($result_news['description'], 20)?></p> -->
			     <div class="button"><span><a href="newsdetails.php?shownewid=<?php echo $result_news['newId']?>" class="details">Chi Tiết</a></span></div>
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
			    		$news_all = $news->get_all_news();
			    		$news_count = mysqli_num_rows($news_all);//đem so luong sp
			    		$news_button =ceil($news_count/4);//làm tròn
			    		$i = 1;
			    		for($i=1;$i<=$news_button;$i++){
			    			//echo '<a style="margin:0 5px; text-decoration:none;" href="new.php?trang='.$i.'">'.$i.'</a>';
			    			echo '<li class="page-item"><a class="page-link" href="new.php?trang='.$i.'">'.$i.'</a></li>';
			    		}
			    	?>
			    </ul>
			</nav>
  		</div>
    </div>
</div>
<?php
	include_once'inc/footer.php';
	//include_once 'inc/slider.php';
 ?>