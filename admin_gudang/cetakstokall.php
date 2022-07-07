<?PHP

ob_start();
session_start();
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
     position: absolute;
     bottom: 100px;
     right: 50px;
     
  }

  div.tengah {
     position: absolute;
     bottom: 100px;
     right: 330px;
     
  }

  div.kiri {
     position: absolute;
     bottom: 100px;
     left: 10px;     
  }

  </style>
  <table>
    <tr>
      <th rowspan="3"><img src="../gambar/bumn.png" style="width:100px;height:100px" /></th>
      <td align="center" style="width: 520px;"><font style="font-size:20px"><b>BTN Kantor Cabang Karawang</b></font><br />
        <br />
        <font style="font-size:20px"> Jl. Galuh Mas Raya, Sukaharja, Kec. Telukjamber Timur, Kabupaten Karawang, Jawa Barat (41361).</font><br />
      <font style="font-size:15px">Telp : (0267) 8411400| (0267) 8411500</font></td>
	  <th rowspan="3"><img src="../gambar/logo.png" style="width:100px;height:80px" /></th>
    </tr>
  </table>
  <hr>
  <p align="center" style="font-weight: bold; font-size: 18px;"><u>LAPORAN STOK BARANG (ALL)</u></p>
  <table class="tabel2">
    <thead>
      <tr>
        <td width="5%" style="text-align: center; "><b>No.</b></td>
		<td width="20%" style="text-align: center; "><b>Kode Barang</b></td>
        <td width="30%" style="text-align: center; "><b> Nama Barang</b></td>
        <td width="5%" style="text-align: center; "><b>Satuan</b></td>
        <td width="5%" style="text-align: center; "><b>Stok</b></td>
		<td width="5%" style="text-align: center; "><b>Keluar</b></td>
        <td width="5%" style="text-align: center; "><b>Sisa</b></td>
      </tr>
    </thead>
    <tbody>
      <?php

       include "../fungsi/koneksi.php";
       $query = mysqli_query($koneksi, "SELECT * from stokbarang  "); 
      $i   = 1;
      while($data=mysqli_fetch_array($query))
      {
      ?>
      <tr>
        <td style="text-align: center; width=15px;"><?php echo $i; ?></td>
		<td style="text-align: center; width=70px;"><?php echo $data['kode_brg']; ?></td>
        <td style="text-align: center; width=70px;"><?php echo $data['nama_brg']; ?></td>        
        <td style="text-align: center; width=120px;"><?php echo $data['satuan']; ?></td>
        <td style="text-align: center; width=120px;"><?php echo $data['stok']; ?></td>
		<td style="text-align: center; width=70px;"><?php echo $data['keluar']; ?></td> 
        <td style="text-align: center; width=50px;"><?php echo $data['sisa']; ?></td>                   
      </tr>
    <?php
    $i++;
    }
    ?>
    </tbody>
  </table>
  <div class="tengah">
    <p>Mengetahui :<br>Head Operation </p>
<br>
      <br>
      <br>
      <p><b><u>Bayu Noer Cahyo</u><br>
      NIP : 12025</b></p>
  </div>
   <div class="kanan">
      <p>Mengetahui :<br />
        GA Logistik</p>
      <br />
      <br />
      <br />
      <p><b><u>Guntur Maulana</u><br />
        NIP : 17173</b></p>
    </div>

  <!-- Memanggil fungsi bawaan HTML2PDF -->
<?php
$content = ob_get_clean();

require __DIR__.'../../assets/vendor/autoload.php';

use Spipu\Html2Pdf\Html2Pdf;

$html2pdf = new Html2Pdf();
$html2pdf->writeHTML($content);
$html2pdf->output('laporan_stok_all.pdf');
?>