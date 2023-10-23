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
class customer 
{
	private $db;
	private $fm;// format
	
	public function __construct()
	{
		$this->db = new Database();//truyen class Database từ databases.php sang biến db
		$this->fm = new Format();
	}
	public function insert_customers($data){
		$name = mysqli_real_escape_string($this->db->link, $data['name']);//link là biến kết nối từ file databases.php
		$country = mysqli_real_escape_string($this->db->link, $data['country']);
		$email = mysqli_real_escape_string($this->db->link, $data['email']);
		$phone = mysqli_real_escape_string($this->db->link, $data['phone']);
		$zipcode = mysqli_real_escape_string($this->db->link, $data['zipcode']);
		$password = mysqli_real_escape_string($this->db->link, md5($data['password']));
		$address = mysqli_real_escape_string($this->db->link, $data['address']);
		$city = mysqli_real_escape_string($this->db->link, $data['city']);
		if($name =="" || $country == "" || $email == "" || $phone == "" || $zipcode == "" || $password == "" || $address == "" || $city == ""){
			$alert = "<span class='error'>Các trường không được để trống!!!</span>";
			return $alert;
		}else {
			$check_email = " SELECT * FROM  tbl_customer WHERE email='$email' LIMIT 1";
			$result_check = $this ->db->select($check_email);
			if($result_check){
				$alert = "<span class='error'>Email đã tồn tại!!!Làm ơn nhập email khác!!!</span>";
			return $alert;
			}else {
				$query = "INSERT INTO tbl_customer(name, city, country, email, phone, zipcode, password, address) VALUES ('$name', '$city', '$country', '$email', '$phone', '$zipcode', '$password', '$address')";
				$result = $this -> db->insert($query);
				if($result){
					$alert = "<span class='success'>Thêm thành công</span>";
					return $alert;
				}else{
					$alert = "<span class='success'>Thêm thất bại</span>";
					return $alert;
				}
			}
		}
		
	}
	public function login_customers($data){
		$password = mysqli_real_escape_string($this->db->link, md5($data['password']));
		$email = mysqli_real_escape_string($this->db->link, $data['email']);
		if( $password == "" || $email == ""){
			$alert = "<span class='error'>Các trường không được để trống!!!</span>";
			return $alert;
		}else {
			$check_login = " SELECT * FROM  tbl_customer WHERE email='$email' AND password = '$password' LIMIT 1";
			$result_check = $this ->db->select($check_login);
			if($result_check != false){
				$value = $result_check -> fetch_assoc();
				Session::set('customer_login',true);
				Session::set('customer_id', $value['customer_id']);
				Session::set('customer_name', $value['name']);
				echo '<script>window.location.href = "index.php";</script>';
			}else {
				$alert = "<span class='error'>Email Và Password không được trùng nhau!!!</span>";
				return $alert;
				}
			}
		}
	public function show_customers($id){
		$query = "SELECT * FROM tbl_customer WHERE customer_id = '$id'";
		$result = $this ->db->select($query);
		return $result;

	}

	public function show_order($order_code){
		$query = "SELECT * FROM tbl_order WHERE order_code = '$order_code'";
		$result = $this ->db->select($query);
		return $result;

	}

	public function show_all_customers($id){
		$query = "SELECT * FROM tbl_customer WHERE customer_id = '$id'";
		$result = $this ->db->select($query);
		return $result;

	}
	public function update_customers($data, $id){
		$name = mysqli_real_escape_string($this->db->link, $data['name']);//link là biến kết nối từ file databases.php
		$email = mysqli_real_escape_string($this->db->link, $data['email']);
		$phone = mysqli_real_escape_string($this->db->link, $data['phone']);
		$zipcode = mysqli_real_escape_string($this->db->link, $data['zipcode']);
		$address = mysqli_real_escape_string($this->db->link, $data['address']);
		
		if($name ==""  || $email == "" || $phone == "" || $zipcode == "" ||$address == "" ){
			$alert = "<span class='error'>Các trường không được để trống!!!</span>";
			return $alert;
		}else {
					 
				$query = "UPDATE  tbl_customer SET name ='$name', email='$email', phone='$phone', zipcode='$zipcode', address='$address' WHERE customer_id = '$id'";
				$result = $this -> db->update($query);
				if($result){
					$alert = "<span class='success'>Cập Nhật Thành Công</span>";
					return $alert;
				}else{
					$alert = "<span class='success'>Cập Nhật Không Thành Công</span>";
					return $alert;
				}
			
		}
	}
	// binh luan
	public function insert_comment(){
		$product_id = $_POST['productIdComment'];
		$nameUser= $_POST['nameUser'];
		$comment = $_POST['descriptionComment'];
		if($nameUser == '' && $comment == ''){
			$alert = "<span class='error'>Các trường không được để trống!!!</span>";
			return $alert;
		}else {
			$query = "INSERT INTO tbl_comment(nameUser, descriptionComment, productId) VALUES ('$nameUser', '$comment', '$product_id')";
				$result = $this -> db->insert($query);
				if($result){
					$alert = "<span class='error'>Bình Luận Đã Được Duyệt</span>";
					return $alert;
				}else{
					$alert = "<span class='error'>Bình Luận Sai!! Vui Lòng Nhập Lại Đầy Đủ</span>";
					return $alert;
				}
		}
	}
}

?>