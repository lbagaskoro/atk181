<?php  
    
    include "../fungsi/koneksi.php";

    if
		(
			isset($_GET['kd_brg']) &&
			isset($_GET['aksi']) && 
			isset($_GET['tgl']) && 
			isset($_GET['id']) && 
			isset($_GET['unit']) &&
			isset($_GET['jumlah'])
		)
		{
			$kd_brg = $_GET['kd_brg'];
			$aksi = $_GET['aksi'];
			$tgl = $_GET['tgl'];
			$id_permintaan = $_GET['id'];
			$jumlah = $_GET['jumlah'];

		  
$sql = "select * from stokbarang where kode_brg='$kd_brg'";
$result = mysqli_query($koneksi,$sql);
while($r = mysqli_fetch_array($result))
{
		$keluar= $r['keluar'] - 1;
		$sisa = $r['stok'] - $keluar;
		
		if ($aksi == 'hapus') {
		
            $query1 =  
			"DELETE FROM permintaan WHERE id_permintaan='$id_permintaan' ";	
			$query2 =  
			"UPDATE stokbarang SET keluar='$keluar', sisa='$sisa' WHERE kode_brg ='$kd_brg' ";
			
			if(mysqli_query($koneksi, $query1)){
			mysqli_query($koneksi, $query2);
                header("location:index.php?p=detil&id=$id_permintaan&unit=$unit&tgl=$tgl");
            } else {
                echo 'gagal';
			}
		}
}
		}
?>