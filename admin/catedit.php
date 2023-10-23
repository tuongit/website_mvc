<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/category.php'?>
<?php 
     $cat = new category();
    if(!isset($_GET['catid']) || $_GET['catid'] == NULL){
    	echo "<script>window.location= 'catlist.php' </script>";
    }else {
    	$id = $_GET['catid'];
    }
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
    	$catName = $_POST['catName'];
    	$updateCate = $cat -> update_category($catName, $id);
    }
   
?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Sửa Tên Danh Mục</h2>
                <div class="block copyblock"> 
                <?php
                    if(isset($updateCate))
                        echo $updateCate;
                ?>
                <?php
                	 $get_cat_name= $cat->getcatbyId($id);
                	 if($get_cat_name){
                	 	while($result = $get_cat_name -> fetch_assoc()) {
                ?>
               
                 <form action="" method="post">
                    <table class="form">					
                        <tr>
                            <td>
                                <input type="text" value ="<?php echo $result['catName']?>" name="catName" placeholder="Edit Category Name..." class="medium" />
                            </td>
                        </tr>
						<tr> 
                            <td>
                                <input type="submit" name="submit" Value="Update" />
                            </td>
                        </tr>
                    </table>
                    </form>
                    <?php
                    	}
                	 }
                    ?>
                </div>
            </div>
        </div>
<?php include 'inc/footer.php';?>