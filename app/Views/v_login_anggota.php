<div class="login-box">
<div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="<?= base_url('') ?>" class="h1">Login Anggota</a>
    </div>
    <div class="card-body">
      <form action="../../index3.html" method="post">
        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="NIS">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-6">
            <a class="btn btn-success" href="<?= base_url('Auth') ?>">Kembali</a>
          </div>
          <!-- /.col -->
          <div class="col-sm-6">
            <button type="submit" class="btn btn-primary btn-block">Login</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      
      <!-- /.social-auth-links -->

      
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>