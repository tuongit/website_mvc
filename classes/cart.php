<?php
	
	$file_name = realpath(dirname(__FILE__));
	include_once ($file_name.'/../lib/database.php');
	include_once ($file_name.'/../helpers/format.php');
	
?>


<?php


 class cart 
{
	private $db;
	private $fm;// format
	
	public function __construct()
	{
		$this->db = new Database();//truyen class Database từ databases.php sang biến db
		$this->fm = new Format();
	}
	public function add_to_cart($quantity,$id){

		$quantity = $this->fm->validation($quantity);
		$quantity = mysqli_real_escape_string($this->db->link, $quantity);//link là biến kết nối từ file databases.php
		$id = mysqli_real_escape_string($this->db->link, $id);//id của session id
		$sId = session_id();

		$query = "SELECT * FROM tbl_product WHERE productId = '$id'";
		$result = $this->db->select($query)->fetch_assoc();//truy van vao co so du lieu va lay du lieu ra
		$image = $result["image"];
		$productName = $result["productName"];
		$price = $result["price"];
		$query_insert = "INSERT INTO tbl_cart(productId,quantity,sId,productName,image,price) VALUES('$id','$quantity','$sId','$productName','$image','$price')";
		$insert_cart = $this->db->insert($query_insert); 
		if($insert_cart){
			echo '<script>window.location.href = "cart.php";</script>';
		}else {
			echo '<script>window.location.href = "404.php";</script>';
		}
	}
	public function get_product_cart() {
		$sId = session_id();
		$query = "SELECT * FROM tbl_cart WHERE sId = '$sId'";
		$result = $this->db->select($query);
		return $result;
	}
	public function update_quantity_cart($quantity, $cartId){
		// $quantity = $this->fm->validation($quantity);
		$quantity = mysqli_real_escape_string($this->db->link, $quantity);//link là biến kết nối từ file databases.php
		$cartId = mysqli_real_escape_string($this->db->link, $cartId);
		$query_update_quantity = "UPDATE tbl_cart SET quantity = '$quantity' WHERE cartId = '$cartId'";
		$result = $this->db->update($query_update_quantity); 
		if($result){
			$notice = "<span class='success'>Cập Nhật Số Lượng Thành Công</span>";
			return $notice;
		}else{
			$notice = "<span class='error'>Cập Nhật Số Lượng Không Thành Công</span>";
			return $notice;
		}
	}
	public function del_product_cart($cartid){
		$cartid = mysqli_real_escape_string($this->db->link, $cartid);
		$query = "DELETE FROM tbl_cart WHERE cartId = '$cartid'";
		$result = $this->db->delete($query);
		if($result){
			echo '<script>window.location.href = "cart.php";</script>';
			
		}else{
			$notice = "<span class='error'>DELETE NOT QUANTITY SUCCESS</span>";
			return $notice;
		}
	}
	//
	public function check_cart(){
		$sId = session_id();
		$query = "SELECT * FROM tbl_cart WHERE sId = '$sId'";
		$result = $this->db->select($query);
		return $result;
	}
	//
	public function check_order($customer_id){

		$sId = session_id();
		$query = "SELECT * FROM tbl_order WHERE customer_id = '$customer_id'";
		$result = $this->db->select($query);
		return $result;
	}
	//
	public function del_all_data_cart(){
		$sId = session_id();
		$query = "DELETE FROM tbl_cart WHERE sId = '$sId'";
		$result = $this->db->delete($query);
		return $result;
	}
	public function del_all_data_compare($customer_id){
		$sId = session_id();
		$query = "DELETE FROM tbl_compare WHERE customer_id = '$customer_id'";
		$result = $this->db->delete($query);
		return $result;
	}
	public function insertOrder($customer_id) {
		$sId = session_id();
		$query = "SELECT * FROM tbl_cart WHERE sId = '$sId'";
		$get_product = $this->db->select($query);
		$order_code = rand(0000,9999);
		//insert vào tbl_placed
		$query_placed = "INSERT INTO tbl_placed(customer_id, order_code, status) VALUES('$customer_id', '$order_code', '0')";
		$insert_placed = $this->db->insert($query_placed);

		if($get_product){
			while ($result = $get_product->fetch_assoc()) {
				$productId = $result['productId'];
				$productName = $result['productName'];
				$quantity = $result['quantity'];
				$price = $result['price'] * $quantity;
				$image = $result['image'];
				$customer_id = $customer_id;
				$query_order = "INSERT INTO tbl_order(order_code,productId,productName,quantity,price,image,customer_id) VALUES('$order_code','$productId', '$productName','$quantity','$price','$image','$customer_id')";
				$insert_order = $this->db->insert($query_order);
			}
		}

	}
	public function getAmountPrice($customer_id) {
		$query = "SELECT price FROM tbl_order where customer_id='$customer_id'";
		$get_price = $this->db->select($query);
		return $get_price;
	}

	public function get_cart_ordered($customer_id) {
		$query = "SELECT * FROM tbl_order where customer_id='$customer_id'";
		$get_price = $this->db->select($query);
		return $get_price;
	}

	public function get_inbox_cart_history($customer_id) {
		$query = "SELECT * FROM tbl_placed,tbl_customer WHERE tbl_placed.customer_id=tbl_customer.customer_id AND tbl_placed.customer_id=$customer_id ORDER BY date_created";
		$get_inbox_cart = $this->db->select($query);
		return $get_inbox_cart ;
	}

	//admin - get-inbox cart
	public function get_inbox_cart() {
		$query = "SELECT * FROM tbl_placed,tbl_customer WHERE tbl_placed.customer_id=tbl_customer.customer_id ORDER BY date_created";
		$get_inbox_cart = $this->db->select($query);
		return $get_inbox_cart ;
	}

	public function shifted($id){
		$id = mysqli_real_escape_string($this->db->link, $id);//id của session id
		
		$query = "UPDATE tbl_placed SET
					status = '1'
					WHERE order_code = '$id'";
		$result = $this->db->update($query);
		if($result){
			$msg = "<span class='success'>Cập Nhật Đơn Hàng Thành Công</span>";
			return $msg;
		}else {
			$msg = "<span class='error'>Cập Nhật Đơn Hàng Không Thành Công</span>";
			return $msg;
		}
	}
	//frontend đanhanhang
	public function confirm_received($id){
		$id = mysqli_real_escape_string($this->db->link, $id);//id của session id
		
		$query = "UPDATE tbl_placed SET
					status = '2'
					WHERE order_code = '$id'";
		$result = $this->db->update($query);
		if($result){
			$msg = "<span class='success'>Cập Nhật Đơn Hàng Thành Công</span>";
			return $msg;
		}else {
			$msg = "<span class='error'>Cập Nhật Đơn Hàng Không Thành Công</span>";
			return $msg;
		}
	}

	public function del_shifted($id){
		$id = mysqli_real_escape_string($this->db->link, $id);//id của session id
		
		$query = "DELETE FROM tbl_placed 
					WHERE order_code = '$id'";
		$result = $this->db->delete($query);
		if($result){
			$msg = "<span class='success'>Xóa Đơn Hàng Thành Công</span>";
			return $msg;
		}else {
			$msg = "<span class='error'>Xóa Đơn Hàng Không Thành Công</span>";
			return $msg;
		}
	}
	//frontend orderdetails
	public function shifted_confirm($id){
		$id = mysqli_real_escape_string($this->db->link, $id);//id của session id
		$query = "UPDATE tbl_order SET
					status = '2'
					WHERE customer_id = '$id'";
		$result = $this->db->update($query);
		return $result;
	}
}
?>
