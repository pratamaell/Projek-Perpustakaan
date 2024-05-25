<div class="col-md-12">
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title">Data <?= $judul ?></h3>
            <div class="card-tools">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-sm">
                    <i class="fas fa-plus"></i> Tambah Penulis
                </button>
            </div>

    </div>

        <div class="card-body">
           
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

            <table class="table table-bordered">
                <th>
                    <tr>
                        <th width="50px">No</th>
                        <th>Nama Penulis</th>
                        <th>Alamat</th>
                        <th>Website</th>
                        <th width="200px" class="text-center">Edit</th>
                    </tr>
                </th>
                <tbody>
                    <?php $no = 1;
                    foreach($penulis as $key => $value){?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $value['nama'] ?></td>
                            <td><?= $value['alamat'] ?></td>
                            <td><?= $value['website'] ?></td>
                            <td class="text-center">
                                <a class="btn btn-warning" href="" data-toggle="modal" data-target="#modal-edit<?= $value['id']?>"><i class="fas fa-edit"></i></a>
                                <a class="btn btn-danger" href="" data-toggle="modal" data-target="#modal-hapus<?= $value['id']?>"><i class="fas fa-trash"></i></a>
                            </td>
                        </tr>
                    <?php }?>
                </tbody>
            </table>
        



        </div>
    </div>
</div>

<!-- tambah pnulis -->
<div class="modal fade" id="modal-sm">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Penulis Buku</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php echo form_open(base_url('Penulis/Tambah'));?>
                <div class="form-group">
                    <label for="exampleInputEmail1">Nama Penulis</label>
                    <input type="text" class="form-control" name="nama" placeholder="Penulis Buku" required>
                    <label for="exampleInputEmail1">Alamat</label>
                    <input type="text" class="form-control" name="alamat" placeholder="Alamat" required>
                    <label for="exampleInputEmail1"> Website</label>
                    <input type="text" class="form-control" name="website" placeholder="Website" required>
                    </div>
                </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
            <?php echo form_close();?>
        </div>
    </div>
</div>


<!-- edit pnulis -->
<?php foreach ($penulis as $key => $value) {?>
<div class="modal fade" id="modal-edit<?= $value['id']?>">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit Penulis Buku</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php echo form_open(base_url('Penulis/EditPenulis/' . $value['id']));?>
                <div class="form-group">
                    <label for="exampleInputEmail1">Nama Penulis</label>
                    <input type="text" class="form-control" name="nama" value="<?= $value['nama']?>" placeholder="Nama Penulis" required>
                    <label for="exampleInputEmail1">Alamat</label>
                    <input type="text" class="form-control" name="alamat" value="<?= $value['alamat']?>" placeholder="Alamat" required>
                    <label for="exampleInputEmail1">Website</label>
                    <input type="text" class="form-control" name="website" value="<?= $value['website']?>" placeholder="Website" required>
                    </div>
                </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
            <?php echo form_close();?>
        </div>
    </div>
</div>
<?php }; ?>

<!-- hapus ktgori -->
<?php foreach ($penulis as $key => $value) {?>
<div class="modal fade" id="modal-hapus<?= $value['id']?>">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Hapus Penulis Buku</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php echo form_open(base_url('Penulis/HapusPenulis/' . $value['id']));?>
                <div class="form-group">
                    Anda yakin ingin menghapus Data Penulis <b><?= $value['nama']?></b> ?
                    </div>
                </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-danger">Hapus Penulis</button>
            </div>
            <?php echo form_close();?>
        </div>
    </div>
</div>
<?php };?>