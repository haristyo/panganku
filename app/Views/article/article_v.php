
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
    <?php if(session()->get('logged_in')==TRUE) {?>
    <div class="container">
        <div class="section-title text-right">
            <a href="<?= base_url('recipe/create');?>" class="btn btn-success"> Tambah Resep </a>
        </div>
    </div>
    <?php }?>
    <div class="container">
      <div class="row">
      
      <?php $i = 1; foreach ($artikel as $a) { ?>
        <div class="col col-md-6 col-lg-3">
        
        <div class="card w-100">
            <img src="<?= base_url($a['gambar']); ?>" alt="artikel<?= $i++; ?>" width="100%">
              <h4><?= $a['judul']; ?></h4> 
              <h5><div class="w-100"><?php echo substr($a['isi'],0,99); ?></div></h5>
              
                 <a href="/article/<?= $a['id_artikel']?>" class="w-100 btn btn-success align-self-center">Baca Selengkapnya</a>
                
          </div>
        </a>
        </div>
      <?php } ?>
      </div>
    </div>
  </section>

  
  <!--==========================
    Blog untuk last pots artikel Section
  ============================-->
  <section id="blog" class="padd-section wow fadeInUp">

    <div class="container">
      <div class="section-title text-center">

        <h2>Latest posts</h2>
        <p class="separator">by Panganku</p>

      </div>
    </div>

    <div class="container">
      <div class="row">
        <div class="col-md-6 col-lg-4">
          <div class="block-blog text-left">
            <a href="#"><img src="img/article/article-image-1.jpg" alt="img"></a>
            <div class="content-blog">
              <h4><a href="#">Kementan dan Masyarakat</a></h4>
              <span>03 Juni 2020</span>
              <a class="pull-right readmore" href="https://rmco.id/baca-berita/ekonomi-bisnis/37001/kementan-ajak-masyarakat-perkuat-diversifikasi-pangan-lokal">read more</a>
            </div>
          </div>
        </div>

        <div class="col-md-6 col-lg-4">
          <div class="block-blog text-left">
            <a href="#"><img src="img/article/article-image-4.jpg" class="img-responsive" alt="img"></a>
            <div class="content-blog">
              <h4><a href="#">whats isthe difference between good and bat typography</a></h4>
              <span>11 November 2020</span>
              <a class="pull-right readmore" href="https://kalteng.antaranews.com/berita/438640/menjaga-ketahanan-pangan-di-masa-pandemi-melalui-diversifikasi">read more</a>
            </div>
          </div>
        </div>

        <div class="col-md-6 col-lg-4">
          <div class="block-blog text-left">
            <a href="#"><img src="img/article/article-image-3.jpg" class="img-responsive" alt="img"></a>
            <div class="content-blog">
              <h4><a href="#">whats isthe difference between good and bat typography</a></h4>
              <span>19 Agustus 2020</span>
              <a class="pull-right readmore" href="https://newslampungterkini.com/news/87382/antisipasi-krisis-pangan-gubernur-lampung-canangkan-gerakan-diversifikasi-pangan-dan-ekspos-umkm-pangan-lokal.html">read more</a>
            </div>
          </div>
        </div>

      </div>
    </div>
  </section>
