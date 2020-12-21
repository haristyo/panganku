

<section>
<br> 
<br/>
<div class="container">
<div class="table-responsive">
<table class="table">
  <thead class="thead-dark">
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Username</th>
      <th scope="col">Isi</th>
      <th scope="col">Gambar</th>
      <th scope="col">Tanggal Post</th>
      <th scope="col">Judul Resep</th>
      <th scope="col"></th>
    </tr>
  </thead>
  <tbody>
  <?php foreach ($komentaruserresep as $k) { ?>
    <tr>
      <th scope="row"><a> <?=$k['id_komentar']; ?></th>
      <th scope="row"><?=$k['username']; ?></th>
      <th scope="col"><?= nl2br(esc(substr($k['komentar'],0,25),'html')); ?></th>
      <th scope="col">
        <?php if (! $k['gambar'] == "" ) { ?>
          <img src="<?php echo base_url('img/recipe/komen/'.$k['gambar']); ?>" width=100px> 
        <?php } else {echo "<p>gambar tidak ada</p>";}?>
      </th>
      <th scope="col"><?=date("d-m-Y H:i:s", strtotime($k['created_komentar'])); ?></th>
      <th scope="col"><a href="<?= base_url('recipe/'.$k['id_resep'])?>" > <?= nl2br(substr($k['judul'],0,25)); ?></a></th>
      <th scope="col">              
        <form method="post" action="/recipe/dashboardKomentarDelete/<?=$k['id_komentar']?>" class="inline">
                <input type="hidden" name="id_resep" value="<?=$k['id_resep']?>">
                <button><i class="fa fa-trash-o"></i></button>      
        </form>
      </th>
    </tr>
  <?php }?>
  </tbody>
</table>
</div> 
</div>
</div>
</section>