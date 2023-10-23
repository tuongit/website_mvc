<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/news.php';?>
<?php include_once '../helpers/format.php';?>
<?php 
	$news = new news();
	$fm = new Format(); 
	if(isset($_GET['delNewid'])){
		$newId =$_GET['delNewid'];
		$delNew = $news->del_new($newId);
	}
?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>New List</h2>
               
                <div class="block">  
                 <?php 
						if(isset($delNew)) {
							echo $delNew;
						}
					?>      
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>Serial No.</th>
							<th>New Title</th>
							<th>Image</th>
							<th>Description</th>
							<th>Action</th>
						</tr>
					</thead>

					<tbody>
						<?php 
							$show_new = $news->show_new();
							if($show_new)
							{
								$i = 0;
								while($result = $show_new->fetch_assoc()){
									$i++;
						?>
									<tr class="odd gradeX">
										<td><?php echo $i?></td>
										<td><?php echo $result['title'] ?></td>
										<td><img src="uploads/<?php echo $result['image']?>" width="80" /></td>
										<td><?php echo $fm->textShorten($result['description'],50)?></td>
										<td><a href="newedit.php?newId=<?php echo $result['newId']?>">Edit</a> || <a onclick="return confirm('Are you want to delete?')" href="?delNewid=<?php echo $result['newId']?>">Delete</a></td>
									</tr>
							<?php
								}
							}
							?>
					</tbody>
				</table>
               </div>
            </div>
        </div>
<script type="text/javascript">
	$(document).ready(function () {
	    setupLeftMenu();

	    $('.datatable').dataTable();
	    setSidebarHeight();
	});
</script>
<?php include 'inc/footer.php';?>

