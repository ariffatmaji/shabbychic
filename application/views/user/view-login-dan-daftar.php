<!-- form modal Login -->
<div id="modalLogin" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><i class="fa fa-user-circle"></i> Silahkan login </h4>
      </div>
      <div class="modal-body">
        <form class="form-horizontal" method="post" action="<?php echo site_url('login/proses_login') ?>">
          <input type="hidden" name="asal" value="<?php echo site_url().$this->uri->segment(1)."/".$this->uri->segment(2) ?>">
          <div class="form-group">
            <label class="control-label col-sm-2" for="email">Email:</label>
            <div class="col-sm-10">
              <input type="email" class="form-control" id="email" value="member@gmail.com" placeholder="Masukan email" name="email" required="">
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-sm-2" for="pwd">Password:</label>
            <div class="col-sm-10">
              <input type="password" class="form-control" value="password" id="pwd" placeholder="Masukan password" name="password" required="">
            </div>
          </div>
          <div class="form-group">
            <div class="col-sm-offset-10 col-sm-2">
              <button type="submit" class="btn btn-primary btn-block">Login</button>
            </div>
          </div>
        </form>
      </div>
    </div>

  </div>
</div>

<!-- Modal daftar -->
<div id="modalDaftar" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><i class="fa fa-user-plus"></i> Register</h4>
      </div>
      <div class="modal-body">
      	<div class="well">
      		Silahkan lengkapi data berikut untuk menjadi member <b>Shabbychic Korden</b>
      	</div>
        <form class="form-horizontal"action="<?php echo site_url('login/proses_daftar') ?>" method="post">
          <input type="hidden" name="asal" value="<?php echo site_url().$this->uri->segment(1)."/".$this->uri->segment(2) ?>">
          <div class="form-group">
            <label class="control-label col-sm-3">Nama Lengkap</label>
            <div class="col-sm-9">
              <input type="text" class="form-control" placeholder="Masukan nama lengkap Anda" required="" name="nama">
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-sm-3">No Handphone</label>
            <div class="col-sm-9">
              <input type="text" pattern="[0-9]+" minlength="10" class="form-control" placeholder="Masukan nomor handphone" name="phone" required="">
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-sm-3" for="email">Email</label>
            <div class="col-sm-9">
              <input type="email" class="form-control" id="email" placeholder="Masukan email aktif" name="email" required="">
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-sm-3" for="pwd">Password</label>
            <div class="col-sm-9">
              <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="password" required="">
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-sm-3">Jenis Kelamin</label>
            <div class="col-sm-9">
              <select class="form-control" name="jekel">
                <option value="Laki-laki">Laki-laki</option>
                <option value="Perempuan">Perempuan</option>
              </select>
            </div>
          </div>
          <div class="form-group">
            <div class="col-sm-offset-9 col-sm-3 ">
              <button type="submit" class="btn btn-success btn-block">Daftar</button>
            </div>
          </div>
        </form>
      </div>
    </div>

  </div>
</div>