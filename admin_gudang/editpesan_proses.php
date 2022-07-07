<?php  
		
	include "../fungsi/koneksi.php";

	if (isset($_GET['id']) && isset($_GET['tgl']) && isset($_GET['unit'])) {
		$id = $_GET['id'];
		$tgl = $_GET['tgl'];
		$unit = $_GET['unit'];
		$tanggal = date('Y-m-d');
		$kode_brg = $_POST['kode_brg'];
		$tgl_pemesanan = $_POST['tgl_permintaan'];
		$jumlah = $_POST['jumlah'];
		
		$query = mysqli_query($koneksi, "UPDATE permintaan SET jumlah ='$jumlah' kode_brg='$kode_brg' WHERE id_permintaan='$id' ");

		if($query) {
			header("location:index.php?p=detil&id=$id&unit=$unit&tgl=$tgl");
		} else {
			echo 'gagal';
		}
		
	}

?>