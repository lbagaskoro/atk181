<?php ob_start();
session_start();
	include "../fungsi/fungsi.php";

 ?>
<!-- Setting CSS bagian header/ kop -->
<style type="text/css">
  table.page_header {width: 1020px; border: none; background-color: #3C8DBC; color: #fff; border-bottom: solid 1mm #AAAADD; padding: 2mm }
  table.page_footer {width: 1020px; border: none; background-color: #3C8DBC; border-top: solid 1mm #AAAADD; padding: 2mm}
  h1 {color: #000033}
  h2 {color: #000055}
  h3 {color: #000077}
</style>
<!-- Setting Margin header/ kop -->
  <!-- Setting CSS Tabel data yang akan ditampilkan -->
  <style type="text/css">
  .tabel2 {
    border-collapse: collapse;
    margin-left: 20px;    
  }
  .tabel2 th, .tabel2 td {
      padding: 5px 5px;
      border: 1px solid #959595;
  }

   div.kanan {
     width:300px;
	 float:right;
     margin-left:250px;
     margin-top:-140px;
  }

  div.kiri {
	  width:300px;
	  float:left;
	  margin-left:20px;
	  display:inline;
  }
  
  </style>
  <table>
    <tr>
      <th rowspan="3"><img src="../gambar/bumn.png" style="width:100px;height:100px" /></th>
      <td align="center" style="width: 520px;"><p><font style="font-size:20px"><b> BTN Kantor Cabang Karawang</b></font><br />
        <br />
        <font style="font-size:15px"> Jl. Galuh Mas Raya, Sukaharja, Kec. Telukjamber Timur, Kabupaten Karawang, Jawa Barat (41361).</font><br />
        <font style="font-size:12px">Telp : (0267) 8411400| (0267) 8411500</font></p></td>
      <th rowspan="3"><img src="../gambar/logo.png" style="width:100px;height:80px" /></th>
    </tr>
  </table>
  <hr>
  <p align="center" style="font-weight: bold; font-size: 18px;"><u>LAPORAN PENGELUARAN BARANG</u></p>
  <table class="tabel2">
    <thead>
      <tr>
        <td style="text-align: center; "><b>No.</b></td>
		<td style="text-align: center; "><b>Tanggal Keluar</b></td>
        <td style="text-align: center; "><b>Unit Pelayanan</b></td>
        <td style="text-align: center; "><b>Kode Barang</b></td>
        <td style="text-align: center; "><b>Nama Barang</b></td>
		<td style="text-align: center; "><b>Satuan</b></td>
        <td style="text-align: center; "><b>Jumlah</b></td>
      </tr>
    </thead>
    <tbody>
      <?php

       include "../fungsi/koneksi.php";
       $query = mysqli_query($koneksi, "SELECT pengeluaran.kode_brg, unit, nama_brg, jumlah, satuan, tgl_keluar FROM pengeluaran INNER JOIN stokbarang ON pengeluaran.kode_brg = stokbarang.kode_brg  "); 
      $i   = 1;
      while($data=mysqli_fetch_array($query))
      {
      ?>
      <tr>
        <td style="text-align: center; width=15px;"><?php echo $i; ?></td>
		<td style="text-align: center; width=70px;"><?php echo tanggal_indo($data['tgl_keluar']); ?></td>
        <td style="text-align: center; width=70px;"><?php echo $data['unit']; ?></td>        
        <td style="text-align: center; width=120px;"><?php echo $data['kode_brg']; ?></td>
        <td style="text-align: center; width=120px;"><?php echo $data['nama_brg']; ?></td>
		<td style="text-align: center; width=70px;"><?php echo $data['satuan']; ?></td> 
        <td style="text-align: center; width=50px;"><?php echo $data['jumlah']; ?></td>                   
      </tr>
    <?php
    $i++;
    }
    ?>
    </tbody>
  </table>
  
  <div class="kiri">
 <p>Mengetahui :<br>
      GA Logistik</p>
      <br>
      <br>
      <br>
      <p><b><u><?=  $_SESSION['username']; ?></u><br />
      </b>
      </p>
  </div>

  <div class="kanan">
  		<p>Mengetahui :<br>
      Head Operation</p>
      <br>
      <br>
      <br>
      <p><b><u>Bayu Noer Cahyo</u><br />
NIP : 12025</b></p>
  </div>

<!-- Memanggil fungsi bawaan HTML2PDF -->
<?php
$content = ob_get_clean();

require __DIR__.'../../assets/vendor/autoload.php';

use Spipu\Html2Pdf\Html2Pdf;

$html2pdf = new Html2Pdf();
$html2pdf->writeHTML($content);
$html2pdf->output('laporan_pengeluaran_barang.pdf');
?>