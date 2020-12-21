
<section>
<br> 
<br/>
<div class="container">

<div class="section-title text-right">
  <a href="<?= base_url('recipe/create');?>" class="btn btn-success"> Tambah Resep </a>
</div>
<div class="table-responsive">

<table class="table">
  <thead class="thead-dark">
    <tr align="center">
      <th scope="col">ID</th>
      <th scope="col">Judul Resep</th>
      <th scope="col">Username</th>
      <th scope="col">Bahan</th>
      <th scope="col">Cara Memasak</th>
      <th scope="col">Gambar</th>
      <th scope="col">Tanggal Post</th>
      <th scope="col">Aksi</th>
    </tr>
  </thead>
  <tbody>
  <?php foreach ($resep as $r) { ?>
    <tr>
      <th scope="row"><a> <?=$r['id_resep']; ?></th>
      <th scope="row"><a href="<?= base_url('recipe/'.$r['id_resep'])?>" ><?=$r['judul']; ?></a></th>
      <th scope="row"><?=$r['username']; ?></th>
  
      <th scope="col"><?= nl2br(esc(substr($r['bahan'],0,25),'html')); ?>...</th>
      <th scope="col"><?= nl2br(esc(substr($r['tutorial'],0,25),'html')); ?>...</th>
      <th scope="col">
        <?php if (! $r['gambar_banner'] == "" ) { ?>
          <img src="<?php echo base_url('img/recipe/'.$r['gambar_banner']); ?>" width=100px> 
        <?php } else {echo "<p>gambar tidak ada</p>";}?>
      </th>
      <th scope="col"> <?=date("d-m-Y H:i:s", strtotime($r['created_resep']));?></th>
      
      
      
      <th scope="col" class="d-flex">
        <a href="/recipe/dashboardEdit/<?=$r['id_resep'];?>" ><button class="mr-1"><i class="fa fa-pencil-square-o" ></i></button></a>
        <a href="/recipe/dashboardDelete/<?=$r['id_resep'];?>" ><button><i class="fa fa-trash-o" ></i></button></a>
      </th>
    </tr>
  <?php }?>
  </tbody>
</table>
</div> 
</div>
</div>
</section>