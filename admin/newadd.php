<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include_once '../classes/news.php';?>


<?php 
    $news = new news();
    //nếu dùng post và nhấn vào submit thì mới thêm tin 
    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
        $newTitle = $_POST['newTitle'];
        $newDes = $_POST['newDes'];
        $status = $_POST['status']; 
    	$insertNews = $news->insert_new($newTitle, $_FILES, $newDes, $status);
    }
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Thêm Tin Tức</h2>
        <div class="block">               
         <form action="newadd.php" method="post" enctype="multipart/form-data">
            <table class="form">
               <?php
               	if(isset($insertNews))
               	{
               		echo $insertNews;
               	}
               ?>
                <tr>
                    <td>
                        <label>Title</label>
                    </td>
                    <td>
                        <input type="text" name="newTitle" placeholder="Enter Title..." class="medium" />
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Upload Image</label>
                    </td>
                    <td>
                        <input type="file" name="image"/>
                    </td>
                </tr>
				 <tr>
                    <td style="vertical-align: top; padding-top: 9px;">
                        <label>Description</label>
                    </td>
                    <td>
                        <textarea name="newDes" class="tinymce"></textarea>
                    </td>
                </tr>
				<tr>
                    <td>
                        <label>Status</label>
                    </td>
                    <td>
                        
                         <select id="select" name="status">
                            <option>Select Status</option>
                            <option value="1">Feathered</option>
                            <option value="0">Non-Feathered</option>
                        </select>
                    </td>
                </tr>
				<tr>
                    <td></td>
                    <td>
                        <input type="submit" name="submit" Value="Save" />
                    </td>
                </tr>
            </table>
            </form>
        </div>
    </div>
</div>
<!-- Load TinyMCE -->
<script src="js/tiny-mce/jquery.tinymce.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function () {
        setupTinyMCE();
        setDatePicker('date-picker');
        $('input[type="checkbox"]').fancybutton();
        $('input[type="radio"]').fancybutton();
    });
</script>
<!-- Load TinyMCE -->
<?php include 'inc/footer.php';?>


