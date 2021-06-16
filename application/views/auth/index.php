<div class="login-logo">
  <a href=""><b>Bakrie Renewable Chemical</b></a>
</div>
<!-- /.login-logo -->
<div class="card">
  <div class="card-body login-card-body">
    <p class="login-box-msg">Please login first</p>

    <form action="<?= base_url('auth') ?>" method="post">
      <div class="input-group mb-3">
        <input type="text" class="form-control" placeholder="Username" name="username" id="username">
        <div class="input-group-append">
          <div class="input-group-text">
            <span class="fas fa-user-tie"></span>
          </div>
        </div>
      </div>
      <div class="input-group mb-3">
        <input type="password" class="form-control" placeholder="Password" name="password" id="password">
        <div class="input-group-append">
          <div class="input-group-text">
            <span class="fas fa-lock"></span>
          </div>
        </div>
      </div>
      <div class="row">
        <!-- <div class="col-6">
            <a href="https://api.whatsapp.com/send/?phone=6282267851093&text=Saya tidak Bisa login , bisa bantu saya?">
              <button type="button" class="btn btn-primary btn-block">Help</button>
            </a>
          </div> -->
        <div class="col-12">
          <button type="submit" class="btn btn-success btn-block">Login</button>
        </div>
      </div>
    </form>
    <!-- /.social-auth-links -->
  </div>
  <!-- /.login-card-body -->
</div>