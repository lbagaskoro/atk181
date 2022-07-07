<?php  
    include "../fungsi/koneksi.php";
    include "../fungsi/fungsi.php";
    
    if (isset($_GET['tgl']) && isset($_GET['unit'])) {
        $tgl = $_GET['tgl'];
        $unit = $_GET['unit'];
        $query = mysqli_query($koneksi, "SELECT  permintaan.id_permintaan, permintaan.kode_brg, nama_brg, permintaan.id_jenis, jumlah, satuan, status, ket FROM permintaan INNER JOIN 
        stokbarang ON permintaan.kode_brg = stokbarang.kode_brg  WHERE tgl_permintaan='$tgl' AND unit='$unit' ");
               
    }

    
?>

<section class="content">
<!-- Small boxes (Stat box) -->
    <div class="row">
        <div class="col-sm-12">
             <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="text-center">Data Permintaan Unit Pelayanan <?php echo $unit; ?></h3>
                </div>                
                <div class="box-body">                   
                    <a href="?p=dptgl&tgl=<?= $tgl ?>" style="margin:10px;" class="btn btn-success"><i class='fa fa-backward'>  Kembali</i></a>
                    <div class="table-responsive">
                        <table class="table text-center">
                            <thead  > 
                                <tr>
                                    <th>No</th>
                                    <th>Kode Barang</th>                                                                                              
                                    <th>Nama Barang</th>
                                    <th>Jumlah</th>
                                    <th>Satuan</th>
                                    <th>Status</th>
                                    <th>Ket Admin</th>  
                                    <th>Aksi</th>                                                                     
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <?php 
                                        $no =1 ;
                                        if (mysqli_num_rows($query)) {
                                            while($row=mysqli_fetch_assoc($query)):

                                     ?>
                                        <td> <?= $no; ?> </td> 
                                        <td> <?= $row['kode_brg']; ?> </td>    
                                        <td> <?= $row['nama_brg']; ?> </td>    
                                        <td> <?= $row['jumlah']; ?> </td>    
                                        <td> <?= $row['satuan']; ?> </td>                                           
                                                                                                                    
                                        <td > <?php
                                                if ($row['status'] == 0){
                                                    echo '<span class=text-warning>Menunggu Persetujuan</span>';
                                                } elseif ($row['status'] == 1) {
                                                    echo '<span class=text-primary>Telah Disetujui</span>';
                                                } else {
                                                    echo '<span class=text-danger>Tidak Disetujui</span>';
                                                }
                                               ?> 
                                         </td>   <td > <?php
                                                if ($row['ket'] == 0){
                                                    echo '<span class=text-warning>Belum Diambil/Diberikan</span>';
                                                } elseif ($row['ket'] == 1) {
                                                    echo '<span class=text-primary>Telah Diberikan</span>';
                                                } else{
                                                    echo '<span class=text-danger>Tidak Disetujui</span>';
                                                }
                                               ?> 
                                         </td>  
                                         <td>
										 <?php
                                         if ($row['ket'] == 0){?>
                                          <a  href="setuju.php?id=<?= $row['id_permintaan']; ?>&unit=<?= $unit ?>&tgl=<?= $tgl ?>"><span data-placement='top' data-toggle='tooltip' title='Sudah Diambil/Diberikan ?'><button   class="btn btn-success">Done ?</button></span></a> 
                                          <a  href="hapuspesan.php?&tgl=<?= $tgl ?>&jumlah=<?= $row['jumlah']; ?>&aksi=hapus&id=<?=$row['id_permintaan']; ?>&kd_brg=<?= $row['kode_brg']; ?>&unit=<?= $unit; ?>"><span data-placement='top' data-toggle='tooltip' title='Hapus'><button   class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus ?')">Hapus</button></span></a>
                                          
<!--                                        <a  href="?p=editpesanan&idjenis=<?= $row['id_jenis'];?>&id=<?= $row['id_permintaan']; ?>&unit=<?= $unit ?>&tgl=<?= $tgl ?>"><span data-placement='top' data-toggle='tooltip' title='Edit'><button   class="btn btn-primary" >Edit</button></span></a>	-->									
                                          <?php
                                                } elseif ($row['ket'] == 1) {
                                                    echo '
													<button id="coba"  class="btn btn-success" disabled="disabled">Sukses</button></a>'?>
													<a  href="hapuspesan.php?&tgl=<?= $tgl ?>&jumlah=<?= $row['jumlah']; ?>&aksi=hapus&id=<?=$row['id_permintaan']; ?>&kd_brg=<?= $row['kode_brg']; ?>">
													<span data-placement='top' data-toggle='tooltip' title='Hapus'>
													<button   class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus ?')">
													Hapus
													</button>
													</span>
													</a>
													
                                                    <?php ;
                                                
												} elseif ($row['status'] == 2){
                                                    echo '<span class=text-danger>Tidak Disetujui</span>';
                                                }
										 ?>
										 <!--</td>
                                         <td>                                            
                                                
                                                    <a  href="hapuspesan.php?tgl=<?= $tgl; ?>&unit=<?= $unit; ?>&aksi=hapus&id=<?=$row['id']; ?>"><span data-placement='top' data-toggle='tooltip' title='Hapus'><button   class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus ?')">Hapus</button></span></a>            
                                                                                                                                                                                                                                                                             
                                        </td> -->
                            
                            
                            </tr>
                            
                            <?php $no++; endwhile; }else {echo "<tr><td colspan=9>Tidak ada permintaan atk.</td></tr>";} ?>

                            </tbody>
                        </table>
                    </div>                  
                </div>
            </div>
        </div>
    </div>
</section>

<script>
function myFunction() {
    var x = document.getElementById("Btn");
    x.disabled = true;
}
</script>