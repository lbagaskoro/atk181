<?php  

    include_once "../fungsi/koneksi.php";

    if(isset($_POST['simpan'])) {
        $username = $_POST['username'];
        $password = md5($_POST['password']);
        $level = $_POST['level'];
        $manajer = $_POST['manajer'];
        $unit = $_POST['unit'];

        $query = mysqli_query($koneksi, "INSERT INTO user VALUES ('', '$username', '$password', '$level','$manajer','$unit') ");        
        if ($query) {
            header("location:index.php?p=user");
        } else {
            echo 'gagal : ' . mysqli_error($koneksi);
        }
    }


?>

<section class="content">
    <div class="row">
        <div class="col-sm-12 col-xs-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="text-center">Tambah Data User</h3>
                </div>
                <form method="post"  action="" class="form-horizontal">
                    <div class="box-body">
                        <div class="form-group ">
                            <label for="username" class="col-sm-offset-1 col-sm-3 control-label">Username</label>
                            <div class="col-sm-4">
                                <input  required type="text"  class="form-control" name="username">
                            </div>
                        </div>
                        <div class="form-group ">
                            <label for="paswword"class="col-sm-offset-1 col-sm-3 control-label">Password</label>
                            <div class="col-sm-4">
                                <input required type="password" class="form-control" name="password">
                            </div>
                        </div>
                        <div class="form-group ">
                            <label for="manajer" class="col-sm-offset-1 col-sm-3 control-label">Manajer</label>
                            <div class="col-sm-4">
                                <input  required type="text"  class="form-control" name="manajer">
                            </div>
                        </div>
                        <div class="form-group ">
                            <label for="unit" class="col-sm-offset-1 col-sm-3 control-label">Unit</label>
                            <div class="col-sm-4">
                                <input  required type="text"  class="form-control" name="unit">
                            </div>
                        </div>                        
                        <div class="form-group">
                            <label id="tes"for="nama_brg" class="col-sm-offset-1 col-sm-3 control-label">Level</label>
                            <div class="col-sm-4">
                                <select required name="level" class="form-control">
                                    <option >--Pilih Level--</option>
                                    <option value="user">User</option>
                                    <option value="admin_gudang">Admin Gudang</option>
                                    <option value="admin_logistik">Admin Logistik</option>
                                </select>
                            </div>
                        </div>                         
                        <div class="form-group">
                            <input type="submit" name="simpan" class="btn btn-primary col-sm-offset-4 " value="Simpan" > 
                            &nbsp;
                            <input type="reset" class="btn btn-danger" value="Batal">                                                                              
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>


