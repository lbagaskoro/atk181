<?php  

	include "../fungsi/koneksi.php";

	if(isset($_GET['id']) && isset($_GET['tgl']) && isset($_GET['unit'])) {
		$id = $_GET['id'];
		$tgl = $_GET['tgl'];
		$unit = $_GET['unit'];
		$tanggal = date('Y-m-d');
		
$sql = "SELECT * FROM permintaan WHERE id_permintaan='$id'";
$result = mysqli_query($koneksi,$sql);
while($r = mysqli_fetch_array($result))
{
	$query1 =  
	"UPDATE permintaan SET status=1 WHERE id_permintaan='$id' ";
	$query2 = 
	"INSERT INTO pengeluaran (unit, kode_brg, jumlah, tgl_keluar)
	VALUES ('$r[unit]', '$r[kode_brg]', '$r[jumlah]', '$tanggal' ) ";	
	
	if(mysqli_query($koneksi, $query1)){
			mysqli_query($koneksi, $query2);
                header("location:index.php?p=detil&id=$id&unit=$unit&tgl=$tgl");
            } else {
                echo 'gagal';
			}
		}
}
?>	
