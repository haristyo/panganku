
    <br> <!--untuk memberi jeda header dan konten main-->

  <!--==========================
    Article Section
  ============================-->

  <section id="features" class="padd-section text-center wow fadeInUp">

    <div class="container">
      <div class="section-title text-center">
        <h2>Artikel Terpopuler</h2>
        <p class="separator">cari berita terkini mengenai diversifikasi pangan hanya di <b>Panganku</b></p>
      </div>
    </div>
    
    <?php if(session()->get('is_admin')=="Y") {?>
    <div class="container">
        <div class="section-title text-right">
            <a href="<?= base_url('article/create');?>" class="btn btn-success"> Tambah Artikel </a>
        </div>
    </div>
    <?php }?>
    <div class="container">
      <div class="row">
      
      <?php $i = 1; foreach ($artikel as $a) { ?>
        <div class="col col-md-6 col-lg-3">
        
        <div class="card w-100 h-100">
            <img src="<?= base_url('img/article/'.$a['gambar']); ?>" alt="artikel<?= $i++; ?>" width="100%">
              <h4 class=" mt-1"><?= $a['judul']; ?></h4> 
              <h5><div class="w-100 m-1"><?php echo nl2br(substr($a['isi'],0,99)); ?>...</div></h5>
              
                 <a href="/article/<?= $a['id_artikel'];?>" class="w-100 btn btn-success align-self-center mt-auto mb-0">Baca Selengkapnya</a>
                
          </div>
        </div>
      <?php } ?>
      </div>
    </div>
  </section>