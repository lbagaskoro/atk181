<?php  

include "../fungsi/koneksi.php";

if(isset($_POST['update'])) {
	
	$kode_brg = $_POST['kode_brg'];
	$nama_brg = $_POST['nama_brg'];
	$id_jenis = $_POST['id_jenis'];
	$tgl_masuk = $_POST['tgl_masuk'];
	$satuan = $_POST['satuan'];
	$harga = $_POST['harga'];
	$stok = $_POST['jumlah'];
	$stokmasuk = $_POST['stokmasuk'];

	$stokbaru=$stokmasuk + $stok;

	$query = mysqli_query($koneksi, "UPDATE stokbarang SET nama_brg='$nama_brg', id_jenis='$id_jenis', tgl_masuk='$tgl_masuk', satuan='$satuan', harga='$harga', stok='$stokbaru', sisa=stok-keluar WHERE kode_brg ='$kode_brg' ");
	if ($query) {
		header("location:index.php?p=material");
	} else {
		echo 'error' . mysqli_error($koneksi);
	}

}



?>