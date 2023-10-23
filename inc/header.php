<?php
    include 'lib/session.php';
    Session::init();//khoi tao 1 session mới
?>
<?php 
	include_once 'lib/database.php';
	include_once 'helpers/format.php';

	spl_autoload_register(function($class){
		include "classes/".$class.".php";// tự động lấy các trường trong class
	});

	$db = new Database();
	$fm = new Format();
	$ct = new cart();
	$us = new user();
	$br = new brand();
	$cs = new customer();
	$cat = new category();
	$product = new product();
	$news = new news();
	?>
<?php
  header("Cache-Control: no-cache, must-revalidate");
  header("Pragma: no-cache"); 
  header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); 
  header("Cache-Control: max-age=2592000");
?>

<head>
<title>SGHGROUP</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<link href="css/style.css" rel="stylesheet" type="text/css" media="all"/>
<link href="css/menu.css" rel="stylesheet" type="text/css" media="all"/>
<link rel="shortcut icon" type="image/png" href="images/logosgh.png"/>
<script src="js/jquerymain.js"></script>
<script src="js/script.js" type="text/javascript"></script>
<script type="text/javascript" src="js/jquery-1.7.2.min.js"></script> 
<script type="text/javascript" src="js/nav.js"></script>
<script type="text/javascript" src="js/move-top.js"></script>
<script type="text/javascript" src="js/easing.js"></script> 
<script type="text/javascript" src="js/nav-hover.js"></script>
<link href='http://fonts.googleapis.com/css?family=Monda' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Doppio+One' rel='stylesheet' type='text/css'>
<!-- Latest compiled and minified CSS -->
 <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<!-- Latest compiled and minified JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script> 
<script type="text/javascript">
  $(document).ready(function($){
    $('#dc_mega-menu-orange').dcMegaMenu({rowItems:'4',speed:'fast',effect:'fade'});
  });
</script>

<style>
	.menu ul.dc_mm-orange {
		background: linear-gradient( to right top, #006421, #016a28, #01712f, #017736, #017e3d, #01894b );
	}
	.menu ul.dc_mm-orange li a{
		border-left:1px solid #000 ;
	}
	.header_top_right .search_box .searchBtn {
		background: linear-gradient( to right top, #006421, #016a28, #01712f, #017736, #017e3d, #01894b );
	}

.header_top .logo{
	float:left;
	width:30%;
}
/**** Header Top Right ****/
.header_top .header_top_right{
	float:left;
	width:70%;
	margin-top:35px;
}

.menu ul.dc_mm-orange li a{
	padding: 20px 18px;
	font-family: "Monda", sans-serif;
	font-weight: bold;
	font-size: 12px;
}
.menu ul.dc_mm-orange li a .dc-mega-icon{
	background:none;
}

.login{
	background: #EDEDED;
}
.login a{
	color: #DD0F0E;
	font-weight: bold;
}
</style>
</head>
<body>
  <div class="wrap">
		<div class="header_top">
			<div class="logo">
				<a href="index.php"><img src="images/logosgh.png" alt="" width="100px" height="100px" /></a>
			</div>
			  <div class="header_top_right">
			    <div class="search_box">
				    <form action="search.php" method="post">
				    	<input type="text" placeholder="Tìm kiếm sản phẩm" name="tukhoa">
				    	<input class="searchBtn" type="submit" value="Tìm kiếm" name="search_product">
				    </form>
			    </div>
			    <div class="shopping_cart">
					<div class="cart">
						<a href="cart.php" title="View my shopping cart" rel="nofollow">
								<span class="cart_title">Cart</span>
								<span class="no_product">
									<?php
									$check_cart = $ct->check_cart();

										if($check_cart) {
										$sum = Session::get("sum");
										$qty = Session::get("qty");
										echo $fm->format_currency($sum).' '.'đ'.'-'.'Qty:'.$qty;

									}else{
										echo 'Empty';
									}
									?>
								</span>
							</a>
						</div>
			      </div>

			  <?php
			  	if(isset($_GET['customer_id'])){
			  		$customer_id = $_GET['customer_id'];
			  		$del_cart = $ct -> del_all_data_cart();
			  		$del_compare = $ct -> del_all_data_compare($customer_id);
			  		Session::destroy();
			  	}
			  ?>
		   <div class="login">
		   	<?php 
		   		$login_check = Session::get('customer_login');
		   		if($login_check == false){
		   			echo '<a href="login.php" style="text-decoration: none;" > Login</a></div>';
		   		}else{
		   			echo '<a href="?customer_id='.session::get('customer_id').'" style="text-decoration: none;" >Logout</a></div>';
		   		}
		   	?>
		   
		 <div class="clear"></div>
	 </div>
	 <div class="clear"></div>
 </div>
<div class="menu">
	<ul id="dc_mega-menu-orange" class="dc_mm-orange">
	  <li><a href="index.php">Trang Chủ</a></li>
	  <li class="dropdown">
	  	<a class="dropdown-toggle" data-toggle="dropdown" href="#">Sản Phẩm <span class="caret"></span></a>
	  	<ul class="dropdown-menu">
	  			<?php 
	  			$probycat = $cat ->show_category_frontend();
	  			if($probycat){
	  				while($result_probycat = $probycat->fetch_assoc()){
	  			?>
	  			<li><a href="productbycat.php?catid=<?php echo $result_probycat['catId']?>"> <?php echo $result_probycat['catName']?></a></li>
	  			<?php
	  					}
	  			}
	  			?>
	  	</ul>
	  </li>
	  <li class="dropdown">
	  	<a class="dropdown-toggle" data-toggle="dropdown" href="#">Thương Hiệu
	  		<span class="caret"></span>
	  	</a>
	  	<ul class="dropdown-menu">
	  			<?php 
	  			$brand = $br ->show_brand();
	  			if($brand){
	  				while($result_brand = $brand ->fetch_assoc()){
	  			?>
	  			<li><a href="productbybrand.php?brandid=<?php echo $result_brand['brandId']?>"> <?php echo $result_brand['brandName']?></a></li>
	  			<?php
	  					}
	  			}
	  			?>
	  	</ul>
	  </li>
	  <li><a href="new.php">Tin Tức</a></li>
	 
	  <!-- <?php
	  	$customer_id = Session::get('customer_id');
	  	$check_order = $ct ->check_order($customer_id);
	  	if($check_order==true)
	  	{
	  			echo '<li><a href="orderdetails.php">Đã Đặt</a></li>';
	  	}else{
	  			echo '';
	  	}
	  ?> -->
	  <?php
	  		$login_check = Session::get('customer_login');
	  		if($login_check==false){
	  			echo '';
	  		}else {
	  	 		echo '<li><a href="profile.php">Thông Tin</a> </li>';
	  	 }
	  ?>
	 
	   <li><a href="contact.php">Liên Hệ</a> </li>
	    <li><a href="wishlist.php">Yêu Thích</a> </li>
	     <li><a href="compare.php">So Sánh</a> </li>
	    <?php
	  		$login_check = Session::get('customer_login');
	  		if($login_check==false){
	  			echo '';
	  		}else {
	  	 		echo ' <li><a href="history_order.php">Lịch Sử</a> </li>';
	  	 }
	  ?>
	   <li><a href="cart.php">Giỏ Hàng</a></li>
	  <div class="clear"></div>
	</ul>
</div>



