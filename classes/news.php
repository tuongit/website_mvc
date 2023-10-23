<?php
	$file_name = realpath(dirname(__FILE__));
	include_once ($file_name.'/../lib/database.php');
	include_once ($file_name.'/../helpers/format.php');
	
?>


<?php
/**
 * 
 */
class news 
{
	private $db;
	private $fm;// format
	
	public function __construct()
	{
		$this->db = new Database();//truyen class Database từ databases.php sang biến db
		$this->fm = new Format();
	}
	public function insert_new($newTitle,$files, $newDes, $status)
	{
		$newTitle = $this->fm->validation($newTitle);
 		$newDes = $this->fm->validation($newDes);
 		$status = $this->fm->validation($status);
		$newTitle = mysqli_real_escape_string($this->db->link, $newTitle);//link là biến kết nối từ file databases.php
		$newDes = mysqli_real_escape_string($this->db->link, $newDes);
		$status = mysqli_real_escape_string($this->db->link, $status);
		//kiểm tra hình ảnh và lấy hình ảnh cho vào folder uploads
		$permited = array('jpg', 'jpeg', 'png', 'gif');
		$file_name = $_FILES['image']['name'];
		$file_size = $_FILES['image']['size'];
		$file_temp = $_FILES['image']['tmp_name'];

		$div = explode('.', $file_name);
		$file_ext = strtolower(end($div));
		$unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
		$uploaded_image = "uploads/".$unique_image;

		if(empty($newTitle)){
			$alert = "<span class='error'>Tiêu đề không được để trống!!!</span>";
			return $alert;
		}else 
		{
			move_uploaded_file($file_temp,$uploaded_image);
			$query = "INSERT INTO tbl_news(title, image, description, status) VALUES('$newTitle','$unique_image' ,'$newDes', '$status')";
			$result = $this->db->insert($query); 
			if($result){
				$alert = "<span class='success'>Thêm Tin Tức Thành Công</span>";
				return $alert;
			}else {
				$alert = "<span class='error'>Thêm Tin Tức Không Thành Công</span>";
				return $alert;
			}

		}
	}

	public function show_new(){
		$query = "SELECT * FROM tbl_news order by newId desc";
		$result = $this ->db->select($query);
		return $result;
	
	}
	public function update_new($newTitle,$newDes,$status, $newId, $file){
		$newTitle = $this->fm->validation($newTitle);
		$newDes = $this->fm->validation($newDes);
	 	$status = $this->fm->validation($status);
		$newTitle = mysqli_real_escape_string($this->db->link, $newTitle);//link là biến kết nối từ file databases.php
		$newDes = mysqli_real_escape_string($this->db->link, $newDes);
		$status = mysqli_real_escape_string($this->db->link, $status);
		$newId = mysqli_real_escape_string($this->db->link, $newId);

		//kiểm tra hình ảnh và lấy hình ảnh cho vào folder uploads
		$permited = array('jpg', 'jpeg', 'png', 'gif');
		$file_name = $_FILES['image']['name'];
		$file_size = $_FILES['image']['size'];
		$file_temp = $_FILES['image']['tmp_name'];

		$div = explode('.', $file_name);
		$file_ext = strtolower(end($div));
		$unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;//random từ 0 tới 10 và nối đuôi với file ext
		$uploaded_image = "uploads/".$unique_image;

	if(empty($newTitle)){
		$alert = "<span class='error'>Tiêu đề không được để trống!!!</span>";
		return $alert;
	}else{
		if(!empty($file_name)){
			if($file_size > 1048567){
				$alert ="<span class='error'>Kích Thước Ảnh Vượt Quá 1GB</span>";
				return $alert;
			}else if(in_array($file_ext, $permited) === false){
				$alert ="<span class='success'>Bạn chỉ tải được những file sau:-".implode(',', $permited)."</span>";
				return $alert;
			}
			$query = "UPDATE tbl_news SET title = '$newTitle', description ='$newDes', status = '$status', image = '$unique_image' WHERE newId='$newId'";
			
		}else {
			if($file_size > 1048567){//1048567 10mb
				$alert ="<span class='error'>Kích Thước Ảnh Vượt Quá 1GB</span>";
				return $alert;
			}else if(in_array($file_ext, $permited) === false){
				$alert ="<span class='success'>Bạn chỉ tải được những file sau:-".implode(',', $permited)."</span>";
				return $alert;
			}
			$query = "UPDATE tbl_news SET title = '$newTitle', description ='$newDes', status = '$status', image = '$unique_image' WHERE newId='$newId'";
		}	
		
		$result = $this->db->update($query);
		if($result){
			$alert = "<span class='success'>Cập Nhật Tin Thành Công</span>";
			return $alert;
		}else {
			$alert = "<span class='error'>Cập Nhật Tin Không Thành Công</span>";
			return $alert;
		}
		}
	}
	public function del_new($newId){
		$query = "DELETE FROM tbl_news  where newId ='$newId'";
		$result = $this->db->delete($query);
		if($result){
			$alert = "<span class='success'> Xóa Tin Thành Công</span>";
			return $alert;
		}else {
			$alert = "<span class='error'>Xóa Tin Không Thành Công</span>";
			return $alert;
		}
	}
	public function getnewbyId($newId) {
		$query = "SELECT * FROM tbl_news where newId = '$newId'";
		$result = $this->db->select($query);
		return $result;
	}

// 	//frontend

	public function show_new_frontend(){
		$query = "SELECT * FROM tbl_news order by newId desc";
		$result = $this ->db->select($query);
		return $result;
	
	}public function get_new(){
		$tt_tungtrang = 4;
		if(!isset($_GET['trang'])){
			$trang = 1;
		}else {
			$trang = $_GET['trang'];
		}
		$tung_trang = ($trang-1)*$tt_tungtrang;
		$query = "SELECT * FROM tbl_news order by newId desc LIMIT $tung_trang,$tt_tungtrang";
		$result = $this->db->select($query);
		return $result;
	}
	public function get_all_news(){
		$query = "SELECT * FROM tbl_news";
		$result = $this->db->select($query);
		return $result;
	}

// 	public function get_product_by_cat($id){
// 		$query = "SELECT * FROM tbl_product where catId = '$id' order by catId desc LIMIT 8";
// 		$result = $this ->db->select($query);
// 		return $result;
// 	}
// 	public function get_name_by_cat($id){
// 		$query = "SELECT tbl_product.*, tbl_category.catName, tbl_category.catId 
// 		FROM tbl_product, tbl_category
// 		 where tbl_product.catId = tbl_category.catId AND tbl_product.catId = '$id'";
// 		$result = $this ->db->select($query);
// 		return $result;
// 	}
// }
}
?>