<?php
	$file_name = realpath(dirname(__FILE__));
	include_once ($file_name.'/../lib/database.php');
	include_once ($file_name.'/../helpers/format.php');
	
?>


<?php
/**
 * 
 */
class category 
{
	private $db;
	private $fm;// format
	
	public function __construct()
	{
		$this->db = new Database();//truyen class Database từ databases.php sang biến db
		$this->fm = new Format();
	}
	public function insert_category($catName)
	{
		$catName = $this->fm->validation($catName);
 
		$catName = mysqli_real_escape_string($this->db->link, $catName);//link là biến kết nối từ file databases.php
		

		if(empty($catName)){
			$alert = "<span class='error'>Thêm Danh Mục Không Thành Công</span>";
			return $alert;
		}else 
		{
			$query = "INSERT INTO tbl_category(catName) VALUES('$catName')";
			$result = $this->db->insert($query); 
			if($result){
				$alert = "<span class='success'>Thêm Danh Mục Thành Công</span>";
				return $alert;
			}else {
				$alert = "<span class='error'>Thêm Danh Mục Không Thành Công</span>";
				return $alert;
			}

		}
	}

	public function show_category(){
		$query = "SELECT * FROM tbl_category order by catId desc";
		$result = $this ->db->select($query);
		return $result;
	
	}
	public function update_category($catName, $id){
	$catName = $this->fm->validation($catName);

	$catName = mysqli_real_escape_string($this->db->link, $catName);//link là biến kết nối từ file databases.php
	$id = mysqli_real_escape_string($this->db->link, $id);

	if(empty($catName)){
		$alert = "<span class='error'>Danh Mục Không Được Để Trống</span>";
		return $alert;
	}else 
	{
		$query = "UPDATE tbl_category SET catName = '$catName' WHERE catId='$id'";
		$result = $this->db->update($query); 
		if($result){
			$alert = "<span class='success'>Cập Nhật Danh Mục Thành Công</span>";
			return $alert;
		}else {
			$alert = "<span class='error'>Cập Nhật Không Danh Mục Thành Công</span>";
			return $alert;
		}

	}
	}
	public function del_category($id){
		$query = "DELETE FROM tbl_category  where catId ='$id'";
		$result = $this->db->delete($query);
		if($result){
			$alert = "<span class='success'>Xóa Danh Mục Thành Công</span>";
			return $alert;
		}else {
			$alert = "<span class='error'>Xóa Danh Mục Không Thành Công</span>";
			return $alert;
		}
	}
	public function getcatbyId($id) {
		$query = "SELECT * FROM tbl_category where catId = '$id'";
		$result = $this->db->select($query);
		return $result;
	}

	//frontend

	public function show_category_frontend(){
		$query = "SELECT * FROM tbl_category order by catId desc";
		$result = $this ->db->select($query);
		return $result;
	
	}
	public function get_product_by_cat($id){
		$query = "SELECT * FROM tbl_product where catId = '$id' order by catId desc LIMIT 8";
		$result = $this ->db->select($query);
		return $result;
	}
	public function get_name_by_cat($id){
		$query = "SELECT tbl_product.*, tbl_category.catName, tbl_category.catId 
		FROM tbl_product, tbl_category
		 where tbl_product.catId = tbl_category.catId AND tbl_product.catId = '$id'";
		$result = $this ->db->select($query);
		return $result;
	}
}

?>