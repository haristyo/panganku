<section>
<div class="container">
  <div class="row text-left align-self-left">
  <div class="col-md-12 col-lg-12 btn-komen mt-4 text-center"> Komentar</div>
  <?php foreach($komentar as $k):?>
    <div class="col-md-12 col-lg-12 btn-isi-komen mt-1">
        <div class="d-flex">
          <div class="ml-0 mr-auto">
            <b><?=$k['username'];?></b> pada <?php echo date_format(date_create($k['created_at']), 'H:i d-m-Y');?>
          </div>
          <?php if((session()->get('id_user')==$k['id_user']) or (session()->get('is_admin')=="Y" ) or (session()->get('id_user')==$resep['id_user']) )  { ?>
          <div class="mr-0" >
            <button><i class="fa fa-pencil-square-o" ></i></button>
            <button><i class="fa fa-trash-o fa-2x" ></i></button>  
          </div>
          <?php }?>
        </div>    
        <?=$k['komentar'];?><br/>
        <?php if(!$k['gambar']=="") {?>
        <img src="<?=base_url('img/recipe/komen/'.$k['gambar']); ?>" width="350px" >
        <?php } ?>
    </div>
  <?php endforeach;?>
  <?php if(session()->get('logged_in')==TRUE)  { ?>
    <div class="col-md-12 col-lg-12 mt-1 btn-isi-komen p-2">
      <form method="post" action="/recipe/komentarSave/<?=$resep['id_resep']?>" enctype="multipart/form-data">
        <?= csrf_field() ?>
            <textarea class="form-control <?= ($validation->hasError('komentar')) ? 'is-invalid' : '' ;?>" id="komentar" name="komentar" rows="3" placeholder="Masukkan komentar anda"><?= old('komentar')?></textarea>
            <div class="invalid-feedback">
                <?=$validation->getError('komentar');?>
            </div>
            <input type="hidden" name="id_user" value="<?=session()->get('id_user');?>">
            <input type="hidden" name="id_resep" value="<?=$resep['id_resep']?>">
            <div class="form-group">
                            <label for="gambar">Masukkan Foto (jika ada)</label>
                            <input type="file" class="form-control-file <?= ($validation->hasError('gambar')) ? 'is-invalid' : '' ;?>" id="gambar" name="gambar">
                            <div class="invalid-feedback">
                                <?=$validation->getError('gambar');?>
                            </div>
                        </div>
          <button type="submit" class="btn btn-success"> Kirim Komentar </button>
      </form>
          </div>

   <?php }?>
  
  </div>
  </div>
  </div>
  </section>