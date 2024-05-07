

<div class="login-box">
<div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="<?= base_url('Auth') ?>" class="h2"><?= $judul ?></a>
    </div>
    <div class="card-body">
    
    <?php echo form_open()?>
    <div class="row">
    <div class="col-sm-6">
    <label>Nama</label>
        <div class="form-group mb-3">
          <input class="form-control" name="nama" placeholder="Nama">
        </div>
    </div>
    <div class="col-sm-6">
    <label>No Telp</label>
        <div class="form-group mb-3">
          <input class="form-control" name="telp" placeholder="no telp">
        </div>
    </div>
    <div class="col-sm-6">
    <label>Jenis Kelamin</label><br>
    <select name="jenis_kelamin" class="form-control">
      <option value="laki-laki">laki-laki</option>
      <option value="perempuan">perempuan</option>
    </select>
    </div>
    
    <div class="col-sm-6">
    <label>Alamat</label>
        <div class="form-group mb-3">
          <input class="form-control" name="alamat" placeholder="alamat">
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
          <input class="form-control"  name="email" placeholder="email">
        </div>
    </div>
    <div class="col-sm-6">
    <label>Username</label>
        <div class="form-group mb-3">
          <input class="form-control" name="username" placeholder="username">
        </div>
    
    </div>
    <div class="col-sm-6">
    <label>Password</label>
        <div class="form-group mb-3">
          <input type="password" class="form-control" name="password" placeholder="password">
        </div>
    </div>
    <div class="col-sm-12">
    <label>Masukkan ulang password</label>
        <div class="form-group mb-3">
          <input type="password" class="form-control" name="password" placeholder="password">
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