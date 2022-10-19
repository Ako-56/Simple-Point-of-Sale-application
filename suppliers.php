<div class="noprint">
	<?php include 'header.php' ?>
</div>
<?php
		
		 $name= ''; $_SESSION['name']='';
		 $address= ''; $_SESSION['address']='';
		 $phone= ''; $_SESSION['phone']='';
		 $rep= ''; $_SESSION['rep']='';
		 $code=''; $_SESSION['code']= '';
		 
	if(isset($_POST['add'])){
		$name = $_POST['name'];
		$address = $_POST['address'];
		$phone = $_POST['phone'];
		$rep = $_POST['rep'];
		$code = $_POST['id'];
		
		$chek = mysqli_query($conn,"SELECT Code FROM suppliers WHERE Code='$code'");
		if(mysqli_num_rows($chek)>0){
			$Qry4 = mysqli_query($conn,"UPDATE suppliers SET Name='$name',Address='$address',Phone='$phone',Representative='$rep' WHERE Code='$code'");
			if(!$Qry4){
				echo "failed" .mysqli_error($conn);
			}else{
				 $name= ''; $_SESSION['name']='';
				 $address= ''; $_SESSION['address']='';
				 $phone= ''; $_SESSION['phone']='';
				 $rep= ''; $_SESSION['rep']='';
				 $code=''; $_SESSION['code']= '';
			}
		}else{
			$Qry1 = mysqli_query($conn,"INSERT INTO suppliers(Name,Address,Phone,Representative) VALUES ('$name','$address','$phone','$rep')");
			if(!$Qry1){
				echo "failed" .mysqli_error($conn);
			}else{
				 $name= ''; $_SESSION['name']='';
				 $address= ''; $_SESSION['address']='';
				 $phone= ''; $_SESSION['phone']='';
				 $rep= ''; $_SESSION['rep']='';
				 $code=''; $_SESSION['code']= '';
			}
		}
		
	}
	
	if(isset($_POST['edit'])){
		$code=$_POST['edit'];
		
		$Qry3 = mysqli_query($conn,"SELECT * FROM suppliers WHERE Code = '$code'");
		$row = mysqli_fetch_assoc($Qry3);
		$name = $row['Name'];
		$address = $row['Address'];
		$phone = $row['Phone'];
		$rep = $row['Representative'];
		$code = $row['Code'];
		
		$_SESSION['name'] = $name;
		$_SESSION['address'] = $address;
		$_SESSION['phone'] = $phone;
		$_SESSION['rep'] = $rep;
		$_SESSION['code'] = $code;
	}
		 $name= $_SESSION['name'];
		 $address= $_SESSION['address'];
		 $phone= $_SESSION['phone'];
		 $rep= $_SESSION['rep'];
		 $code=$_SESSION['code'] ;
	
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
		<div class="noprint">
			<form method="post">
				<input type="hidden" value="<?php echo $code ?>" name="id">
				<label>Supplier Name.:</label>
				<input type="text" name="name" value="<?php echo $name ?>" autocomplete="off" required>
				<label>Address.:</label>
				<input type="text" name="address" value="<?php echo $address ?>" autocomplete="off" required>
				<label>Phone.:</label>
				<input type="number" name="phone" value="<?php echo $phone ?>" autocomplete="off" required>
				<label>Representative.:</label>
				<input type="text" name="rep" value="<?php echo $rep ?>" autocomplete="off">
 				<label>&nbsp;</label><input type="submit" value="Save" name="add" >
			</form>
		</div>
		<div class="x">
			<div class="noprint">
				<div class="date">
					<button onClick="javascript:print()"  class="print" >Print</button>
				</div>
			</div>
			<table class="table" style="margin-top:10px;">
				<tr>
					<th align="left">Name</th>
					<th align="left">Address</th>
					<th align="left">Phone</th>
					<th align="left">Representative</th>
					<th class="noprint"></th>
				</tr>
				<?php 
					$Qry2= mysqli_query($conn,"SELECT * FROM suppliers");
					if(mysqli_num_rows($Qry2)>0){
						while($row = mysqli_fetch_assoc($Qry2)){
							?>
							<form method="post">
								<tr>
									<td><?php echo $row['Name']; ?></td>
									<td><?php echo $row['Address']; ?></td>
									<td><?php echo $row['Phone']; ?></td>
									<td><?php echo $row['Representative']; ?></td>
									<td class="noprint"><input type="checkbox" name="edit" value="<?php echo $row['Code'];?>" onclick="submit()"></td>
								</tr>
							</form>
						<?php	
						}
					}else{
						?>
						<tr><td colspan="5">No supplier</td></tr>
						<?php
					}
				?>
				
			</table>
		</div>
	</div>
</body>
<?php include 'footer.php' ?>