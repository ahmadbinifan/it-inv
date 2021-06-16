<nav class="main-header navbar navbar-expand navbar-red navbar-dark">
  <!-- Left navbar links -->
  <ul class="navbar-nav bg-red">
    <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" href="" role="button"><i class="fas fa-bars"></i></a>
    </li>
  </ul>
  <ul class="navbar-nav ml-auto">
    <li class="nav-item dropdown">
      <a class="nav-link" data-toggle="dropdown" href="">
        <i class="far fa-user"></i>
        <span class="badge badge-dark navbar-badge"></span>
      </a>
      <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
        <span class="dropdown-item dropdown-header">
          <?php
          // Clock in indonesia
          date_default_timezone_set('Asia/Jakarta');
          // 24 Hours
          $Hour = date('G');

          if ($Hour >= 5 && $Hour <= 11) {
            echo "Good Morning";
          } else if ($Hour >= 12 && $Hour <= 18) {
            echo "Good Afternoon";
          } else if ($Hour >= 19 || $Hour <= 4) {
            echo "Good Evening";
          }
          ?>,
          <?= $this->session->userdata('fullname'); ?></span>
        <div class="dropdown-divider"></div>
        <div class="container ml-1">
          <div class="col-2">
            <i class="fas fa-house-user mr-2"></i>
          </div>
          <div class="col-10 text-right">
            <p> <?= $this->session->userdata('username'); ?></p>
          </div>
        </div>

        <!-- <div class="container ml-1">
          <div class="col-2">
            <i class="fas fa-user-friends mr-2"></i>
          </div>
          <div class="col-10 text-right">
            <p>bup</p>
          </div>
        </div>
        <div class="container ml-1">
          <div class="col-2">
            <i class="fas fas fa-building mr-2"></i>
          </div>
          <div class="col-10 text-right">
            <p>bep</p>
          </div>
        </div>

        <div class="container ml-1">
          <div class="col-2">
            <i class="fas fa-users mr-2"></i>
          </div>
          <div class="col-10 text-right">
            <b>bop</b>
          </div>
        </div> -->
        <div class="dropdown-divider"></div>
        <div class="container">
          <div class="col-6">
            <a class="dropdown-item dropdown-footer" href="<?= base_url('account') ?>">
              <i class="fas fa-key fa-sm fa-fw mr-2 text-gray-400"></i>Account
            </a>
          </div>
          <div class="col-6">
            <a href="<?= base_url('auth/logout') ?>" class="dropdown-item dropdown-footer">
              <i class="fas fa-sign-out-alt fa-md fa-fw mr-2 text-gray-400"></i>Logout
            </a>
          </div>
        </div>
      </div>
    </li>
  </ul>
</nav>