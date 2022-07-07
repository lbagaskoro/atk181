<?php  

	include "../fungsi/koneksi.php";
	if (isset($_GET['id']) && isset($_GET['tgl']) && isset($_GET['id_jenis']) && isset($_GET['unit']) && isset($_GET['unit'])) {		
		$id = $_GET['id'];
		$tgl = $_GET['tgl'];
		$id_jenis = $_GET['id_jenis'];
		$unit = $_GET['unit'];
		$tanggal = date('Y-m-d');
		$query = mysqli_query($koneksi, "SELECT permintaan.id_permintaan, permintaan.tgl_permintaan,permintaan.status, permintaan.kode_brg, unit, permintaan.jumlah, permintaan.id_jenis, stokbarang.nama_brg, stokbarang.stok FROM permintaan INNER JOIN stokbarang ON permintaan.kode_brg=stokbarang.kode_brg WHERE id_permintaan = $id, id_jenis = $id_jenis ");
		if (mysqli_num_rows($query)) {
			$row2=mysqli_fetch_assoc($query);
        }
    }
?>

<section class="content">
    <div class="row">
        <div class="col-sm-8 col-sm-offset-2 col-xs-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="text-center">Edit Data Permintaan Barang</h3>
                </div>
                 <a href="?p=detil&id=<?php echo $id?>&unit=<?php echo $unit?>&tgl=<?php echo $tgl?>" style="margin:10px;" class="btn btn-success"><i class='fa fa-backward'>  Kembali</i></a><form method="post"  action="editpesan_proses.php" class="form-horizontal">
                    <div class="box-body">
                    	<input type="hidden" name="id" value="<?= $row2['id_permintaan']; ?>">
                    	<input type="hidden" name="tgl_permintaan" value="<?= $row2['tgl_permintaan']; ?>">                    	
                        <div class="form-group ">
                            <label for="nama_brg" class="col-sm-offset-1 col-sm-3 control-label">Unit Pelayanan</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" value="<?= $row2['unit']; ?>" readonly name="unit">
                            </div>
                        </div>   <div class="form-group">
                            <label for="jenis_brg" class="col-sm-offset-1 col-sm-3 control-label">Jenis Barang</label>
                            <div class="col-sm-4">
                                <select id="jenis_brg" required="isikan dulu" class="form-control" name="id_jenis">
                                <option value="">--Pilih Jenis Barang--</option>
                                <?php  
                                    include "../fungsi/koneksi.php";
                                    $queryJenis = mysqli_query($koneksi, "select * from jenis_barang where id_jenis='$row2[id_jenis]'");
                                    if (mysqli_num_rows($queryJenis)) {
                                        while($row=mysqli_fetch_assoc($queryJenis)):
                                    ?>                                        
                                        <option value="<?= $row['id_jenis']; ?>"><?= $row['jenis_brg']; ?></option>
                                    <?php endwhile; } ?>                                      
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                          <label  for="nama_brg" class="col-sm-offset-1 col-sm-3 control-label">Nama Barang</label>
                          <div class="col-sm-4">
                                <select id="nama_brg" required="isikan dulu" class="form-control" name="kode_brg">
                                <option value="">--Pilih Nama Barang--</option>                                                              
                                </select>
                            </div>
                      </div> 
                      <div class="form-group">
                            <label for="stok" class="col-sm-3 control-label">Stok Tersedia</label>
                           
                           <div class="col-sm-2">
                             <input disabled value=" <?php echo $row2['stok'];?>" type="text" class="form-control" name="stok">
                            </div>                        
                        </div>                
                        <div class="form-group">
                            <label for="nama_brg" class="col-sm-offset-1 col-sm-3 control-label">Nama Barang</label>
                            
                            <div class="col-sm-4">
                            	<input class="form-control" type="text" name="nama_brg" value="<?= $row2['nama_brg']; ?>" readonly>
                                
                            </div>
                        </div>                                                                                                                                                                   
                         <div class="form-group">
                            <label for="jumlah" class="col-sm-offset-1 col-sm-3 control-label">Jumlah</label>
                            <div class="col-sm-2">
                                <input for="stok" type="number" value="<?= $row2['jumlah'] ?>"class="form-control" name="jumlah">
                            </div>
                        </div>                        
                        <div class="form-group">
                            <input type="submit" name="update" class="btn btn-primary col-sm-offset-4 " value="Update" > 
                            &nbsp;
                            <input type="reset" class="btn btn-danger" value="Batal">				                                                                              
                        </div>
                   </div>
                </form>
            </div>
        </div>
    </div>
</section>
<script>
    $(document).ready(function(){
        $("#jenis_brg").change(function(){
            var jenis = $(this).val();
            var dataString = 'jenis='+jenis;
            $.ajax({
                type:"POST",
                url:"getdata.php",
                data:dataString,
                success:function(html){
                    $("#nama_brg").html(html);                    
                }
            });
        });

        $("#nama_brg").change(function(){
            var kode = $(this).val();
            var dataString = 'kode='+kode;
            $.ajax({
                type:"POST",
                url:"getkode.php",
                data:dataString,
                success:function(html){
                    $("#stok").val(html);        
                }
            });
        });
				       
    });


	
	 function cek_stok(){
                var jumlah = $("#jumlah").val();                
                var kode_brg = $("#nama_brg").val();   
                $.ajax({
                    url: 'cekstok.php',
                    data:"jumlah="+jumlah+"&kode_brg="+kode_brg,
                    dataType:'json',
                }).success(function (data) {                                      
                                      
                   
                        if(data.hasil == 1){                            
                            $("#tes").submit(function(e){
                                e.preventDefault();
                                alert(data.pesan);
                            });
                        }
                        
                   

                });
            }

   function sendAjax() {
    setTimeout(
        function() {
            var jumlah = $("#jumlah").val();                
                var kode_brg = $("#nama_brg").val();   
                $.ajax({
                    url: 'cekstok.php',
                    data:"jumlah="+jumlah+"&kode_brg="+kode_brg,
                    dataType:'json',
                }).success(function (data) {                                      
                                      
                   
                        if(data.hasil == 1){                            
                            
                                alert(data.pesan);
                                $("#jumlah").val("");
                            
                        }
                        
                   

                });
        }, 1000);
}
</script>