<div class="col-md-12">
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title"><?= $judul ?></h3>
        </div>
        <?php if(session()->getFlashdata('success')) : ?>
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5><i class="icon fas fa-check"></i> Berhasil</h5>
                <?= session()->getFlashdata('success') ?>
            </div>
        <?php endif; ?>

        <div class="card-body">
            <div class="table-responsive">
                <table id="example2" class="table table-striped projects">
                    <!-- Tabel Data -->
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<?php foreach ($info as $value) : ?>
    <div class="modal fade" id="modal-edit<?= $value['id'] ?>">
        <!-- Konten Modal -->
    </div>

    <div class="modal fade" id="modal-ontime<?= $value['id'] ?>">
        <!-- Konten Modal -->
    </div>
<?php endforeach; ?>

<script>
    function updateCountdown(endDate, elementId) {
        var currentDate = new Date();
        var diff = Math.max(0, endDate - currentDate);

        var seconds = Math.floor(diff / 1000) % 60;
        var minutes = Math.floor(diff / (1000 * 60)) % 60;
        var hours = Math.floor(diff / (1000 * 60 * 60)) % 24;
        var days = Math.floor(diff / (1000 * 60 * 60 * 24));

        var countdownText = days + ' Hari : ' + hours + ' Jam : ' + minutes + ' Menit : ' + seconds + ' Detik';
        document.getElementById(elementId).innerHTML = countdownText;
    }

    function startCountdowns() {
        <?php foreach ($info as $value) : ?>
            var endDate<?= $value['id'] ?> = new Date('<?= $value['tgl_kembali'] ?>');
            setInterval(function() {
                updateCountdown(endDate<?= $value['id'] ?>, 'countdown<?= $value['id'] ?>');
            }, 1000);
        <?php endforeach; ?>
    }

    window.onload = startCountdowns;
</script>
