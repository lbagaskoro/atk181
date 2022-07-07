<?php  
    include "../fungsi/koneksi.php";
	include "../fungsi/fungsi.php";


    if (isset($_GET['aksi']) && isset($_GET['id'])) {
        //die($id = $_GET['id']);
        $id = $_GET['id'];
        echo $id;

        if ($_GET['aksi'] == 'edit') {
            header("location:?p=edit&id=$id");
        } else if ($_GET['aksi'] == 'hapus') {
            header("location:?p=hapus&id=$id");
        } 
    }
	
	if(isset($_GET['id_jenis'])){
        $id_jenis = $_GET['id_jenis'];
        $query = mysqli_query($koneksi, "SELECT * FROM permintaan WHERE id_jenis='$id_jenis' ");    
    } else {
        $query = mysqli_query($koneksi, "SELECT permintaan.id_permintaan, permintaan.kode_brg, tgl_permintaan, unit, nama_brg, jumlah, satuan,  status, ket FROM permintaan INNER JOIN stokbarang ON permintaan.kode_brg = stokbarang.kode_brg WHERE status=1 ORDER BY tgl_permintaan DESC");        
    }


$tgl = date('Y-m-d');
	
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=DataPermintaan $tgl.xls");
?>
  <? echo $tgl; ?>            	<div class="table-responsive">
                		<table class="table text-center" id="material">
                			<thead  > 
	                			<tr>
	                				  <th>No</th> 
									<th>Tanggal Permintaan</th>
                                    <th>Unit Pelayanan</th>                                                                
                                    <th>Nama Barang</th>
									<th>Satuan</th>
                                    <th>Jumlah</th>             				
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
                                        <td> <?= $row['unit']; ?> </td>          					
                						<td> <?= $row['nama_brg']; ?> </td>
										<td> <?= $row['satuan']; ?> </td>                                        
                                        <td> <?= $row['jumlah']; ?> </td>                                                   					
                				</tr>
                			<?php $no++; endwhile; } ?>
                			</tbody>
                		</table>
                	</div>                	
                </div>
            </div>
		</div>
	</div>
</section>
<script>
    $(function(){
        $("#material").DataTable({
             "language": {
            "url": "http://cdn.datatables.net/plug-ins/1.10.9/i18n/Indonesian.json",
            "sEmptyTable": "Tidak ada data di database"
            }
        });
    });
</script> 