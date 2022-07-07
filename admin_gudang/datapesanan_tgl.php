<?php  
    include "../fungsi/koneksi.php";
    include "../fungsi/fungsi.php";
	 if (isset($_GET['tgl'])) {
        $tgl = $_GET['tgl'];
    $query = mysqli_query($koneksi, "SELECT distinct unit, tgl_permintaan, id_permintaan FROM permintaan WHERE tgl_permintaan='$tgl' GROUP BY unit ");
	 }
?>

<!-- Main content -->
<section class="content">
<!-- Small boxes (Stat box) -->
    <div class="row">
        <div class="col-sm-12">
             <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="text-center">Data Permintaan ATK</h3>
                </div>                
                <a href="?p=datapesanan" style="margin:10px;" class="btn btn-success"><i class='fa fa-backward'>  Kembali</i></a>
                    <div class="table-responsive">
                        <table id="datapesanan" class="table text-center">
                            <thead  > 
                                <tr>
                                    <th>No</th> 
                                    <th>Nama Unit</th>
                                    <th>Tanggal Permintaan</th>
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
                                        <td> <?= $row['unit']; ?> </td>
                                        <td> <?= tanggal_indo($row['tgl_permintaan']); ?> </td>              
                                        <td>                                                                                                                                                                                                          
											<a href="?p=detil&id=<?= $row['id_permintaan'];?>&unit=<?= $row['unit'];?>&tgl=<?= $row['tgl_permintaan']; ?>"><span data-placement='top' data-toggle='tooltip' title='Detail Permintaan'><button class="btn btn-info">Detail</button></span></a>                  
                                        </td>                                                                                            
                            </tr>
                            <?php $no++; endwhile; }else {echo "<tr><td colspan=9>Belum ada permintaan atk hari ini</td></tr>";} ?>
                            </tbody>
                        </table>
                    </div>                  
                </div>
            </div>
        </div>
    </div>


</section>

    
