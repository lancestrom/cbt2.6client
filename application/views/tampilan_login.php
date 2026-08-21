<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <title>CBT SMK TUNAS HARAPAN JAKARTA BARAT</title>
    <link rel="icon" href="<?= base_url() ?>assets/images/logo.png" />

    <!-- Custom fonts for this template-->
    <link href="<?= base_url() ?>assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css" />
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet" />

    <!-- Custom styles for this template-->
    <link href="<?= base_url() ?>assets/css/sb-admin-2.min.css" rel="stylesheet" />
</head>

<body class="bg-gradient-light">
    <div class="container min-vh-100 d-flex justify-content-center align-items-center">
        <div class="col-xl-5 col-lg-6 col-md-8">
            <div class="card o-hidden border-0 shadow-lg">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="p-5">
                                <div class="text-center">
                                    <img src="https://smkth-jakbar.com/assets/images/logo.png" alt="logo"
                                        class="mb-4" style="width: 120px; height: 120px;">
                                    <h1 class="h4 text-gray-900 mb-2 text-uppercase font-weight-bolder">Login Siswa</h1>
                                    <p class="mb-4">Selamat datang! Silakan masuk untuk melanjutkan.</p>
                                    <h5 class="mt-2 text-center text-danger font-weight-bolder">
                                        <span id="server-time"></span>
                                    </h5>
                                </div>

                                <?php if ($this->session->flashdata('pesan')): ?>
                                    <div class="mb-3">
                                        <?= $this->session->flashdata('pesan') ?>
                                    </div>
                                <?php endif; ?>

                                <form class="user mt-4" action="<?= base_url() ?>Login/proses_login" method="post">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                                            </div>
                                            <input type="text" class="form-control form-control-user" name="username"
                                                placeholder="Masukkan Username Anda..." required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                            </div>
                                            <input type="text" name="password" class="form-control form-control-user"
                                                placeholder="Masukkan Password Anda" required>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-user btn-block font-weight-bold">
                                        Login
                                    </button>
                                </form>
                                <hr>
                                <div class="text-center">
                                    <span class="small">SMK Tunas Harapan Jakarta Barat &copy; <?= date('Y'); ?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="<?= base_url() ?>assets/vendor/jquery/jquery.min.js"></script>
    <script src="<?= base_url() ?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="<?= base_url() ?>assets/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="<?= base_url() ?>assets/js/sb-admin-2.min.js"></script>

    <script>
        // Fungsi untuk memformat angka menjadi dua digit (misal: 7 -> 07)
        function pad(n) {
            return n < 10 ? '0' + n : n;
        }

        // Mengambil elemen untuk menampilkan waktu
        var timeDisplay = document.getElementById('server-time');

        // Mengambil waktu awal dari PHP dan mengubahnya menjadi objek Date JavaScript
        // Format PHP 'd-m-Y H:i:s' perlu diubah agar bisa dibaca JavaScript
        var serverTimeStr = "<?php echo date('Y-m-d H:i:s'); ?>";
        var serverTime = new Date(serverTimeStr.replace(/-/g, '/'));

        // Memperbarui jam setiap detik
        setInterval(function() {
            // Tambah 1 detik
            serverTime.setSeconds(serverTime.getSeconds() + 1);

            // Format tanggal dan waktu
            var day = pad(serverTime.getDate());
            var month = pad(serverTime.getMonth() + 1);
            var year = serverTime.getFullYear();
            var hours = pad(serverTime.getHours());
            var minutes = pad(serverTime.getMinutes());
            var seconds = pad(serverTime.getSeconds());

            // Tampilkan waktu yang sudah diformat
            timeDisplay.innerText = hours + ':' + minutes + ':' + seconds;
        }, 1000);
    </script>
</body>

</html>