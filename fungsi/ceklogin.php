<?php
/*$hari=date('D');
if ($hari=='Mon')
	#($hari=='Tue')
	#($hari=='Wed')
	#($hari=='Fri')
	{	
*/	if (isset($_SESSION['login'])) {
		if ($_SESSION['level'] == "user") {
			header("location:unit_pelayanan/index.php");
		} else if ($_SESSION['level'] == "admin_gudang"){
			header("location:admin_gudang/index.php");
		} else if ($_SESSION['level'] == "admin_logistik"){
			header("location:asmen_gudang/index.php");
		} else {
			header("location:index.php");
		}
	}
/*}else if ($hari=='Thu'){
		if (isset($_SESSION['login'])) {
		if ($_SESSION['level'] == "user") {
			header("location:unit_pelayanan/index.php");
		} else if ($_SESSION['level'] == "admin_gudang"){
			header("location:admin_gudang/index.php");
		} else if ($_SESSION['level'] == "admin_logistik"){
			header("location:asmen_gudang/index.php");
		} else {
			header("location:index.php");
		}
	}
}else
	header("location:maintenance.php");
*/
?>