<div class="col-lg-12">
    <?php 
    if(session()->getFlashdata('pesan')){
        echo '<div class="alert alert-info alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5><i class="icon fas fa-check"></i> Berhasil</h5>';
        echo session()->getFlashdata('pesan');
        echo '</div>';
    }
    ?>
</div>

<?php
if (empty($hst)) {
    echo '<div class="row">
            <div class="col-12">
                <div class="callout callout-info">
                    <h5><i class="fas fa-info"></i> Note:</h5>
                    Belum ada pengajuan buku pinjaman yang masuk.
                </div>
            </div>
        </div>';
} else {
?>
<div class="container-fluid">
    <div class="row">
        <?php foreach ($hst as $key => $data) {?>
        <div class="col-6">
            <div class="card">
                <div class="card-header">
                    <div class="user-block">
                        <img class="img-circle img-bordered-sm" src="<?= base_url('foto/' . $data['foto'])?>" alt="user image">
                        <span class="username">
                            <a href="#"><?= $data['nama']?></a>
                        </span>
                    </div>
                    <?php if ($data['status'] === 'Belum Kembali') : ?>
                    <div class="user-block float-right">
                        <a class="btn btn-outline-danger mt-2 btn-sm" href="<?= base_url('Admin/EmailTelat/' . $data['id']) ?>">
                        <i class="far fa-envelope me-5"></i> Kirim Email
                        </a>
                    </div>
                    <?php endif; ?>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-9">
                            <blockquote>
                                <?php if ($data['status'] === 'Belum Kembali') : ?>
                                    <p>Peminjam belum mengembalikan buku, tanggal akhir peminjaman buku <?= $data['tgl_kembali']?></p>
                                    <small><a href="" data-toggle="modal" data-target="#modal-edit<?= $data['id']?>">Apakah Peminjam sudah mengembalikan buku <cite title="Source Title"><?= $data['judul_buku']?> ?</cite></a></small>
                                <?php elseif ($data['status'] === 'Dikembalikan' && $data['denda'] === NULL) : ?>
                                    <p>Peminjam sudah mengembalikan buku sesuai dengan tanggal akhir peminjaman <?= $data['tgl_kembali']?>.</p>
                                    <small>Durasi peminjaman buku <cite title="Source Title"><?= $data['judul']?></cite> selama <?= $data['batas_waktu']?> hari.</small>
                                <?php elseif ($data['status'] === 'Dikembalikan' && $data['denda'] === '30') : ?>
                                    <p>Peminjam <span class="text-danger">terlambat</span> mengembalikan buku, masa tanggal akhir peminjaman <b><?= $data['tgl_kembali']?></b>.</p>
                                    <small>Peminjam terlambat <cite title="Source Title"><?= $data['keterlambatan']?></cite> hari dan telah membayar denda sebesar Rp 30.000.</small>
                                <?php endif; ?>
                            </blockquote>
                        </div>
                        <div class="col-md-3">
                            <div class="position-relative">
                                <img src="<?= base_url('buku/' . $data['foto_buku'])?>" width="125px" alt="Photo 1" class="img-fluid">
                                <div class="ribbon-wrapper ribbon-lg">
                                <?php if ($data['status'] === 'Dikembalikan') : ?>
                                    <div class="ribbon bg-success text-sm">
                                    <?= $data['status'] ?>
                                    </div>
                                <?php elseif ($data['status'] === 'Belum Kembali') : ?>
                                    <div class="ribbon bg-danger text-sm">
                                    <?= $data['status'] ?>
                                    </div>
                                <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php } ?>
    </div>
</div>
<?php } ?>

<!--  Modal Telat -->
<?php foreach ($hst as $key => $data) {?>
<div class="modal fade" id="modal-edit<?= $data['id']?>">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Konfirmasi Keterlambatan Pengembalian Buku</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php echo form_open(base_url('Admin/SimpanPengembalian/' . $data['id']));?>
                <div class="form-group text-center">
                    <h5 class="text-center">Apakah Peminjam Buku sudah mengembalikan buku <b><?= $data['judul']?> ?</b></h5>
                    <?php
                    $timezone = new DateTimeZone('Asia/Makassar'); 
                    $now = new DateTime('now', $timezone);
                    ?>
                    <input type="hidden" name="tgl_terlambat" value="<?= $now->format('Y-m-d') ?>">
                    <span class="text-center"><i>Peminjam buku terlambat mengembalikan buku dari tanggal <?= $data['tgl_kembali']?>.</i></span>
                    <input type="hidden" name="status" value="Belum Kembali">
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Simpan</button>
                </div>
                <?php echo form_close();?>
            </div>
        </div>
    </div>
</div>
<?php }; ?>
