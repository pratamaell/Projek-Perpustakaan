<div class="col-md-3">

            <!-- Profile Image -->
            <div class="card card-primary card-outline">
              <div class="card-body box-profile">
                <div class="text-center">
                  <img class=" img-fluid"
                       src="<?= base_url('foto/' .$anggota['foto']) ?>"
                       width="250px">
                </div>
              </div>
              <!-- /.card-body -->
            </div>
</div>
<div class="col-md-9">
            <div class="card card-outline card-primary">
              <div class="card-header">
                <h3 class="card-title">data <?= $judul ?></h3>
                <div class="card-tools">
                  <a href="<?= base_url('DashboardAnggota/EditProfil')?>" class="btn btn-primary btn-flat btn-sm">
                    <i class="fas fa-edit"></i>Edit Profile
                  </a>
                </div>
                </div>
                <div class="card-body">

                <table class="table">
                    <tr>
                        <th width="200px">Id</th>
                        <th width="200px">:</th>
                        <td><?= $anggota['id'] ?></td>
                    </tr>
                    <tr>
                        <th>Nama</th>
                        <th>:</th>
                        <td><?= $anggota['nama'] ?></td>
                    </tr>
                    <tr>
                        <th>Username</th>
                        <th>:</th>
                        <td><?= $anggota['username'] ?></td>
                    </tr>
                    <tr>
                        <th>Jenis Kelamin</th>
                        <th>:</th>
                        <td><?= $anggota['jk'] ?></td>
                    </tr>
                    <tr>
                        <th>No Telpon</th>
                        <th>:</th>
                        <td><?= $anggota['telp'] ?></td>
                    </tr>
                    <tr>
                        <th>Alamat</th>
                        <th>:</th>
                        <td><?= $anggota['alamat'] ?></td>
                    </tr>
                </table>

                </div>

    </div>
</div>

    </div>
</div>