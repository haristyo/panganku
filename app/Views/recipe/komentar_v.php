<section>
<div class="container">
  <div class="row text-left align-self-left">
  <div class="col-md-12 col-lg-12 btn-komen mt-4 text-center"> Komentar</div>
  <?php foreach($komentar as $k):?>
    <div class="col-md-12 col-lg-12 btn-isi-komen mt-1">
        <div class="d-flex">
          <div class="ml-0 mr-auto">
            <b><?=$k['username'];?></b> pada <?php echo date_format(date_create($k['waktu_komen']), 'H:i d-m-Y');?>
          </div>
          <?php if((session()->get('id_user')==$k['id_user']) or (session()->get('is_admin')=="Y" ) or (session()->get('id_user')==$resep['id_user']) )  { ?>
          <div class="mr-0" >
            <button><i class="fa fa-pencil-square-o" ></i></button>
            <button><i class="fa fa-trash-o fa-2x" ></i></button>  
          </div>
          <?php }?>
        </div>    
        <?=$k['komentar'];?>
    </div>
  <?php endforeach;?>
  <?php if(session()->get('logged_in')==TRUE)  { ?>
    <div class="col-md-12 col-lg-12 mt-1 btn-isi-komen p-2">
      <form method="post">
        <?= csrf_field() ?>
            <textarea class="form-control " id="tutorial" name="tutorial" rows="3" placeholder="Masukkan Cara memasak"><?= old('tutorial')?></textarea>
  </div>

   <?php }?>
  
  </div>
  </div>
  </div>
  </section>