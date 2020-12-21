
    <br> <!--untuk memberi jeda header dan konten main-->

  <!--==========================
    Article Section
  ============================-->

<section id="features" class="padd-section text-center wow fadeInUp">
  <?php if(session()->getFlashData('pesan')) :?>
    <div class="container">
      <div class="section-title text-center">
        <div class="alert alert-success" role="alert">
          <?= session()->getFlashData('pesan') ?>
        </div>
      </div>
    </div>
  <?php endif;?>
  <div class="container">
    <div class="d-flex">
      <a href="/recipe" class="btn btn-success"> Kembali ke resep</a>
      <?php if((session()->get('id_user')==$resep['id_user']) or (session()->get('is_admin')=="Y" )) { ?>
        <a href="/recipe/edit/<?=$resep['id_resep'];?>" class="btn btn-warning ml-auto mr-2"> Edit Resep</a>
        <form action="/recipe/delete/<?=$resep['id_resep'];?>" method="post">
          <?= csrf_field()?>
            <input type="hidden" name="_method" value="DELETE">
            <button type="submit" class="btn btn-danger" > Hapus Resep </button>
        </form>
      <?php }?>
    </div>
    <div class="card d-flex" style="border: none">
      <h2><b><?= $resep['judul'];?></b></h2>
      <p class="separator"> oleh </p><b><?= $resep['nama_lengkap']." pada ".date("d M Y H:i:s", strtotime($resep['created_resep']));?> </b>
      <div>
        <img src="<?php echo base_url('/img/recipe/'.$resep['gambar_banner']); ?>" alt="artikel1" width="75%">
      </div>
      <br /><br />
      <H4> Lama memasak </h4>  
      <h5><?php echo $resep['lama_memasak'];?> Menit</h5>
      <br />
      <H4> Jumlah porsi </h4>
      <h5><?php echo $resep['porsi'];?></h5>
      <br />
      <H4> Bahan - Bahan </h4>
      <div class="justify">
        <h5 ><?= nl2br($resep['bahan']);?></h5>
      </div>
      <br/>
      <H4> Cara memasak </h4>
      <div class="justify">
        <h5><?php echo nl2br($resep['tutorial']);?></h5>
      </div>
      <H4> Gambar Tutorial </h4>
      <div class="row text-center center justify-content-md-center">
          <?php if ($resep['gambar_tutorial'] != "") {
            $i=1; $tutorial = explode(",",$resep['gambar_tutorial']);
            foreach ($tutorial as $t) { ?>
            <div class="col-md-3 col-lg-3 mt-2 ">
              <img src="<?php echo base_url('img/recipe/'.$t); ?>" alt="img<?= $i++; ?>" width="100%" >
            </div>
          <?php }} ?> 
      </div>
    </div>
  </div>
  </section>


