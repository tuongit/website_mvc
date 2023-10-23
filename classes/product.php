<?php
	$file_name = realpath(dirname(__FILE__));
	include_once ($file_name.'/../lib/database.php');
	include_once ($file_name.'/../helpers/format.php');
	
?>

<style>
	.success{
		color: green;
		font-size: 18px;
	}
	.error{
		color: red;
		font-size: 18px;
	}
</style>
<?php
/**
 * 
 */
class product 
{
	private $db;
	private $fm;// format
	
	public function __construct()
	{
		$this->db = new Database();//truyen class Database từ databases.php sang biến db
		$this->fm = new Format();
	}
	public function insert_product($data,$files)
	{
		
		$productName = mysqli_real_escape_string($this->db->link, $data['productName']);//link là biến kết nối từ file databases.php
		$brand = mysqli_real_escape_string($this->db->link, $data['brand']);
		$category = mysqli_real_escape_string($this->db->link, $data['category']);
		$product_desc = mysqli_real_escape_string($this->db->link, $data['product_desc']);
		$price = mysqli_real_escape_string($this->db->link, $data['price']);
		$type = mysqli_real_escape_string($this->db->link, $data['type']);
		//$image = mysqli_real_escape_string($this->db->link, $data['productName']);
		//kiểm tra hình ảnh và lấy hình ảnh cho vào folder uploads
		$permited = array('jpg', 'jpeg', 'png', 'gif');
		$file_name = $_FILES['image']['name'];
		$file_size = $_FILES['image']['size'];
		$file_temp = $_FILES['image']['tmp_name'];

		$div = explode('.', $file_name);
		$file_ext = strtolower(end($div));
		$unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
		$uploaded_image = "uploads/".$unique_image;
		if($productName==""|| $brand =="" || $category==""|| $product_desc=="" || $type =="" || $price == "" || $file_name=""){
			$alert = "<span class='error'>Các Trường Không Được Để Trống </span>";
			return $alert;
		}else 
		{
			move_uploaded_file($file_temp,$uploaded_image);
			$query = "INSERT INTO tbl_product(productName,brandId,catId,product_desc,type,price,image) VALUES('$productName','$brand','$category','$product_desc','$type','$price','$unique_image')";
			$result = $this->db->insert($query); 
			if($result){
				$alert = "<span class='success'>Thêm Sản Phẩm Thành Công</span>";
				return $alert;
				echo "<script>window.location= 'productlist.php' </script>";
			}else {
				$alert = "<span class='error'>Thêm Sản Phẩm Không Thành Công</span>";
				return $alert;
			}
		}
	}
	public function insert_slider($data,$files){
		$sliderName = mysqli_real_escape_string($this->db->link, $data['sliderName']);//link là biến kết nối từ file databases.php
		$type = mysqli_real_escape_string($this->db->link, $data['type']);
		
		//kiểm tra hình ảnh và lấy hình ảnh cho vào folder uploads
		$permited = array('jpg', 'jpeg', 'png', 'gif');
		$file_name = $_FILES['image']['name'];
		$file_size = $_FILES['image']['size'];
		$file_temp = $_FILES['image']['tmp_name'];

		$div = explode('.', $file_name);
		$file_ext = strtolower(end($div));
		$unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;//random từ 0 tới 10 và nối đuôi với file ext
		$uploaded_image = "uploads/".$unique_image;

		if($type="" || $sliderName == ""){
			$alert = "<span class='error'>Các Trường Không Được Để Trống!!!</span>";
			return $alert;
		}else {
			if(!empty($file_name)){
				if(in_array($file_ext, $permited) === false){
					$alert ="<span class='success'>You can upload only:-".implode(',', $permited)."</span>";
					return $alert;
				}
				move_uploaded_file($file_temp,$uploaded_image);
				$query = "INSERT INTO tbl_slider(sliderName,type,sliderImage) VALUES('$sliderName','$type','$unique_image')";
				$result = $this->db->insert($query); 
				if($result){
					$alert = "<span class='success'>Slider Đã Thêm Thành Công</span>";
					return $alert;
					
				}else {
					$alert = "<span class='error'>Slider Đã Thêm Không Thành Công</span>";
					return $alert;
				}

			}
			
		}
	}
	public function show_product(){
		$query = "SELECT tbl_product.*, tbl_category.catName, tbl_brand.brandName FROM tbl_product INNER JOIN tbl_category ON tbl_product.catId = tbl_category.catId INNER JOIN tbl_brand ON tbl_product.brandId = tbl_brand.brandId order by tbl_product.productId desc";

		$result = $this ->db->select($query);
		return $result;
	
	}

	
	public function getproductbyId($id) {
		$query = "SELECT * FROM tbl_product where productId = '$id'";
		$result = $this->db->select($query);
		return $result;
	}
	public function update_product($data, $file, $id){
	    $productName = mysqli_real_escape_string($this->db->link, $data['productName']);//link là biến kết nối từ file databases.php
		$brand = mysqli_real_escape_string($this->db->link, $data['brand']);
		$category = mysqli_real_escape_string($this->db->link, $data['category']);
		$product_desc = mysqli_real_escape_string($this->db->link, $data['product_desc']);
		$price = mysqli_real_escape_string($this->db->link, $data['price']);
		$type = mysqli_real_escape_string($this->db->link,$data['type']);
		
		//kiểm tra hình ảnh và lấy hình ảnh cho vào folder uploads
		$permited = array('jpg', 'jpeg', 'png', 'gif');
		$file_name = $_FILES['image']['name'];
		$file_size = $_FILES['image']['size'];
		$file_temp = $_FILES['image']['tmp_name'];

		$div = explode('.', $file_name);
		$file_ext = strtolower(end($div));
		$unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;//random từ 0 tới 10 và nối đuôi với file ext
		$uploaded_image = "uploads/".$unique_image;

		if($productName==""|| $brand =="" || $category==""|| $product_desc=="" || $type="" || $price == "" ||  $file_name=""){
			$alert = "<span class='error'>Các Trường Không Được Để Trống!!!</span>";
			return $alert;
		}else {
			if(!empty($file_name)){
				//Nếu người dùng chọn ảnh
				if($file_size > 1048567){//1048567 10mb
					$alert ="<span class='error'>Hình Ảnh Không Được Quá 1GB</span>";
					return $alert;
				}else if(in_array($file_ext, $permited) === false){
					$alert ="<span class='success'>You can upload only:-".implode(',', $permited)."</span>";
					return $alert;
				}
				$query = "UPDATE tbl_product SET
				 productName = '$productName',
				 brandId = '$brand',
				 catId = '$category',
				 type='$type',
				price = '$price',
				image = '$unique_image',
				product_desc = '$product_desc'
				WHERE productId = '$id'";

			}else {
				if($file_size > 1048567){//1048567 10mb
					$alert ="<span class='error'>Hình Ảnh Không Được Quá 1GB</span>";
					return $alert;
				}else if(in_array($file_ext, $permited) === false){
					$alert ="<span class='success'>You can upload only:-".implode(',', $permited)."</span>";
					return $alert;
				}
				//Nếu người dùng không chọn ảnh
				$query = "UPDATE tbl_product SET
				productName = '$productName',
				brandId = '$brand',
				catId = '$category',
				price = '$price',
				type = '$type',
				product_desc = '$product_desc'
				WHERE productId = '$id'";

			}
			$result = $this->db->update($query); 
			if($result){
				$alert = "<span class='success'>Cập Nhật Thành Công Sản Phẩm!!!</span>";
				return $alert;
			}else {
				$alert = "<span class='error'>Cập Nhật Sản Phẩm Không Thành Công!!!</span>";
				return $alert;
			}
		}
	}
	public function show_slider_list(){
		$query = "SELECT * FROM tbl_slider ORDER BY sliderId";
		$result = $this->db->select($query);
		return $result;
	}
	public function update_type_slider($id, $type){
		$type = mysqli_real_escape_string($this->db->link, $type);
		$query = "UPDATE tbl_slider SET type = '$type' WHERE sliderId = '$id'";
		$result = $this->db->update($query);
		return $result;
		
	}
	public function del_slider($id){
		$query = "DELETE FROM tbl_slider where sliderId ='$id'";
		$result = $this->db->delete($query);
		if($result){
			$alert = "<span class='success'>Slider Đã Xóa Thành Công!!!</span>";
			return $alert;
		}else {
			$alert = "<span class='error'> Slider Đã Xóa Không Thành Công!!!</span>";
			return $alert;
		}
	}
	public function del_product($id){
		$query = "DELETE FROM tbl_product where productId ='$id'";
		$result = $this->db->delete($query);
		if($result){
			$alert = "<span class='success'>Sản Phẩm Đã Xóa Thành Công</span>";
			return $alert;
		}else {
			$alert = "<span class='error'> Xóa Không Thành Công</span>";
			return $alert;
		}
	}
	//END BACKEND
	// START FRONTEND
	public function show_slider(){
		$query = "SELECT * FROM tbl_slider WHERE type = '1' ORDER BY sliderId";
		$result = $this->db->select($query);
		return $result;
	}

	public function getproduct_feathered(){
		$query = "SELECT * FROM tbl_product where type = '1'";
		$result = $this->db->select($query);
		return $result;
	}
	
	public function getproduct_new(){
		$sp_tungtrang = 4;
		if(!isset($_GET['trang'])){
			$trang = 1;
		}else {
			$trang = $_GET['trang'];
		}
		$tung_trang = ($trang-1)*$sp_tungtrang;
		$query = "SELECT * FROM tbl_product order by productId desc LIMIT $tung_trang,$sp_tungtrang";
		$result = $this->db->select($query);
		return $result;
	}

	public function get_all_product(){
		$query = "SELECT * FROM tbl_product";
		$result = $this->db->select($query);
		return $result;
	}

	public function get_details($id){
		$query = "SELECT tbl_product.*, tbl_category.catName, tbl_brand.brandName FROM tbl_product INNER JOIN tbl_category ON tbl_product.catId = tbl_category.catId INNER JOIN tbl_brand ON tbl_product.brandId = tbl_brand.brandId WHERE tbl_product.productId = '$id'";

		$result = $this ->db->select($query);
		return $result;
	}
	public function getLastestApsara(){
		$query = "SELECT * FROM tbl_product WHERE brandId ='1' ORDER BY productId desc LIMIT 1";
		$result = $this->db->select($query);
		return $result;
	}
	public function getLastestDAndG(){
		$query = "SELECT * FROM tbl_product WHERE brandId ='9' ORDER BY productId desc LIMIT 1";
		$result = $this->db->select($query);
		return $result;
	}
	public function getLastestHatesla(){
		$query = "SELECT * FROM tbl_product WHERE brandId ='3' ORDER BY productId desc LIMIT 1";
		$result = $this->db->select($query);
		return $result;
	}
	public function getLastestEnVang(){
		$query = "SELECT * FROM tbl_product WHERE brandId ='4' ORDER BY productId desc LIMIT 1";
		$result = $this->db->select($query);
		return $result;
	}
	//front end
	public function	get_compare($customer_id){
		$query = "SELECT * FROM tbl_compare WHERE customer_id ='$customer_id' ORDER BY id desc";
		$result = $this->db->select($query);
		return $result;
	}

	public function insertCompare($productid, $customer_id){
		$productid = mysqli_real_escape_string($this->db->link, $productid);//link là biến kết nối từ file databases.php
		$customer_id = mysqli_real_escape_string($this->db->link, $customer_id);

		$check_compare = "SELECT * FROM tbl_compare WHERE productId ='$productid' AND customer_id = '$customer_id'";
		$result_check_compare = $this->db->select($check_compare);
		if($result_check_compare){
			$msg = "<span class='error'>Sản Phẩm Đã Tồn Tại!!! Chọn Khác Để So Sánh!!</span>";
			return $msg;
		}else{
			$query = "SELECT * FROM tbl_product WHERE productId = '$productid'";
			$result = $this->db->select($query)->fetch_assoc();//truy van vao co so du lieu va lay du lieu ra
			$image = $result["image"];
			$productName = $result["productName"];
			$price = $result["price"];
			
			$query_insert = "INSERT INTO tbl_compare(productId,customer_id,productName,image,price) VALUES('$productid','$customer_id','$productName','$image','$price')";
			$insert_compare = $this->db->insert($query_insert); 
			if($insert_compare){
				$alert = "<span class='success'>Thêm Thành Công</span>";
				return $alert;
			}else {
				$alert = "<span class='error'>Thêm Thất Bại</span>";
				return $alert;
			}
		}
	}

	public function	get_wishlist($customer_id){
		$query = "SELECT * FROM tbl_wishlist WHERE customer_id ='$customer_id' ORDER BY id desc";
		$result = $this->db->select($query);
		return $result;
	}

	public function insertWishlist($productid, $customer_id){
		$productid = mysqli_real_escape_string($this->db->link, $productid);//link là biến kết nối từ file databases.php
		$customer_id = mysqli_real_escape_string($this->db->link, $customer_id);

		$check_wishlist = "SELECT * FROM tbl_wishlist WHERE productId ='$productid' AND customer_id = '$customer_id'";
		$result_check_wishlist = $this->db->select($check_wishlist);
		if($result_check_wishlist){
			$msg = "<span class='error'>Sản Phẩm Đã Tồn Tại!!!</span>";
			return $msg;
		}else{
			$query = "SELECT * FROM tbl_product WHERE productId = '$productid'";
			$result = $this->db->select($query)->fetch_assoc();//truy van vao co so du lieu va lay du lieu ra
			$image = $result["image"];
			$productName = $result["productName"];
			$price = $result["price"];
			
			$query_insert_wishlist = "INSERT INTO tbl_wishlist(productId,customer_id,productName,image,price) VALUES('$productid','$customer_id','$productName','$image','$price')";
			$insert_wishlist= $this->db->insert($query_insert_wishlist); 
			if($insert_wishlist){
				$alert = "<span class='success'>Thêm Thành Công!!</span>";
				return $alert;
			}else {
				$alert = "<span class='error'>Thêm Thất Bại!!</span>";
				return $alert;
			}
		}
	}
	public function del_wlist($customer_id,$proid){
		$query = "DELETE FROM tbl_wishlist WHERE productId ='$proid' AND customer_id ='$customer_id'";
		$result = $this->db->delete($query);
		return $result;
	}
	public function search_product($tukhoa){
		$tukhoa = $this->fm->validation($tukhoa);
		$query = "SELECT * FROM tbl_product WHERE productName LIKE '%$tukhoa%'";
		$result = $this->db->select($query);
		return $result;
	}	

}
