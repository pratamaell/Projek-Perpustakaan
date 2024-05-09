

<div class="login-box">
<div class="card card-outline card-primary ">
    <div class="card-header text-center">
      <a href="<?= base_url('Auth') ?>" class="h2"><?= $judul ?></a>
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
     
    
    <?php echo form_open('Auth/Daftar')?>
    <div class="row">
    <div class="col-sm-6">
    <label>Nama</label>
        <div class="form-group mb-3">
          <input type="text" name="nama" class="form-control" value="<?= old('nama') ?>" placeholder="Nama">
        </div>
    </div>
    <div class="col-sm-6">
    <label>No Telp</label>
        <div class="form-group mb-3">
        <input type="text" name="telp" class="form-control" value="<?= old('telp') ?>" placeholder="No telepon">
        </div>
    </div>
    <div class="col-sm-6">
    <label>Jenis Kelamin</label><br>
    <select name="jk" class="form-control">
      <option value="laki-laki">laki-laki</option>
      <option value="perempuan">perempuan</option>
    </select>
    </div>
    
    <div class="col-sm-6">
    <label>Alamat</label>
        <div class="form-group mb-3">
        <input type="text" name="alamat" class="form-control" value="<?= old('alamat') ?>" placeholder="Alamat">
        </div>
    </div>
    <div class="col-sm-6">
    <label>Role</label><br>
    <select name="role" class="form-control">
      <option value="petugas">Petugas</option>
      <option value="anggota">Anggota</option>
    </select>
    </div>
    
    <div class="col-sm-6">
    <label>Email</label>
        <div class="form-group mb-3">
        <input type="text" name="email" class="form-control" value="<?= old('email') ?>" placeholder="Email">
        </div>
    </div>
    <div class="col-sm-6">
    <label>Username</label>
        <div class="form-group mb-3">
        <input type="text" name="username" class="form-control"value="<?= old('username') ?>" placeholder="username">
        </div>
    
    </div>
    <div class="col-sm-6">
    <label>Password</label>
        <div class="form-group mb-3">
          <input type="password" class="form-control" name="password" value="<?= old('password') ?>" placeholder="password">
        </div>
    </div>
    <div class="col-sm-12">
    <label>Masukkan ulang password</label>
        <div class="form-group mb-3">
          <input type="password" class="form-control" name="ulangi_password" value="<?= old('password') ?>"placeholder="password">
        </div>
     </div>
    

    </div>
        <div class="row">
          <div class="col-sm-6">
            <a class="btn btn-success btn-block " href="<?= base_url('Auth') ?>">Kembali</a>
          </div>
          <!-- /.col -->
          <div class="col-sm-6">
            <button type="submit" class="btn btn-primary btn-block">Daftar</button>
          </div>
          
          <!-- /.col -->
        </div>
      <?php echo form_close() ?>

      <div class="social-auth-links text-center mb-3">
        <p>- OR -</p>
        <a href="<?= base_url('Auth/LoginAnggota') ?>" class="btn btn-block btn-warning">
          <i class="fa fa-sign-in-alt"></i> Kembali Login
        </a>
      </div>
      <!-- /.social-auth-links -->

      
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>
