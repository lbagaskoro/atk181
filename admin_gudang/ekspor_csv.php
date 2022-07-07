<?PHP

ob_start();
session_start();
	include "../fungsi/koneksi.php";
    include "../fungsi/fungsi.php";
	
// nama file
 $filename="data produk-".date('Ymd').".csv";

 //header info for browser
 header("Content-Type:text/x-csv"); 
    header('Content-Disposition: attachment; filename="' . $filename . '";');

    //menampilkan data sebagai array dari tabel produk
    $out=array();
 $sql=mysql_query("SELECT * FROM stokbarang");
 while($data=mysql_fetch_assoc($sql)) $out[]=$data;

 // create a file pointer connected to the output stream
 $fh = fopen( 'php://output', 'w' );
 $heading = false;
 if(!empty($out))
   foreach($out as $row) {
  if(!$heading) {
    //menampilkan nama kolom di baris pertama
    fputcsv($fh, array_keys($row));
    $heading = true;
  }
  // looping data dari database  
   fputcsv($fh, array_values($row));
   }
   fclose($fh);
?>