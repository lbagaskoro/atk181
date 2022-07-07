<?php 

ob_start();

session_start();
  
  include "../fungsi/koneksi.php";
  include "../fungsi/fungsi.php";

  ob_start(); 
  $id  = isset($_GET['id']) ? $_GET['id'] : false;


  $unit = $_GET['unit'];
  $tgl= $_GET['tgl'];
    
?>
<!-- Setting CSS bagian header/ kop -->
<style type="text/css">
  table.page_header {width: 1020px; border: none; background-color: #DDDDFF; border-bottom: solid 1mm #AAAADD; padding: 2mm }
  table.page_footer {width: 1020px; border: none; background-color: #DDDDFF; border-top: solid 1mm #AAAADD; padding: 2mm}
  
 
</style>
<!-- Setting Margin header/ kop -->
  <!-- Setting CSS Tabel data yang akan ditampilkan -->
  <style type="text/css">
  .tabel2 {
    border-collapse: collapse;
    margin-left: 145px;
    
  }
  .tabel2 th, .tabel2 td {
      padding: 5px 5px;
      border: 1px solid #000;

  }

   table.isi {
    margin: 0 170px;

  }

  .isi td {
    padding: 15px 15px;
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
  <p align="center" style="font-weight: bold; font-size: 18px;"><u>BUKTI PENGELUARAN PERMINTAAN BARANG (BPP)</u></p>
  <br><br>
  <h4 style="color: black; text-align: center;">Pengeluaran Permintaan Barang dari Unit Pelayanan : <?= $unit; ?></h4>
  <div class="isi" style="margin: 0 auto;">
   <table class="tabel2">
    <thead>
      <tr>
        <td style="text-align: center; "><b>No.</b></td>        
        <td style="text-align: center; "><b>Kode Barang</b></td>
        <td style="text-align: center; "><b>Nama Barang</b></td>
		<td style="text-align: center; "><b>Satuan</b></td> 
        <td style="text-align: center; "><b>Jumlah</b></td>                                        
      </tr>
    </thead>
    <tbody>
      <?php

       
       $query = mysqli_query($koneksi, "SELECT permintaan.nama_tukang, permintaan.kode_brg, unit, nama_brg, jumlah, satuan, tgl_permintaan FROM permintaan INNER JOIN stokbarang ON permintaan.kode_brg = stokbarang.kode_brg  WHERE unit='$unit' AND  status=1 AND tgl_permintaan='$tgl' "); 
      $i   = 1;
      while($data=mysqli_fetch_array($query))
      {
      ?>
      <tr>
        <td style="text-align: center;"><?php echo $i; ?></td>             
        <td style="text-align: center;"><?php echo $data['kode_brg']; ?></td>
        <td style="text-align: center;"><?php echo $data['nama_brg']; ?></td>
		<td style="text-align: center;"><?php echo $data['satuan']; ?></td>  
        <td style="text-align: center;"><?php echo $data['jumlah']; ?></td>                            
      </tr>
    <?php
    $i++;
    }
    ?>
    </tbody>
  </table>
  <?php 

  $query2 = mysqli_query($koneksi, "SELECT permintaan.nama_tukang FROM permintaan WHERE unit='$unit' AND  status=1 AND tgl_permintaan='$tgl' ");  
  $data2 = mysqli_fetch_assoc($query2);

  ?>

  <p>Pada hari ini tanggal : <b> <?=  tanggal_indo($tgl); ?></b> telah dikeluarkan serta serah terima barang berupa seperti yang tersebut di atas.</p>
  <p> Yang mengambil barang ke Gudang : <?php echo $data2['nama_tukang']; ?></p>
  </div>
 
  <?php 

      $query2 = mysqli_query($koneksi, "SELECT * FROM user WHERE username='$unit' ");
      if ($query2){                
        $data = mysqli_fetch_assoc($query2);

      } else {
        echo 'gagal';
      }
   ?>

  <!-- Memanggil fungsi bawaan HTML2PDF -->
<?php
$content = ob_get_clean();

require __DIR__.'../../assets/vendor/autoload.php';

use Spipu\Html2Pdf\Html2Pdf;

$html2pdf = new Html2Pdf();
$html2pdf->writeHTML($content);
$html2pdf->output('bpp.pdf');
?>