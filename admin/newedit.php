<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/news.php'?>

<?php 
     $news = new news();
    if(!isset($_GET['newId']) || $_GET['newId'] == NULL){
    	echo "<script>window.location= 'newlist.php' </script>";
    }else {
    	$newId = $_GET['newId'];
    }
    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    	$newTitle = $_POST['newTitle'];
        $newDes = $_POST['newDes'];
        $status = $_POST['status']; 
    	$updateNew = $news -> update_new($newTitle,$newDes,$status, $newId, $_FILES);
    }
   
?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Sửa Tin Tức</h2>
                <div class="block copyblock"> 
                <?php
                    if(isset($updateNew))
                        echo $updateNew;
                ?>
                <?php
                	 $get_new_id= $news->getnewbyId($newId);
                	 if($get_new_id){
                	 	while($result_new = $get_new_id->fetch_assoc()) {
                ?>
                
                 <form action="" method="post" enctype="multipart/form-data">
                    <table class="form">					
                    <tr>
                        <td>
                            <label>Title</label>
                        </td>
                        <td>
                            <input type="text" name="newTitle" value="<?php echo $result_new['title']?> "class="medium"> </input>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Upload Image</label>
                        </td>
                        <td>
                            <input type="file" name="image"/><br/>
                            <img src="uploads/<?php echo $result_new['image']?>" width="80"/>
                        </td>
                    </tr>
                     <tr>
                        <td style="vertical-align: top; padding-top: 9px;">
                        <label>Description</label>
                        </td>
                        <td>
                            <textarea name="newDes" class="tinymce"><?php echo $result_new['description']?> </textarea>
                        </td>
                    </tr>
                     <tr>
                        <td>
                            <label>Status</label>
                        </td>
                        <td>
                            <select id="select" name="status">
                            <option>Select Status</option>
                            <?php 
                                if($result_new['status']== 0){
                            ?>
                            <option  value="1">Featured</option>
                            <option selected value="0">Non-Featured</option>
                            <?php
                            }else{
                            ?>
                            <option  selected value="1">Featured</option>
                            <option   value="0">Non-Featured</option>
                            <?php
                            }
                            ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <input type="submit" name="submit" value="Update" />
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