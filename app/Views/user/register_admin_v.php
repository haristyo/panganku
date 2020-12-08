<br> <!--untuk memberi jeda header dan konten main-->

<!--==========================
  Article Section
============================-->


<section id="features" class="padd-section text-center wow fadeInUp">
    <div class="container">
        <div class="row justify-content-between">
            <div class="col-md-auto" style="margin-top: auto;">
              <div class="shadow mb-5 bg-white rounded" style="width: 24rem;">
                <div class="card" style="width: 24rem;">
                  <div class="card-body">
                    <h3 class="card-title text-center" style="padding-top: auto; margin-bottom: 10px;">Daftar Admin</h3>
                    <form action="/user/addUser" method="post" enctype="multipart/form-data">
                        <?= csrf_field(); ?>
                        <input type="hidden" name="is_admin" value="<?= $is_admin?>">
                        <div class="form-group">
                          <label for="email">Email address</label>
                          <input type="email" class="form-control <?= ($validation->hasError('email')) ? 'is-invalid' : '' ;?>" id="email" name="email" placeholder="masukan email anda disini" autofocus value="<?= old('email')?>">
                          <div class="invalid-feedback">
                            <?=$validation->getError('email');?>
                          </div>
                        </div>
                        <div class="form-group">
                          <label for="username">Username</label>
                          <input type="text" class="form-control <?= ($validation->hasError('username')) ? 'is-invalid' : '' ;?>" id="username" name="username" placeholder="isi dengan username" value="<?= old('username')?>">
                          <div class="invalid-feedback">
                            <?=$validation->getError('username');?>
                          </div>
                        </div>
                        <div class="form-group">
                          <label for="password">Password</label>
                          <input name="password" type="password" class="form-control <?= ($validation->hasError('password')) ? 'is-invalid' : '' ;?>" id="password" placeholder="minimal 8 karakter"  value="<?= old('password')?>">
                          <div class="invalid-feedback">
                            <?=$validation->getError('password');?>
                          </div>                       
                        </div>
                        <div class="form-group">
                          <label for="nama_lengkap">Nama Lengkap</label>
                          <input type="text" class="form-control <?= ($validation->hasError('nama_lengkap')) ? 'is-invalid' : '' ;?>" id="nama_lengkap" name="nama_lengkap" placeholder="isi nama lengkap anda" value="<?= old('nama_lengkap')?>">
                          <div class="invalid-feedback">
                            <?=$validation->getError('nama_lengkap');?>
                          </div>
                        </div>
                        <div class="form-group">
                          <label for="jenis_kelamin">Jenis Kelamin</label>
                            <div class="form-check ">
                                <input class="form-check-input" type="radio" name="jenis_kelamin" id="L" value="L" <?php if(old('jenis_kelamin')=="L"){echo 'checked';}?>>
                                <label class="form-check-label" for="L">
                                    Laki-laki
                                </label>
                                </div>
                                <div class="form-check">
                                <input class="form-check-input" type="radio" name="jenis_kelamin" id="P" value="P" <?php if(old('jenis_kelamin')=="P"){echo 'checked';}?>>
                                <label class="form-check-label" for="P">
                                    Perempuan
                                </label>
                            </div>
                            
                        </div>
                        <div class="form-group">
                          <label for="alamat">Alamat</label>
                          <textarea class="form-control <?= ($validation->hasError('alamat')) ? 'is-invalid' : '' ;?>" id="alamat" name="alamat" rows="3" placeholder="Masukkan Alamat Rumah"><?= old('alamat')?></textarea>
                            <div class="invalid-feedback">
                                    <?=$validation->getError('alamat');?>
                            </div>
                        </div>
                        <div class="form-group">
                          <label for="bio">Bio</label>
                          <textarea class="form-control <?= ($validation->hasError('bio')) ? 'is-invalid' : '' ;?>" id="bio" name="bio" rows="3" placeholder="Masukkan Bio Anda"><?= old('bio')?></textarea>
                            <div class="invalid-feedback">
                                    <?=$validation->getError('bio');?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="gambar_profile">gambar_profil</label>
                            <input type="file" class="form-control-file <?= ($validation->hasError('gambar_profile')) ? 'is-invalid' : '' ;?>" id="gambar_profile" name="gambar_profile">
                            <div class="invalid-feedback">
                                <?=$validation->getError('gambar_profile');?>
                            </div>
                        </div>

                        <div class="row justify-content-between">
                          <div class="col-sm-auto w-100">
                            <button type="submit" class="btn btn-primary w-100">Daftar</button>
                          </div>
                          <div class="col-sm-auto">
                          <a class="nav-link" href="<?=base_url('/login')?>">Sudah punya akun ?</a>
                          </div>
                        </div>                 
                      </form>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-3">
                <img src="<?=base_url('img/daftar-pengguna.png')?>" class="float-right" style="width: 280%; height: auto; padding-top: 40%;">
            </div>
        </div>
    </div>
</section>
