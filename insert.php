<?php session_start();
	include 'config/config.php';
	$code=$_POST['code'];
	$trans = $_POST['trans'];
	$chek = mysqli_query($conn,"SELECT Code FROM products WHERE Code='$code'");
	if(mysqli_num_rows($chek)>0){
		$chek2= mysqli_query($conn,"SELECT Code FROM hive WHERE Code='$code'");
		if(mysqli_num_rows($chek2)>0){
			$sql1 = mysqli_query($conn,"UPDATE hive SET Quantity=Quantity+1 WHERE Code='$code'");
			if ($sql1) {
				//echo "data inserted";
			}else{
				echo "failed".mysqli_error($conn);
			}
		}else{
			$sql=mysqli_query($conn,"INSERT INTO hive (`Id`, `Code`, `Tno`,`Quantity`) VALUES (NULL, '$code', '$trans',1)");
			if ($sql) {
				//echo "data inserted";
			}else{
				echo "failed".mysqli_error($conn);
			}
		}
		
	}
?>