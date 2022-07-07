<?php  
    include "../fungsi/koneksi.php";
    include "../fungsi/fungsi.php";
	$skrg = date("Y-m-d");
    $query = mysqli_query($koneksi, "SELECT distinct tgl_permintaan from permintaan");
?>

<!-- Main content -->
<section class="content">
<!-- Small boxes (Stat box) -->
    <div class="row">
        <div class="col-sm-12">
             <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="text-center">Data Permintaan ATK </h3>
                                
                </div>                
                
                    <div class="table-responsive">
                    <div class="col-sm-2"></div>
                        <table id="datapesanan" class="table text-center">
                            <thead  > 
                                <tr>
                                    <th>No</th> 
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
                                        <td> <?= tanggal_indo($row['tgl_permintaan']); ?> </td>                                        
                                        <td>
                                        <a href="?p=dptgl&tgl=<?= $row['tgl_permintaan']; ?>"><span data-placement='top' data-toggle='tooltip' title='Detail Permintaan'><button class="btn btn-info">Detail</button></span></a>                  
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

    <script>
    $(document).ready(function(){
        $('.tanggal').datepicker({
            format:"yyyy-mm-dd",
            autoclose:true
        });
    });
</script>
