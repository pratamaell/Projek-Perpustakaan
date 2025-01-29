<!-- Main content -->
<section class="content">

<!-- Default box -->
<div class="card card-solid">
<?php 
    if(session()->getFlashdata('pesan')){
      echo '<div class="alert alert-success alert-dismissible">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              <h5><i class="icon fas fa-check"></i> Berhasil</h5>';
                          // echo $info;
      echo session()->getFlashdata('pesan');
      echo '</div>';
    }
  ?>

  <div class="container card-tools mt-3">
  <button type="button" class="btn btn-primary float-left" data-toggle="modal" data-target="#modal-lg">
          <i class="fas fa-plus"></i> Tambah Buku
      </button>
    </div>
  <div class="card-body pb-0">
  <div class="row">
   <?php foreach ($buku as $key => $value) {?>
      <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column">
        <div class="card bg-light d-flex flex-fill">
          <div class="card-header text-muted border-bottom-0">
            Buku <b><?= $value['nama']?></b>
          </div>
          <div class="card-body pt-0">
            <div class="row">
              <div class="col-7">
                <h2 class="lead"><b><?= $value['judul']?></b></h2>
                <p class="text-muted mb-3 text-sm"><b>Penulis / Penerbit : </b> <?= $value['nama']?> /<?= $value['nama']?> </p>
                
                <ul class="ml-4 fa-ul text-muted">
                  <li class="small"><span class="fa-li"><i class="fas fa-calendar-week"></i></span>Tahun: <?= $value['tahun']?></li>
                  <li class="small mt-2"><span class="fa-li"><i class="fas fa-book-open"></i></span> Jumlah Halaman : <?=$value['jumlah']?> hlm</li>
                </ul>
              </div>
              <div class="col-5 text-center">
                <img src="<?= base_url('buku/' . $value['foto_buku'])?>" alt="user-avatar" class="img-fluid">
              </div>
            </div>
          </div>
          <div class="card-footer">
            <div class="text-right">
              <a href="#" data-toggle="modal" data-target="#modal-danger<?= $value['id']?>" class="btn btn-sm bg-danger">
              <i class="fas fa-trash"></i>
              </a>
              <a href="#" data-toggle="modal" data-target="#modal-warning<?= $value['id']?>" class="btn btn-sm bg-warning">
              <i class="fas fa-edit"></i>
              </a>
              <a href="<?= base_url('Cbuku/DetailBuku/' . $value['id'])?>" class="btn btn-sm btn-success">
               Lihat Detail <i class="fas fa-arrow-right"></i>
              </a>
            </div>
          </div>
        </div>
      </div>
      <?php };?>
    </div>
  </div>
  <!-- /.card-body -->
  <div class="card-footer">
  <?php if (isset($pager)) : ?>
        <?= $pager->links('default', 'bootstrap_pagination') ?>
    <?php endif ?>
    <nav aria-label="Contacts Page Navigation">
      <ul class="pagination justify-content-center m-0">
        <li class="page-item active"><a class="page-link" href="<? base_url()?>">1</a></li>
        <li class="page-item"><a class="page-link" href="<? base_url('halaman-2')?>">2</a></li>
        <li class="page-item"><a class="page-link" href="#">3</a></li>
        <li class="page-item"><a class="page-link" href="#">4</a></li>
        <li class="page-item"><a class="page-link" href="#">5</a></li>
        <li class="page-item"><a class="page-link" href="#">6</a></li>
        <li class="page-item"><a class="page-link" href="#">7</a></li>
        <li class="page-item"><a class="page-link" href="#">8</a></li>
      </ul>
    </nav>
  </div>
  <!-- /.card-footer -->
</div>
<!-- /.card -->

</section>
<!-- /.content -->

<!-- Modal Add Buku -->
<div class="modal fade" id="modal-lg">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title"><?= $judul ?></h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <?php echo form_open_multipart(base_url('CBuku/TambahBuku'))?>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-4">
            <div class="card card-primary card-outline">
              <div class="card-body box-profile">
                <div class="text-center">
                  <img class="img-fluid" id="gambar_load" src="<?= base_url('buku/sampel.jpg')?>" alt="sampel buku" width="250px">
                </div>
                <div class="form-group">
                  <label for="">Cover Buku</label>
                  <input type="file" id="preview_gambar" name="foto" class="form-control"></input>
                  <button type="submit" class="mt-3 btn btn-primary btn-block"><i class="fas fa-camera"></i> Tambah Foto Buku</button>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-4">
           
            <div class="form-group">
              <label for="exampleInputEmail1">Judul Buku</label>
              <input type="text" name="post_judul" class="form-control" id="exampleInputEmail1" placeholder="judul buku">
            </div>
            <div class="form-group">
              <label for="exampleInputPassword1">Kategori Buku</label>
              <select class="form-control" name="post_kategori" id="">
                <option value="">Pilih Kategori</option>
                <?php foreach ($kategori as $key => $value) { ?>
                <option value="<?= $value['id']?>"><?= $value['nama']?></option>
                <?php }?>
              </select>
            </div>
            <div class="form-group">
              <label for="exampleInputPassword1">Penerbit</label>
              <select class="form-control" name="post_penerbit" id="">
                <option value="">Pilih Penerbit</option>
                <?php foreach ($penerbit as $key => $value) { ?>
                <option value="<?= $value['id']?>"><?= $value['nama']?></option>
                <?php }?>
              </select>
            </div>
            <div class="form-group">
              <label for="exampleInputPassword1">Penulis</label>
              <select class="form-control" name="post_penulis" id="">
                <option value="">Pilih Penulis</option>
                <?php foreach ($penulis as $key => $value) { ?>
                <option value="<?= $value['id']?>"><?= $value['nama']?></option>
                <?php }?>
              </select>
            </div>
          </div>
          <div class="col-md-4">        
            <div class="form-group">
              <label for="exampleInputPassword1">Tahun</label>
              <input type="text" name="post_qty" class="form-control" id="exampleInputPassword1" placeholder="Tahun">
            </div>
            <div class="form-group">
              <label for="exampleInputPassword1">Jumlah halaman</label>
              <input type="text" class="form-control" name="post_hlm" id="exampleInputPassword1" placeholder="jumlah halaman">
            </div>
            <div class="form-group">
              <label for="exampleInputPassword1">Rak</label>
              <input type="text" class="form-control" name="post_rak" id="exampleInputPassword1" placeholder="jumlah halaman">
            </div>
           
          </div>
        </div>  
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
      </div>
      <?php echo form_close() ?>
    </div>
  </div>
</div>

<!-- Modal hapus -->
<?php foreach ($buku as $key => $value) {?>
<div class="modal fade" id="modal-danger<?= $value['id']?>">
  <div class="modal-dialog">
    <div class="modal-content bg-danger">
      <?php echo form_open_multipart(base_url('CBuku/HapusBuku/' . $value['id']))?>
      <div class="modal-header">
        <h4 class="modal-title">Hapus Data Buku</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-4">
            <img width="150px" class="img-fluid ms-5" src="<?= base_url('buku/' . $value['foto_buku'])?>" alt="">
          </div>
          <div class="col-md-8"> 
            <p class="mt-5">Apakah anda yakin ingin menghapus buku <b><?= $value['judul']?></b>?</p>
          </div>
        </div>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-outline-light">Hapus</button>
      </div>
      <?php echo form_close()?>
    </div>
  </div>
</div>
<?php }?>

<!-- Modal edit -->
<?php foreach ($buku as $key => $value) {?>
<div class="modal fade" id="modal-warning<?= $value['id']?>">
  <div class="modal-dialog modal-xl">
    <div class="modal-content bg-white">
      <?php echo form_open_multipart(base_url('CBuku/EditBuku/' . $value['id']))?>
      <div class="modal-header">
        <h4 class="modal-title">Edit Data Buku</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-lg-4">
            <div class="card card-primary card-outline">
              <div class="card-body box-profile">
                <div class="text-center">
                  <img class="img-fluid" id="gambar_load" src="<?= base_url('buku/' . $value['foto_buku'])?>" alt="sampel buku" width="250px">
                </div>
                <div class="form-group text-center text-muted mt-3">
                  <i><label for="" class="tetx-center"><?= $value['judul']?></label></i>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-8">
            <div class="form-group">
              <label for="exampleInputEmail1">Judul Buku</label>
              <input type="text" name="post_judul" class="form-control" id="exampleInputEmail1" placeholder="judul buku" value="<?= $value['judul']?>">
            </div>
           
            <div class="form-group">
              <label for="exampleInputPassword1">Tahun</label>
              <input type="text" name="post_qty" class="form-control" id="exampleInputPassword1" placeholder="Tahun" value="<?= $value['tahun']?>">
            </div>
            <div class="form-group">
              <label for="exampleInputPassword1">Jumlah halaman</label>
              <input type="text" class="form-control" name="post_hlm" id="exampleInputPassword1" placeholder="jumlah halaman" value="<?= $value['jumlah']?>">
            </div>
            
            <div class="form-group">
              <label for="exampleInputPassword1">Penulis</label>
              <select class="form-control" name="post_penulis" id="">
                <option value="">Penulis</option>
                <?php foreach ($penulis as $key => $penulis_value) { ?>
                <option value="<?= $penulis_value['id']?>" <?= $penulis_value['id'] == $value['penulis_id'] ? 'selected' : '' ?>><?= $penulis_value['nama']?></option>
                <?php }?>
              </select>
            </div>
            <div class="form-group">
              <label for="exampleInputPassword1">Penerbit</label>
              <select class="form-control" name="post_penerbit" id="">
                <option value="">Penerbit</option>
                <?php foreach ($penerbit as $key => $penerbit_value) { ?>
                <option value="<?= $penerbit_value['id']?>" <?= $penerbit_value['id'] == $value['penerbit_id'] ? 'selected' : '' ?>><?= $penerbit_value['nama']?></option>
                <?php }?>
              </select>
            </div>
            <div class="form-group">
              <label for="exampleInputPassword1">Rak</label>
              <input type="text" class="form-control" name="post_rak" id="exampleInputPassword1" placeholder="rak" value="<?= $value['lokasi']?>">
            </div>
            <div class="form-group">
              <label for="exampleInputPassword1">Kategori Buku</label>
              <select class="form-control" name="post_kategori" id="">
                <option value=""><?= $value['nama']?></option>
                <?php foreach ($kategori as $key => $kategori_value) { ?>
                <option value="<?= $kategori_value['id']?>" <?= $kategori_value['id'] == $value['kategori_id'] ? 'selected' : '' ?>><?= $kategori_value['nama']?></option>
                <?php }?>
              </select>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-outline-success"  data-toggle="modal" data-target="#modal-hapus<?= $value['id']?>">Edit</button>
      </div>
      <?php echo form_close()?>
    </div>
  </div>
</div>
<?php } ?>
