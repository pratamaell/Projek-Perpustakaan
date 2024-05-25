<div class="col-md-12">
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title"><?=$judul?></h3>
            
        </div>
        <div class="card-body">
        <?php 
      
      $errors = session()->getFlashdata('errors');
      if (!empty ($errors)) { ?>
       <div class="alert alert-danger" role="alert">
        <h4>Periksa Entry Form</h4>
        <ul>
          <?php foreach ($errors as $key => $error) { ?>
            <li><?= esc($error) ?></li>
          <?php } ?>
        </ul>
       </div>
      <?php } ?>
      <?php
      if(session()->getFlashdata('pesan')){
        echo' <div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h5><i class="icon fas fa-check"></i>';
        echo session()->getFlashdata('pesan');
        echo '</h5></div>';
      }
      ?>
            <?php echo form_open_multipart('DashboardAnggota/UpdateProfile')?>
            <div class="row">
                <div class="col-sm-2">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label>Foto</label>
                            <img src="<?= base_url('foto/'. $anggota['foto'])?>" id="gambar_load" class="img-fluid" width="200px" height="200px">
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label>File Foto</label>
                            <input type="file" name="foto" class="form-control" id="preview_gambar" accept="image/*">
                        </div>
                    </div>
                </div>
                <div class="col-sm-10">
                    <div class="col-sm-12">
                        <div class="from-group">
                        <label>Nama</label>
                        <input class="form-control" name="nama" value="<?= $anggota['nama']?>" placeholder="Nama">
                        </div>
                    </div>
                    <div class="col-sm-12">
                      <div class="from-group">
                      <label>Jenis Kelamin</label><br>
                        <select name="jk" class="form-control"  value="<?= $anggota['jk']?>"><?= $anggota['jk']?>">
                       
                        <option value="laki-laki">laki-laki</option>
                        <option value="perempuan">perempuan</option>
                        </select>
                      </div>  
                    </div>
                    <div class="col-sm-12">
                        <div class="from-group">
                        <label>No telp</label>
                        <input class="form-control" name="telp" value="<?= $anggota['telp']?>" placeholder="Alamat">
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="from-group">
                        <label>Alamat</label>
                        <input class="form-control" name="alamat" value="<?= $anggota['alamat']?>" placeholder="Alamat">
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="from-group">
                        <label>Username</label>
                        <input class="form-control" name="username" value="<?= $anggota['username']?>" placeholder="Usename">
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="from-group">
                        <label>Password</label>
                        <input class="form-control" name="password" value="<?= $anggota['password']?>" placeholder="password">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary btn-flat mt-3">Simpan</button>
                    <a href="<?= base_url('DashboardAnggota')?>" class="btn btn-success btn-flat mt-3">Kembali</a>
                </div>
            </div>
            <?php echo form_close() ?>
        </div>
    </div>
</div>