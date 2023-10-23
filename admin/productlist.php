<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include_once '../classes/category.php';?>
<?php include_once '../classes/brand.php';?>
<?php include_once '../classes/product.php';?>
<?php include_once '../helpers/format.php';?>
<?php
    $pd = new product();
  	$fm = new Format();
  	if(isset($_GET['productid'])){	
  		$id=$_GET['productid'];
  		$delproduct = $pd->del_product($id);
  	}
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Product List</h2>
        <div class="block">  
        	<?php
        		if(isset($delproduct))
        			echo $delproduct
        	?>
            <table class="data display datatable" id="example">
			<thead>
				<tr>
					<th>ID</th>
					<th>PRODUCT NAME</th>
					<th>PRICE</th>
					<th>IMAGE</th>
					<th>BRAND</th>
					<th>CATEGORY</th>
					<th>DESCRIPTION</th>
					<th>Type</th>
					<th>ACTION</th>
				</tr>
			</thead>
			<tbody>
				<?php 
					$show_product=$pd->show_product();
					if($show_product){
						$i = 0;
						while($result = $show_product->fetch_assoc()){
							$i++;
					
				?>
				<tr class="odd gradeX">
					<td><?php echo $i?></td>
					<td><?php echo $result['productName']?></td>
					<td><?php echo $result['price']?></td>
					<td><img src="uploads/<?php echo $result['image']?>" width="80" /></td>
					<td><?php echo $result['brandName']?></td>
					<td><?php echo $result['catName']?></td>
					<td><?php echo $fm->textShorten($result['product_desc'], 50)?></td>
					<td> <?php 
						if($result['type'] == 0)
							echo 'Non-Feathered';
						else
							echo 'Feathered'
					?> 
					</td>
					<td><a href="productedit.php?productid=<?php echo $result['productId']?>">Edit</a> || <a href="?productid=<?php echo $result['productId']?>">Delete</a></td>
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
