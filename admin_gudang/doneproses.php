<?php  

include "../fungsi/koneksi.php";

if(isset($_POST['update'])) {
	$id = $_POST['id_permintaan'];	
	
	$query = mysqli_query($koneksi, "UPDATE permintaan SET ket=1 WHERE id_permintaan='$id' ");
	
	if ($query) {
		header("location:index.php?p=user");
	} else {
		echo 'error' . mysqli_error($koneksi);
	}

}



?>