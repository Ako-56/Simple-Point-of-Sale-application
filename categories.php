<?php include 'header.php' ?>
<?php
	$_SESSION['cat']='';$_SESSION['id']='';
	if(isset($_POST['add'])){
		$category = $_POST['category'];
		$id = $_POST['id'];
		
		$chek = mysqli_query($conn,"SELECT Id FROM itemcategory WHERE Id='$id'");
		if(mysqli_num_rows($chek)>0){
			$Qry4 = mysqli_query($conn,"UPDATE itemcategory SET Category='$category' WHERE Id='$id'");
			if(!$Qry4){
				echo "failed" .mysqli_error($conn);
			}else{
				$category =''; $_SESSION['cat']='';
				$code = '';$_SESSION['id']='';
			}
		}else{
			$Qry1 = mysqli_query($conn,"INSERT INTO itemcategory(Category) VALUES ('$category')");
			if(!$Qry1){
				echo "failed" .mysqli_error($conn);
			}else{
				$category =''; $_SESSION['cat']='';
				$code = '';$_SESSION['id']='';
			}
		}
		
	}
	
	if(isset($_POST['edit'])){
		$id=$_POST['edit'];
		
		$Qry3 = mysqli_query($conn,"SELECT Id,Category FROM itemcategory WHERE Id = '$id'");
		$row = mysqli_fetch_assoc($Qry3);
		$cat = $row['Category'];
		$id = $row['Id'];
		$_SESSION['cat'] = $cat;
		$_SESSION['id'] = $id;
	}
	$category = $_SESSION['cat'];
	$code = $_SESSION['id'];
	
?>
<head>
	<style>
		.cont {
			  display: grid;
			  grid-template-columns:40% 50%;
			  grid-gap: 5px;
			  padding: 1px;
			  justify-content:center;
			  margin:auto;
			}

			.cont > div {
			  padding: 2px 0;
			  font-size: 20px;
			}
			.table{
				border-collapse:collapse;
				width:80%;
				margin:auto;
			}
			th,
			td {
			  border: 1px solid #529432;
			}
			th {
			  background: gray;
			}
	</style>
</head>
		
<body onload="closenav()">
	<div class="cont">
		<div>
			<form method="post">
				<input type="hidden" value="<?php echo $code ?>" name="id">
				<label>Category Name.:</label>
				<input type="text" name="category" value="<?php echo $category ?>" autocomplete="off" required><br>
				<label>&nbsp;</label><input type="submit" value="Save" name="add" >
			</form>
		</div>
		<div>
			<table class="table">
				<tr>
					<th align="left">Code</th>
					<th align="left">Name</th>
					<th></th>
				</tr>
				<?php 
					$Qry2= mysqli_query($conn,"SELECT Id,Category FROM itemcategory");
					if(mysqli_num_rows($Qry2)>0){
						while($row = mysqli_fetch_assoc($Qry2)){
							?>
							<form method="post">
								<tr>
									<td><?php echo $row['Id']; ?></td>
									<td><?php echo $row['Category']; ?></td>
									<td><input type="checkbox" name="edit" value="<?php echo $row['Id'];?>" onclick="submit()"></td>
								</tr>
							</form>
						<?php	
						}
					}else{
						?>
						<tr><td colspan="3"></td></tr>
						<?php
					}
				?>
				
			</table>
		</div>
	</div>
</body>
<?php include 'footer.php' ?>