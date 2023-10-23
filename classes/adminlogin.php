<?php
	$file_name = realpath(dirname(__FILE__));
	include_once ($file_name.'/../lib/database.php');
	include_once ($file_name.'/../helpers/format.php');
	include_once ($file_name.'/../lib/session.php');
	Session::checkLogin();
?>


<?php
/**
 * 
 */
class adminLogin 
{
	private $db;
	private $fm;// format
	
	public function __construct()
	{
		$this->db = new Database();//truyen class Database từ databases.php sang biến db
		$this->fm = new Format();
	}
	public function login_admin($adminUser, $adminPass)
	{
		$adminUser = $this->fm->validation($adminUser);
		$adminPass = $this->fm->validation($adminPass);
 
		$adminUser = mysqli_real_escape_string($this->db->link, $adminUser);//link là biến kết nối từ file databases.php
		$adminPass = mysqli_real_escape_string($this->db->link, $adminPass);

		if(empty($adminUser) || empty($adminPass)){
			$alert = "User Và Pass Không Được Để Trống";
			return $alert;
		}else 
		{
			$query = "SELECT * FROM tbl_admin WHERE adminUser = '$adminUser' AND adminPass = '$adminPass' ";
			$result = $this->db->select($query); // câu lệnh thực thi chọn

			if ($result != false) {

				$value = $result->fetch_assoc();

				Session::set('adminlogin', true);

				Session::set('adminId', $value['adminId']);
				Session::set('adminUser', $value['adminUser']);
				Session::set('adminName', $value['adminName']);
				header("Location:index.php");
			} 
			else
			{
				$alert = "User Hoặc Pass Không Đúng";
				return $alert;
			}

		}
	}
}

?>