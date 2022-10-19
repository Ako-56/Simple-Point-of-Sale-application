<?php include 'header.php' ?>
<?php
	function emptySession() {
		$_SESSION['name']='';
		$_SESSION['category']='';
		$_SESSION['code']='';
	}
	emptySession();
	
	if(isset($_POST['add'])){
		$name = $_POST['name'];
		$category = $_POST['category'];
		$code=$_POST['code'];
		$codex=$_POST['codex'];
		
		$chek = mysqli_query($conn,"SELECT * FROM products WHERE Code='$codex'");
		if(mysqli_num_rows($chek)>0){
			$Qry5=mysqli_query($conn,"UPDATE products SET ItemName='$name',Category='$category' WHERE Code='$codex'");
			if(!$Qry5){
				echo "failed" .mysqli_error($conn);
			}else{
				emptySession();
			}
		}else{
			$Qry1 = mysqli_query($conn,"INSERT INTO products(Code,ItemName,Category) VALUES ('$code','$name','$category')");
			if(!$Qry1){
				echo "failed" .mysqli_error($conn);
			}else{
				emptySession();
			}
		}
	}
	
	if(isset($_POST['edit'])){
		$code = $_POST['edit'];
		
		$Qry4 = mysqli_query($conn,"SELECT * FROM products WHERE Code='$code'");
		$row = mysqli_fetch_assoc($Qry4);
		$name = $row['ItemName'];
		$category = $row['Category'];
		$code = $row['Code'];
		
		$_SESSION['code'] = $code;
		$_SESSION['name'] = $name;
		$_SESSION['category'] = $category;
	}
	$name = $_SESSION['name'];
	$category = $_SESSION['category'];
	$code = $_SESSION['code'];
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
				<input type="hidden" name="codex" value="<?php echo $code ?>" >
				<label>Code.:</label>
				<input type="text" name="code" value="<?php echo $code ?>" required autocomplete="off">
				<label>Item Name.:</label>
				<input type="text" name="name" value="<?php echo $name; ?>" autocomplete="off" required>
				<label>Item Category.:</label>
				<select name="category" required>
					<option value="">Select Category</option>
					<?php
						$Qry3 = mysqli_query($conn,"SELECT * FROM itemcategory");
						while($row = mysqli_fetch_assoc($Qry3)){
							?>
							<option value="<?php echo $row['Id']; ?>" <?php if($category==$row['Id']){?>selected<?php } ?>><?php echo $row['Category']; ?></option>
							<?php
						}
						?>
				</select>
				<label>&nbsp;</label><input type="submit" value="Save" name="add" >
			</form>
		</div>
		<div>
			<table class="table">
				<tr>
					<th>Code</th>
					<th>Name</th>
					<th></th>
				</tr>
				<?php 
					$Qry2= mysqli_query($conn,"SELECT Code,ItemName FROM products");
					if(mysqli_num_rows($Qry2)>0){
						while($row = mysqli_fetch_assoc($Qry2)){
							?>
							<form method="post">
								<tr>
									<td><?php echo $row['Code']; ?></td>
									<td><?php echo $row['ItemName']; ?></td>
									<td><input type="checkbox" name="edit" value="<?php echo $row['Code'];?>" onclick="submit()"></td>
								</tr>
							</form>
						<?php	
						}
					}else{
						?>
						<tr><td colspan="3">No data</td></tr>
						<?php
					}
				?>
				
			</table>
		</div>
	</div>
</body>
<?php include 'footer.php' ?>