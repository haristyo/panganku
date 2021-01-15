
    <br> 
  

<!--main recipe-->
<!--==========================
    Get Started Section
  ============================-->
  <section id="get-started" class="padd-section text-center wow fadeInUp">

    <div class="container">
      <div class="section-title text-center">
        <h2>Ganti NASI dengan Makanan lain!</h2>
        <p class="separator">Rasa dan Gizi jauh lebih hebat dibanding nasi</p>
      </div>
    </div>
    <div class="container">
            <?php if(session()->getFlashData('pesan')) :?>
              <div class="alert alert-success" role="alert">
                <?= session()->getFlashData('pesan') ?>
              </div>
            <?php endif;?>
    </div>
    <?php if(session()->get('logged_in')==TRUE) {?>
    <div class="container">
        <div class="section-title text-right">
            <a href="<?= base_url('recipe/create');?>" class="btn btn-success"> Tambah Resep </a>
        </div>
    </div>
    <?php }?>
<!--mulai recipe-->
    <div class="container">
      <div class="row">
      <?php $i = 1; foreach ($resep as $r) { ?>
        <div class="col-md-6 col-lg-4 my-2">
          <div class="card w-100 h-100">
            <img src="<?php echo base_url('img/recipe/'.$r['gambar_banner']); ?>" alt="img<?= $i++; ?>" width="100%">
            <h4><?= $r['judul']; ?></h4>
            oleh <b><?= $r['username']; ?></b><br>
            <b>Bahan Bahan:</b>
            <?php echo nl2br(substr($r['bahan'],0,25)); ?>...
            <br><br> <b>Langkah-Langkah:</b>
                <div class="w-100"><?php echo nl2br(substr($r['tutorial'],0,150)); ?>...</div>
                </p> 
                <!-- referensi resep by: https://cookpad.com/id/resep/11575566-scramble-pottato-diet-pengganti-nasi -->
            <a href="/recipe/<?= $r['id_resep']?>" class=" mb-0 mt-auto w-100 btn btn-success align-self-center">Baca Selengkapnya</a>
          </div>
        </div>
        <?php } ?> 
      </div>
    </div>

  </section>
<!--end main recipe-->
