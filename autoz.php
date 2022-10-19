<?php
	include 'config/config.php'; 
	
	function Insert_Query($conn,$table,$columns,$values){
		$Query = mysqli_query($conn,"INSERT INTO $table ($columns) VALUES ($values)");
		//echo $Query;exit;
		if(!$Query){
			echo $Query;// mysqli_error($conn);
		}
	} 
?>