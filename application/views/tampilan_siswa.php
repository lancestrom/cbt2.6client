 <div class="container">
     <div class="row">
         <div class="col-md mt-4">
             <div class="card">
                 <div class="card-body bg-primary text-white">
                     <h4 class="text-uppercase"><?= $siswa['nama_siswa'] ?></h4>
                     <h4 class="text-uppercase"><?= $siswa['kelas'] ?></h4>
                     <h4>
                         <a class="btn btn-sm btn-danger mt-2 text-uppercase font-weight-bolder"
                             href="<?= base_url() ?>Login/logout">Logout</a>
                     </h4>
                 </div>
             </div>
         </div>
     </div>
 </div>