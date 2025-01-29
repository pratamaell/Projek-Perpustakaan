


<div class="col-md-12">
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title"><?= $judul ?></h3>
        </div>

        <div class="card-body">
        <table class="table table-striped projects">
              <thead>
                  <tr>
                      <th style="width: 1%">
                          No
                      </th>
                      <th style="width: 20%">
                          Nama 
                      </th>
                      <th style="width: 30%">
                          Judul Buku
                      </th>
                      <th>
                            Keterlambatan
                      </th>
                      <th style="width: 18%" class="text-center">
                          Denda
                      </th>
                      <th style="width: 20%">
                      Validasi Pembayaran
                      </th>
                  </tr>
              </thead>
              <tbody>
              <?php $no = 1;
                 foreach ($tolak as $key => $value) { ?>
                  <tr>
                      <td>
                          <?= $no++?>
                      </td>
                      <td>
                          <a>
                              <?= $value['nama']?>
                          </a>
                          <br/>
                          
                      </td>
                      <td>
                      <ul class="list-inline">
    <li class="list-inline-item">
        <?php if (isset($value['foto_buku'])): ?>
            <img alt="Avatar" class="img-fluid" width="50px" src="<?= base_url('buku/' . $value['foto_buku']) ?>">
        <?php else: ?>
            <img alt="Avatar" class="img-fluid" width="50px" src="<?= base_url('buku/default.png') ?>">
        <?php endif; ?>
    </li>
    <li class="list-inline-item">
        <small class="text-small"><?= $value['judul'] ?? 'Unknown Title' ?></small> <br>
        <small class="text-small">Buku <b><?= $value['nama'] ?? 'Unknown Author' ?></b></small>
    </li>
    <li class="list-inline-item">
        <!-- Additional content can go here -->
    </li>
</ul>

                      </td>
                      <td class="project_progress text-center">
    <h7>
        <span class="badge badge-danger"><?= isset($value['keterlambatan']) ? $value['keterlambatan'] : '0' ?> Hari</span>
    </h7>
</td>

                      <td class="project-state">
                          <i><h6>Rp. 30.000</h6></i>
                      </td>
                      <td class="project-actions">
                        <a class="btn btn-outline-success btn-sm" href="<?= base_url('Admin/BukuDenda/' . $value['id']) ?>">
                            <i class="fas fa-book me-5"></i> Validasi Pengembalian
                        </a>
                    </td>
                  </tr>
                <?php } ?>
              </tbody>
          </table>
        </div>
    </div>
</div>