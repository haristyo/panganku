

<section>
<br> 
<br/>
<div class="container">
<div class="section-title text-right">
  <a href="<?= base_url('article/create');?>" class="btn btn-success"> Tambah Artikel </a>
</div>
<div class="table-responsive">
<table class="table">
  <thead class="thead-dark">
    <tr align="center">
      <th scope="col">ID</th>
      <th scope="col">Judul Artikel</th>
      <th scope="col">Username</th>
      <th scope="col">Isi Artikel</th>
      <th scope="col">Gambar</th>
      <th scope="col">Aksi</th>
    </tr>
  </thead>
  <tbody>
  <?php foreach ($artikel as $a) { ?>
    <tr>
      <th scope="row"><a> <?=$a['id_artikel']; ?></th>
      <th scope="row"><a href="<?= base_url('article/'.$a['id_artikel'])?>" ><?=$a['judul']; ?></a></th>
      <th scope="row"><?=$a['username']; ?></th>
      <th scope="col"><?= nl2br(esc(substr($a['isi'],0,25),'html')); ?>...</th>
      <th scope="col">
        <?php if (! $a['gambar'] == "" ) { ?>
          <img src="<?php echo base_url('/img/article/'.$a['gambar']); ?>" width=100px> 
        <?php } else {echo "<p>gambar tidak ada</p>";}?>
      </th>
      <th scope="col">
      <a href="/article/dashboardEdit/<?=$a['id_artikel'];?>" ><button><i class="fa fa-pencil-square-o" ></i></button></a>
      <a href="/article/dashboardDelete/<?=$a['id_artikel'];?>" ><button><i class="fa fa-trash-o" ></i></button></a>
      </th>
    </tr>
  <?php }?>
  </tbody>
</table>
</div> 
</div>
</div>
</section>