<?php  

	include "../fungsi/koneksi.php";

	if (isset($_GET['id']) && isset($_GET['tgl']) && isset($_GET['unit'])) {
		$id = $_GET['id'];
		$tgl = $_GET['tgl'];
		$unit = $_GET['unit'];
		$tanggal = date('Y-m-d');
		
		$query1 = mysqli_query($koneksi, "UPDATE permintaan SET ket=1 WHERE id_permintaan='$id' ");

		if($query1) {
			header("location:index.php?p=detil&id=$id&unit=$unit&tgl=$tgl");
		} else {
			echo "ada yang salah" . mysqli_error($koneksi);
		}
	}


?>