<?php
	include'inc/header.php';
	// include 'inc/slider.php';
?>
<?php 
	$login_check = Session::get('customer_login');
	if($login_check){
		echo '<script>window.location.href = "index.php";</script>';
	}
?>
<?php
	
		if($_SERVER['REQUEST_METHOD'] == 'POST' &&  isset($_POST['submit'])){
			$insertCustomers = $cs->insert_customers($_POST);
		}
?>
<?php
	
		if($_SERVER['REQUEST_METHOD'] == 'POST' &&  isset($_POST['login'])){
			$login_customers = $cs->login_customers($_POST);
		}
?>
<style>
	.main .login_panel h3, 
	.main .register_account h3 {
    font-weight: Bold;
    color: #DD0F0E;
  	}
  	.main p{
    color: #000;
  	}
  	.form-control {
    width: 97%;
    font-size: 12px;
    padding: 4px;
    margin: 5px 5px;
 	}
 	.main .register_account {
    height: 316px;
    width: 770px;
	}
	.main p.note {
    padding: 8px;
	}
	.main .register_account form input[type="text"], .register_account form select {
    margin: 5px 5px;
    width: 340px;
    border: 1px solid #ccc;
    border-radius: 4px;
    padding: 4px;
	}
	
</style>
 <div class="main">
 		<?php
    			if(isset($login_customers))
    				echo $login_customers;
    	?>
    	<?php
    			if(isset($insertCustomers))
    				echo $insertCustomers;
    	?>
    <div class="content">
    	
    	 <div class="login_panel">
        	<h3>Đăng Nhập</h3>
        	<p>Sign in with the form below.</p>
        
        	<form action="" method="post" >
                	<input type="text" class="form-control" name="email" placeholder="Nhập E-Mail...">
                    <input  type="password" class="form-control" name="password" class="field" placeholder="Nhập Mật Khẩu...">
                 
                 <p class="note"><a href="login.php">Quên mật khẩu?</a></p>
                    <button type="submit" class="btn btn-danger" name="login" >Đăng Nhập</button>
                    </div>
                    </form>
                    <?php?>
    	<div class="register_account">
    		<h3>Đăng Kí Tài Khoản</h3>
    		
    		<form action="" method="post" enctype="multipart/form-data">
		   	<table>
		   		<tbody>
						<tr>
							<td class="form_left">
								<div>
								 <input type="text" class="form-control" name="name" placeholder="Nhập Tên...">
								</div>
								<div>
								   <input type="text" class="form-control"  name="email" placeholder="Nhập Email...">
								</div>
								 <div>
					          	<input type="text" class="form-control"  name="phone" placeholder="Nhập Số Điện Thoại...">
					          </div>
					          <div>
					          	<input type="text" class="form-control"  name="zipcode" placeholder="Nhập ZipCode...">
					          </div>
			    			 </td>
			    			<td class="form_right">
								<div>
									<input type="text" class="form-control"  name="address" placeholder="Nhập Địa Chỉ...">
								</div>
					    		<div>
									<select class="form-select" aria-label="Default select example" name="country" onchange="change_country(this.value)">
										<option value="null">Chọn Quốc Gia</option>         
										<option value="VN">Việt Nam</option>
										<option value="US">Mỹ</option>
					        	 	</select>
							 	</div>		        
							 <div>
							       <input type="text" class="form-control"  name="city" placeholder="Nhập Thành Phố...">
							  </div>
					       <div>
								<input type="password" class="form-control"  name="password" placeholder="Nhập Mật Khẩu...">
							</div>
		    			</td>
		   		 </tr> 
			    </tbody>
			 </table> 
			<button class="btn btn-danger" type="submit" name="submit" >Tạo Tài Khoản</button>
		    <div class="clear"></div>
		    </form>

    	</div>  	
       <div class="clear"></div>
    </div>
 </div>
</div>
<?php
	include 'inc/footer.php';
?>
   