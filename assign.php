<?php include 'header.php' ?>
<?php 
	$_SESSION['lev']='';
	if(isset($_POST['levl'])){
		$lec = $_POST['levl'];
		
		$_SESSION['lev'] = $lec;
	}
	$PerSel = $_SESSION['lev'];
	
	if(isset($_POST['submit'])){
		$lec = $_POST['lec'];
		$gname = $_POST['mtux'];
		$gitem = $_POST['mtu'];
		$gnames = implode(',',$gname);
		$gitems = implode(',',$gitem);
		
		$chek = mysqli_query($conn,"SELECT User FROM user_rights WHERE User='$lec'");
		if(mysqli_num_rows($chek)>0){
			$add = mysqli_query($conn,"UPDATE user_rights SET  GNames=CONCAT(GNames,',$gnames'),GItems=CONCAT(GItems,',$gitems') ");
			if(!$add){
				echo "wacha smoke".mysqli_error($conn);
			}
		}else{
			$Qrye = mysqli_query($conn,"INSERT INTO user_rights(User,GNames,GItems) VALUES ('$lec','$gnames','$gitems')");
			if(!$Qrye){
				echo "failed" .mysqli_error($conn);
			}
		}
		
	}
?>
<head>
	<title>Assign</title>
	<style>
		.bio{
				display: grid;
			  grid-template-columns:40% 40%;
			  justify-content:center;
			  grid-gap: 5px;
			  padding: 1px;
			  margin:auto;
			}

			.bio > div {
			  background-color: rgba(255, 255, 255, 0.8);
			  
			  padding: 2px 0;
			  font-size: 20px;
			}
			table {
			  border-collapse: collapse;        
			  width: 100%;
			}
			th,
			td {
			  border: 1px solid #529432;
			}
			th {
			  color:black;
			}
	</style>
</head>
	<script>      
		if ( window.history.replaceState ) {
		  window.history.replaceState( null, null, window.location.href );
		}
	</script>
	<script language="JavaScript">
		function toggle(source) {
		checkboxes = document.getElementsByName('mtu[]');
		  for(var i=0, n=checkboxes.length;i<n;i++) {
			checkboxes[i].checked = source.checked;
		  }
		}
	</script>
	<script>
			function myFunction() {
			  var input, filter, table, tr, td, i, txtValue;
			  input = document.getElementById("myInput");
			  filter = input.value.toUpperCase();
			  table = document.getElementById("myTable");
			  tr = table.getElementsByTagName("tr");
			  for (i = 1; i < tr.length; i++) {
				td = tr[i].getElementsByTagName("td")[1];
				if (td) {
				  txtValue = td.textContent || td.innerText;
				  if (txtValue.toUpperCase().indexOf(filter) > -1) {
					tr[i].style.display = "";
				  } else {
					tr[i].style.display = "none";
				  }
				}       
			  }
			}
			</script>
			<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
			<script>
				$(function() {
				  $("li:has(li) > input[type='checkbox']").change(function() {
					$(this).siblings('ul').find("input[type='checkbox']").prop('checked', this.checked);
				  });
				  $("input[type='checkbox'] ~ ul input[type='checkbox']").change(function() {
					$(this).closest("li:has(li)").children("input[type='checkbox']").prop('checked', $(this).closest('ul').find("input[type='checkbox']").is(':checked'));
				  });
				});
			</script>
<body onload="closenav()">
	<div class="bio">
		<div>
			<dt class="ghed" style="background-color:#999900; font-size:15px;">
			<br></dt>
				<form method="post">
					<label>Level:</label>
					
					<select name="levl" required onchange="submit()">
						<option value="">Select Level</option>
						<?php
					$zote = array('1'=>'Admin','2'=>'Operator');
					foreach ($zote AS $id => $idval){
					?>
						<option value="<?php echo $id; ?>" <?php if($id==$PerSel){?>selected<?php } ?>><?php echo $idval ?></option>
					<?php } ?>
					</select>
				</form>
		</div>
		<div>
			<dt class="ghed" style="background-color:#999900; font-size:15px;">
			<br></dt>	
				<form method="post">
				<input type="hidden" name="lec" value="<?php echo $PerSel; ?>" required>
							<?php
							$grp = mysqli_query($conn,"SELECT * FROM menu_group");
							while($row = mysqli_fetch_assoc($grp)){
								?>
									<ul>
									  <li style="display: block;">
										<input type="checkbox" value="<?php echo $row['Id']?>" name="mtux[]" class="Checkbox" ><?php echo $row['Title'];?>
										<br>
										
										<ul>
										<?php
										$all = mysqli_query($conn,"SELECT * FROM menu WHERE Title={$row['Id']} ORDER BY Seqns");
										while($rows=mysqli_fetch_assoc($all)){
											?> 
										  <li style="display: block;">
											<input type="checkbox" value="<?php echo $rows['RefId']?>" name="mtu[]" class="Checkbox" ><?php echo $rows['Items'];?>
											<br>
										  </li>
										<?php } ?>
										</ul>

									  </li>
									</ul>
									<?php
							}
						  ?>
					<input type="submit" value="Assign Selected" name="submit" style="float:right;">
				</form>
				<div style="margin-bottom:50px;"><br><br></div>
		</div>
	</div>
</body>