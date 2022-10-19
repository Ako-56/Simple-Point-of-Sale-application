<div class="noprint">
<?php include 'header.php'; ?>
</div>

<?php
$_SESSION['ACCOUNT']='';
$_SESSION['date1']=''; 
$_SESSION['date2']=''; 
if(isset($_POST['search'])){

$depts="Alex";
$_SESSION['ACCOUNT']=$depts;

$date1 = date("Y-m-d", strtotime($_POST['date1']));
$date2 = date("Y-m-d", strtotime($_POST['date2']));

$_SESSION['date1']=$date1; 
$_SESSION['date2']=$date2;
} 
$depts=$_SESSION['ACCOUNT'];
$D1=$_SESSION['date1'];

 $D2=$_SESSION['date2'];
?>
<script>      
if ( window.history.replaceState ) {
  window.history.replaceState( null, null, window.location.href ); }
</script>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>CWA-Portal</title>
    <style type="text/css" media="print">
    @page 
    {
        size:  auto;   /* auto is the initial value */
        margin: 0mm;  /* this affects the margin in the printer settings */
		max-height: auto;
    }

    html
    {
        background-color: #FFFFFF; 
        margin: 30px;  /* this affects the margin on the html before sending to printer */
    }
   
    body
    {
        /*border: solid 1px blue ;*/
        margin: 0mm 0mm 0mm 0mm; /* margin you want for the content */
		max-height: auto;
    }
	
	@media print{
	   .noprint{
		   display:none;
	   }
	}
    </style>
	<style>
	body{
		overflow:auto;
	}
	
	#es{
		color:royalblue;
	}
	</style>
</head>
<body onLoad="closenav();">

<center>
<div class="noprint">
<table cellspacing="0" cellpadding="0" border="0" width="98%" align="center">
<tr bgcolor="#CCCC99">

<td width="35%" align="left">

<table border="0" width="100%" align="left" cellspacing="0">
<tr>
<td width="4%"><a href="index.php"><img src="images/clas.png" height="30" style="cursor:pointer;" ></a></td>
<td><a href="index.php" style="text-decoration:none;"><font color="#333333" size="4">Back</font></a></td>
</tr>
</table>

</td>

<td width="13%"  align="center"><input type="submit" onClick="javascript:print()"  value="Print" style="margin-left:40%;"></td>
</tr>
</table>



<form method="post" class="frm">

<b>From Date.:</b>
<input type="date" name="date1" style="background:#ABDD93;" value="<?php echo $D1; ?>"/>
&nbsp; <b>To.:</b>
<input type="date" value="<?php echo $D2; ?>"  name="date2" style="background:#ABDD93;"/>
<button class="btn btn-primary" name="search" style="background-color:#00CC33; color:white; height:25px; border-radius:4px;">Search</button>
</form>

</div>

<?php //$BNm=Business($conn); ?>
<table bgcolor="#FFFFFF" cellspacing="0" align="center" cellpadding="0" border="0" style='font-family: Arial, Helvetica, sans-serif; font-size:17px; color:#0000FF; font-weight:bold; border:none; width:600px;'>
<tr>
<td align="center">
<br><br>
<?php //echo $BNm; ?>
<hr>
PROFIT AND LOSS STATEMENT
</td>
</tr>
</table>

<table bgcolor="#FFFFFF" cellspacing="0" align="center" cellpadding="0" border="0" style='font-family: Arial, Helvetica, sans-serif; font-size:16px; width:600px' >

<tr>
<td colspan="3" height="30"><?php

echo 'FROM: '.$D1.' TO: '.$D2; ?></td>
</tr>

<tr bgcolor="#CCCC99">
<td valign="top"><b></b></td>
<td align="right"><b>Debit</b></td>
<td align="right"><b>Credit</b></td>
</tr>
<?php 
	$Qry = mysqli_query($conn,"SELECT SUM(Price*Quantity) AS Sold FROM sales");
	$row= mysqli_fetch_assoc($Qry);
	$Uzad = $row['Sold'];
?>
<tr>
<td valign="top">Sales:</td>
<td align="right"><b><?php echo number_format($Uzad,2); ?></b></td>
<td>&nbsp;</td>
</tr>
<?php 
	$Qry1 = mysqli_query($conn,"SELECT SUM(((SELECT Price FROM sales WHERE sales.TranNo=returnin.TranNo AND sales.Code=returnin.Code)*Pieces))Retuns FROM returnin");
	if(!$Qry1){
		echo mysqli_error($conn);
	}
	$row1= mysqli_fetch_assoc($Qry1);
	$Rudis = $row1['Retuns'] ;
?>
<tr>
<td valign="top">Less Return Inwards:</td>
<td align="right">&nbsp;</td>
<td><b><?php echo number_format($Rudis,2); ?></b></td>
</tr>

<?php $NtSale = $Uzad-$Rudis; ?>
<tr bgcolor="#CCCCCC">
<td valign="top"><b>Net Sales:</b></td>
<td>&nbsp;</td>
<td align="right"><b><?php echo number_format($NtSale,2); ?></b></td>
</tr>

<tr>
<td colspan="3" valign="top"><b>FUNDS:</b></td>
</tr>

<?php 
	//Closing stock = (Opening Stock + Inward)- Outward
	//Opening Stock = Sales – Gross Profit – Cost of Goods Sold + Closing Stock
	$Ostock = 0; ?>
<tr>
<td valign="top">Opening Stock:</td>
<td align="right"><?php  echo  number_format($Ostock,2); ?></td>
<td>&nbsp;</td>
</tr>

<?php
	$Qry2 = mysqli_query($conn,"SELECT SUM(Bprice*Quantity)AS Purchase FROM stocks");
	$row2 = mysqli_fetch_assoc($Qry2);
	$Purchase = $row2['Purchase'];
 ?>
<tr>
<td valign="top">Add Purchases:</td>
<td align="right">&nbsp;</td>
<td><b><?php echo number_format($Purchase,2); ?></b></td>
</tr>
<?php $cost = $Purchase+$Ostock; ?>
<tr bgcolor="#CCCCCC">
<td valign="top"><b>Total Cost:</b></td>
<td align="right"><b><?php echo number_format($cost,2); ?></b></td>
<td>&nbsp;</td>
</tr>

<?php $Cstock = $Purchase - $Uzad; ?>
<tr>
<td valign="top">Less Closing Stock:</td>
<td align="right"><b><?php echo  number_format($Cstock,2); ?></b></td>
<td>&nbsp;</td>
</tr>

<?php $Gprofit = $NtSale-$Purchase; ?>
<tr bgcolor="#CCCC99">
<td valign="top"><b>Gross Profit:</b></td>
<td>&nbsp;</td>
<td align="right"><b><?php echo $Gprofit ?></b></td>
</tr>


</table>
<div style="margin-bottom:50px"></div>
<div class="noprint">
<?php include 'footer.php';  ?>
</div>