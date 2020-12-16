<br> <!--untuk memberi jeda header dan konten main-->

<!--==========================
  Article Section
============================-->

<section id="features" class="padd-section text-center wow fadeInUp">
  <div class="container">
    <div class="row justify-content-between">
      <div class="col-sm-auto" style="padding-top: 10%;">
        <div class="shadow mb-5 bg-white rounded" style="width: 24rem;">
          <div class="card" style="width: 24rem;">
            <div class="card-body">
              <h3 class="card-title text-center" style="padding-top: auto;">Masuk</h3>
              <div class="container">

        <div class="section-title text-center">
            <?php if(session()->getFlashData('pesan')) :?>
              <div class="alert alert-danger" role="alert">
                <?= session()->getFlashData('pesan') ?>
              </div>
            <?php endif;?>
        </div>
    </div>
              
              <form method="post" action="/user/auth" >
              <?= csrf_field(); ?>
                <div class="form-group">
                  <label for="username">Nama Pengguna</label>
                  <input type="text" class="form-control <?= ($validation->hasError('username')) ? 'is-invalid' : '' ;?>" id="username" name="username" placeholder="Masukkan Nama Pengguna" value="<?=old('username')?>">
                  <div class="invalid-feedback">
                            <?=$validation->getError('username');?>
                          </div>
                </div>
                <div class="form-group">
                  <label for="password">Kata Sandi</label>
                  <input name="password" type="password" class="form-control <?= ($validation->hasError('password')) ? 'is-invalid' : '' ;?>" id="password" placeholder="Masukkan Password"  value="<?= old('password')?>">
                    <div class="invalid-feedback">
                        <?=$validation->getError('password');?>
                      </div>
                </div>
                <div class="row justify-content-between">
                  <div class="col-sm-auto w-100 ">
                    <button type="submit" class="btn btn-success w-100">Masuk</button>
            
                  </div>
                  <div class="col-sm-auto">
                    <a class="nav-link" href="/register">Belum punya akun ?</a>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-3">
        <img src="<?=base_url('img/login-pengguna.png')?>" class="float-right" style="width: 280%; height: auto; padding-top: 5%;">
      </div>
    </div>
  </div>
</section>