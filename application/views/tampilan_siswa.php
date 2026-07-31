 <div class="container">
     <div class="row">
         <div class="col-md mt-4">
             <div class="card">
                 <div class="card-body bg-primary text-white">
                     <h4 class="text-uppercase"><?= $siswa['nama_siswa'] ?></h4>
                     <h4 class="text-uppercase"><?= $siswa['kelas'] ?></h4>
                     <h4>
                         <a class="btn btn-sm btn-danger mt-2 text-uppercase font-weight-bolder"
                             href="<?= base_url() ?>Dashboard/logout">Logout</a>
                     </h4>
                 </div>
             </div>
         </div>
     </div>
 </div>
 <div class="container">
     <div class="row">

         <?php foreach ($ujian as $row):
            ?>
             <div class="col-md-6">
                 <div class="card-body">
                     <div class="card">
                         <div class="card-body">
                             <h5 class="text-uppercase"><?= $row['id_jadwal'] ?></h5>
                             <h5 class="text-uppercase"><?= $row['nama_mapel'] ?></h5>
                             <hr>
                             <h5 class="text-uppercase"><?= $row['tanggal_mulai'] ?></h5>
                             <h5 class="text-uppercase"><?= $row['waktu_mulai'] ?> - <?= $row['waktu_selesai'] ?></h5>
                             <a class="btn btn-sm btn-success mt-2 text-uppercase font-weight-bolder"
                                 href="<?= base_url() ?>Ujian/ujian/<?= $row['id_jadwal'] ?>">Mulai</a>
                         </div>
                     </div>
                 </div>
             </div>
         <?php endforeach; ?>

     </div>


 </div>