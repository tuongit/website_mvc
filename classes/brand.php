<?php
	$file_name = realpath(dirname(__FILE__));
	include_once ($file_name.'/../lib/database.php');
	include_once ($file_name.'/../helpers/format.php');
	
?>


<?php
/**
 * 
 */
class brand 
{
	private $db;
	private $fm;// format
	
	public function __construct()
	{
		$this->db = new Database();//truyen class Database từ databases.php sang biến db
		$this->fm = new Format();
	}
	public function insert_brand($brandName)
	{
		$brandName = $this->fm->validation($brandName);
 
		$brandName = mysqli_real_escape_string($this->db->link, $brandName);//link là biến kết nối từ file databases.php
		

		if(empty($brandName)){
			$alert = "<span class='error'>Thêm Thương Hiệu Không Thành Công</span>";
			return $alert;
		}else 
		{
			$query = "INSERT INTO tbl_brand(brandName) VALUES('$brandName')";
			$result = $this->db->insert($query); 
			if($result){
				$alert = "<span class='success'>Thêm Thương Hiệu Thành Công</span>";
				return $alert;
			}else {
				$alert = "<span class='error'>Thêm Thương Hiệu Không Thành Công</span>";
				return $alert;
			}

		}
	}

	public function show_brand(){
		$query = "SELECT * FROM tbl_brand order by brandId desc";
		$result = $this ->db->select($query);
		return $result;
	
	}
	public function update_brand($brandName, $id){
	$brandName = $this->fm->validation($brandName);

	$brandName = mysqli_real_escape_string($this->db->link, $brandName);//link là biến kết nối từ file databases.php
	$id = mysqli_real_escape_string($this->db->link, $id);

	if(empty($brandName)){
		$alert = "<span class='error'>Thương Hiệu Không Được Để Trống</span>";
		return $alert;
	}else 
	{
		$query = "UPDATE tbl_brand SET brandName = '$brandName' WHERE brandId='$id'";
		$result = $this->db->update($query); 
		if($result){
			$alert = "<span class='success'>Cập Nhật Thương Hiệu Thành Công</span>";
			return $alert;
		}else {
			$alert = "<span class='error'>Cập Nhật Thương Hiệu Không Thành Công</span>";
			return $alert;
		}

	}
	}
	public function del_brand($id){
		$query = "DELETE FROM tbl_brand  where brandId ='$id'";
		$result = $this->db->delete($query);
		if($result){
			$alert = "<span class='success'>Thương Hiệu Xóa Thành Công</span>";
			return $alert;
		}else {
			$alert = "<span class='error'>Thương Hiệu Xóa Không Thành Công</span>";
			return $alert;
		}
	}
	public function getbrandbyId($id) {
		$query = "SELECT * FROM tbl_brand where brandId = '$id'";
		$result = $this->db->select($query);
		return $result;
	}

	public function get_name_by_brand($id){
		$query = "SELECT tbl_product.*, tbl_brand.brandName, tbl_brand.brandId 
		FROM tbl_product, tbl_brand
		 where tbl_product.brandId = tbl_brand.brandId AND tbl_product.brandId = '$id'";
		$result = $this ->db->select($query);
		return $result;
	}
	public function get_product_by_brand($id){
		$query = "SELECT * FROM tbl_product where brandId = '$id' order by brandId desc LIMIT 8";
		$result = $this ->db->select($query);
		return $result;
	}

}

?>