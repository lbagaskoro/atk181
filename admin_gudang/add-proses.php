<?php  

	include "../fungsi/koneksi.php";

	if(isset($_POST['simpan'])) {

		$kode_brg = $_POST['kode_brg'];
		$id_jenis = $_POST['id_jenis'];
		$nama_brg = $_POST['nama_brg'];
		$stok = $_POST['jumlah'];
		$satuan = $_POST['satuan'];
		$harga = $_POST['harga'];
		$suplier = $_POST['suplier'];
		$tgl_masuk = $_POST['tgl_masuk'];		

		//die($stok);

		$query = "INSERT into stokbarang (kode_brg, id_jenis, nama_brg, stok, tgl_masuk, satuan, harga, sisa, suplier) VALUES 
										('$kode_brg', '$id_jenis', '$nama_brg', '$stok', '$tgl_masuk', '$satuan', '$harga', '$stok', '$suplier');

			";
		$hasil = mysqli_query($koneksi, $query);
		if ($hasil) {
			header("location:index.php?p=material");
		} else {
			die("ada kesalahan : " . mysqli_error($koneksi));
		}

	}

?>
		

		$stokupdate = $jumlah + $query['stok'];
		$keluar= $query['keluar'] - 1;
		$sisa = $stokupdate - $keluar;
	
        if ($aksi == 'hapus') {
		
/*            $query2 = mysqli_query($koneksi, "DELETE FROM permintaan WHERE id_permintaan='$id' ");*/	
			$query2 =  mysqli_query($koneksi, "UPDATE stokbarang SET stok='$stokupdate, keluar='$keluar', sisa='$sisa' WHERE kode_brg ='$kd_brg' ");
            if ($query2) {
                header("location:index.php?p=detil&id=$id&unit=$unit&tgl=$tgl");
            } else {
                echo 'gagal';
            }
        }
    }
