<div class="col-md-12">
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title">Data <?= $judul ?></h3>
            <div class="card-tools">
                <button type="button" class="btn btn-pimary btn-flat btn-sm" data-toggle="modal" data-target="modal-sm">
                    <i class="fas fa-plus"></i> Add
                </button>
            </div>
        </div>

        <div class="card-body">

            <?php
            if (session()->getFlashdata('pesan')) {
                echo '<div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5><i class="icon fas fa-check"></i>';
                echo session()->getFlashdata('pesan');
                echo '</h5></div>';
            }

            ?>

            <table class="table table-bordered">
                <thead>
                    <tr class="text-center">
                        <th width="50px">id</th>
                        <th>Nama</th>
                        <th width="100px">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $id = 1;
                    foreach ($kategori as $key => $value) { ?>
                        <tr>
                            <td><?= $id++ ?></td>
                            <td><?= $values['nama'] ?></td>
                            <td>
                                <button type="button" class="btn btn-warning btn-flat btn-sm" data-toggle="modal" data-target="modal-edit<?= $value['id'] ?>">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button type="button" class="btn btn-denger btn-flat btn-sm" data-toggle="modal" data-target="modal-delete<?= $value['id'] ?>">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>

        </div>
    </div>
</div>

<!-- Modal Add -->

<div class="modal fade" id="modal-sm">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah <?= $judul ?></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php echo form_open(base_url('Kategori/Add')) ?>
                <div class="form-group">
                    <label>Nama Kategori</label>
                    <input class="form-control" name="nama" placeholder="nama" required>
                </div>
            </div>
            <div class="model-footer justify-content-between">
                <button type="button" class="bin btn-defult btn-flat" data-dismiss="model">close</button>
                <button type="submit" class="btn btn-primary btn-flat">Simpan</button>
            </div>
            <?php echo form_close() ?>
        </div>
        <!-- modal-content -->
    </div>
    <!-- modal-dialog -->
</div>

<!-- Modal Edit -->
<?php foreach ($kategori as $key => $value) { ?>
    <div class="modal fade" id="modal-edit<?= $value['id'] ?>">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit <?= $judul ?></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?php echo form_open(base_url('Kategori/EditData/' . $value['id'])) ?>
                    <div class="form-group">
                        <label>Nama Kategori</label>
                        <input class="form-control" value="<?= $value['nama'] ?>" name="nama" placeholder="nama" required>
                    </div>
                </div>
                <div class="model-footer justify-content-between">
                    <button type="button" class="bin btn-defult btn-flat" data-dismiss="model">close</button>
                    <button type="submit" class="btn btn-warning btn-flat">Simpan</button>
                </div>
                <?php echo form_close() ?>
            </div>
            <!-- modal-content -->
        </div>
        <!-- modal-dialog -->
    </div>
<?php } ?>

<!-- Modal Delete -->
<?php foreach ($kategori as $key => $value) { ?>
    <div class="modal fade" id="modal-delete<?= $value['id'] ?>">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit <?= $judul ?></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?php echo form_open(base_url('Kategori/DeleteData/' . $value['id'])) ?>
                    <div class="form-group">
                        Apakah Anda Yakin ingin Menghapus Data <b><?=  $value['nama'] ?></b>..?
                    </div>
                </div>
                <div class="model-footer justify-content-between">
                    <button type="button" class="bin btn-defult btn-flat" data-dismiss="model">close</button>
                    <button type="submit" class="btn btn-danger btn-flat">Delete</button>
                </div>
                <?php echo form_close() ?>
            </div>
            <!-- modal-content -->
        </div>
        <!-- modal-dialog -->
    </div>
<?php } ?>