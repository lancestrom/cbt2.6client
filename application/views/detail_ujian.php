<style>
    .detail-ujian-page {
        min-height: 100vh;
        background: radial-gradient(circle at top left, #5d9cff 0%, #4268ff 40%, #1b2a6b 100%);
        padding: 2.5rem 0;
    }

    .detail-ujian-page .card {
        background: rgba(255, 255, 255, 0.08);
        border: 1px solid rgba(255, 255, 255, 0.18);
        box-shadow: 0 2rem 3rem rgba(0, 0, 0, 0.18);
        border-radius: 1.5rem;
        overflow: hidden;
    }

    .detail-ujian-page .card .card-body {
        padding: 2rem;
    }

    .detail-ujian-page .info-card {
        background: rgba(255, 255, 255, 0.12);
        border: none;
    }

    .detail-ujian-page .info-card h4,
    .detail-ujian-page .detail-card h5 {
        color: #ffffff;
    }

    .detail-ujian-page .detail-card h5 {
        letter-spacing: 0.08em;
    }

    .detail-ujian-page .btn-ujian {
        min-width: 180px;
        background: linear-gradient(135deg, #ff6b6b, #ff3d71);
        border: none;
        color: #fff;
        box-shadow: 0 0.8rem 1.8rem rgba(255, 88, 135, 0.25);
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    .detail-ujian-page .btn-ujian:hover {
        background: linear-gradient(135deg, #ff4b4b, #ff1d52);
        transform: translateY(-1px);
        box-shadow: 0 1rem 2rem rgba(255, 88, 135, 0.3);
    }

    @media (max-width: 768px) {
        .detail-ujian-page {
            padding: 1.5rem 0;
        }

        .detail-ujian-page .card {
            margin: 0 0.5rem;
        }

        .detail-ujian-page .card .card-body {
            padding: 1.4rem;
        }

        .detail-ujian-page .detail-card h5,
        .detail-ujian-page .info-card h4 {
            font-size: 1rem;
        }

        .detail-ujian-page .btn-ujian {
            width: 100%;
            min-width: auto;
            padding: 0.9rem 1.2rem;
        }

        .detail-ujian-page .btn-danger {
            width: 100%;
        }
    }
</style>

<div class="detail-ujian-page">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-8 mt-4">
                <div class="card info-card">
                    <div class="card-body text-center">
                        <h4 class="text-uppercase font-weight-bolder"><?= $siswa['nama_siswa'] ?></h4>
                        <h4 class="text-uppercase font-weight-bolder"><?= $siswa['kelas'] ?></h4>
                        <a class="btn btn-sm btn-danger mt-3 text-uppercase font-weight-bolder" href="<?= base_url() ?>Dashboard/logout">Logout</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-8 mt-3">
                <div class="card detail-card">
                    <div class="card-body text-center">
                        <h5 class="text-uppercase font-weight-bolder"><?= $detail_ujian['id_jadwal'] ?></h5>
                        <h5 class="text-uppercase font-weight-bolder"><?= $detail_ujian['nama_mapel'] ?></h5>
                        <h5 class="text-uppercase font-weight-bolder"><?= $detail_ujian['tanggal_mulai'] ?></h5>
                        <h5 class="text-uppercase font-weight-bolder"><?= $detail_ujian['waktu_mulai'] ?> - <?= $detail_ujian['waktu_selesai'] ?></h5>
                        <h5 class="text-uppercase font-weight-bolder"><?= $detail_ujian['selisih_menit'] ?> menit</h5>
                        <a class="btn btn-ujian btn-lg mt-3 text-uppercase font-weight-bolder" href="<?= base_url() ?>Dashboard/ujian/<?= $detail_ujian['id_jadwal'] ?>">Mulai Ujian</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>