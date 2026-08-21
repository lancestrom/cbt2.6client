<div style="min-height: 100vh; background: linear-gradient(135deg, #eaf4ff 0%, #e9fff5 100%); padding: 1rem 0 2rem;">
    <div class="container">
        <div class="row">
            <div class="col-12 mt-4">
                <div class="card shadow-sm border-0 rounded-lg overflow-hidden">
                    <div class="card-body p-4 p-sm-5 text-white d-flex flex-column flex-sm-row align-items-sm-center justify-content-between" style="background: linear-gradient(135deg, #4e73df 0%, #1cc88a 100%);">
                        <div>
                            <h4 class="mb-1 text-uppercase">Halo, <?= $siswa['nama_siswa'] ?></h4>
                            <h4 class="mb-0 text-white-75">Kelas <?= $siswa['kelas'] ?></h4>
                            <p class="mb-0 text-white-50 small">Waktu sekarang: <span id="digitalClock">--:--:--</span></p>
                        </div>
                        <a class="btn btn-danger btn-sm text-uppercase font-weight-bold mt-3 mt-sm-0" href="<?= base_url() ?>Dashboard/logout">Logout</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container mt-4">
        <div class="row row-cols-1 row-cols-md-2">
            <?php if (!empty($ujian)) : ?>
                <?php foreach ($ujian as $row) : ?>
                    <div class="col mb-4">
                        <div class="card shadow-sm h-100 border-0 rounded-lg">
                            <div class="card-body d-flex flex-column">
                                <div class="d-flex align-items-center mb-3">
                                    <span class="badge badge-primary badge-pill py-2 px-3 mr-3">Ujian</span>
                                    <h5 class="card-title mb-0 text-uppercase font-weight-bold"><?= $row['nama_mapel'] ?></h5>
                                </div>
                                <p class="text-muted mb-1">ID Jadwal: <span class="font-weight-bold"><?= $row['id_jadwal'] ?></span></p>
                                <p class="text-secondary mb-4">
                                    <strong>Tanggal:</strong> <?= date('d F Y', strtotime($row['tanggal_mulai'])) ?><br>
                                    <strong>Waktu:</strong> <?= date('H:i', strtotime($row['waktu_mulai'])) ?> - <?= date('H:i', strtotime($row['waktu_selesai'])) ?>
                                </p>
                                <div class="mt-auto">
                                    <a class="btn btn-success btn-block text-uppercase font-weight-bold" href="<?= base_url() ?>Dashboard/detail_ujian/<?= $row['id_jadwal'] ?>">Mulai Ujian</a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else : ?>
                <div class="col-12">
                    <div class="card shadow-sm border-0 rounded-lg">
                        <div class="card-body text-center py-5">
                            <div class="mb-3 text-muted">
                                <i class="fas fa-calendar-times fa-3x"></i>
                            </div>
                            <h5 class="card-title mb-2">Ujian Kosong</h5>
                            <p class="card-text text-muted mb-4">Saat ini tidak ada jadwal ujian yang tersedia untuk Anda.</p>
                            <a href="<?= base_url() ?>Dashboard" class="btn btn-outline-primary btn-sm text-uppercase font-weight-bold">Segarkan Halaman</a>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <script>
        function updateDigitalClock() {
            const now = new Date();
            const hours = String(now.getHours()).padStart(2, '0');
            const minutes = String(now.getMinutes()).padStart(2, '0');
            const seconds = String(now.getSeconds()).padStart(2, '0');
            document.getElementById('digitalClock').textContent = `${hours}:${minutes}:${seconds}`;
        }

        document.addEventListener('DOMContentLoaded', function() {
            updateDigitalClock();
            setInterval(updateDigitalClock, 1000);
        });
    </script>