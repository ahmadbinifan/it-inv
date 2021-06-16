<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-red elevation-4">
  <a href="" class="brand-link bg-red">
    <img src="<?= base_url('assets/'); ?>dist/img/default/logon.png"" alt=" Logo Bakrie" class="brand-image img-circle elevation-2 bg-white" style="opacity: .8">
    <span class="brand-text font-weight-white" style="font-size: 11pt; color:white;">Bakrie Renewable Chemicals</span>
  </a>
  <div class="sidebar">
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="<?= base_url('assets/'); ?>dist/img/default/admin.png" class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">
        <a class="d-block"><?= $this->session->userdata('fullname'); ?></a>
      </div>
    </div>
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item has-treeview menu-open">
          <a href="<?= base_url('home') ?>" class="nav-link <?php if ($this->uri->segment(1) == "home") {
                                                              echo 'active';
                                                            } ?>">
            <i class="nav-icon fas fa-home"></i>
            <p>
              Dashboard
            </p>
          </a>
        </li>
        <li class="nav-header">Company List</li>
        <li class="nav-item has-treeview">
          <a href="" class="nav-link <?php if ($this->uri->segment(1) == "pemasukan_dsip") {
                                        echo 'active';
                                      } elseif ($this->uri->segment(1) == "pengeluaran_dsip") {
                                        echo 'active';
                                      } ?>">
            <i class=" nav-icon fas fa-star"></i>
            <p>PT. DSIP</p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item has-treeview">
              <a href="<?= base_url('pemasukan_dsip') ?>" class="nav-link <?php if ($this->uri->segment(1) == "pemasukan_dsip") {
                                                                            echo 'active';
                                                                          } elseif ($this->uri->segment(1) == "import_excel_dsip") {
                                                                            echo 'active';
                                                                          }
                                                                          ?>">
                <i class=" fas fa-angle-double-down nav-icon"></i>
                <p>Pemasukan Barang</p>
              </a>
          </ul>
          <ul class="nav nav-treeview">
            <li class="nav-item has-treeview">
              <a href="<?= base_url('pengeluaran_dsip') ?>" class="nav-link <?php if ($this->uri->segment(1) == "pengeluaran_dsip") {
                                                                              echo 'active';
                                                                            } elseif ($this->uri->segment(1) == "import_excel_pengeluaran_dsip") {
                                                                              echo 'active';
                                                                            }
                                                                            ?>">
                <i class="fas fa-angle-double-up nav-icon nav-icon-sm"></i>
                <p>Pengeluaran Barang</p>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-item has-treeview">
          <a href="" class="nav-link <?php if ($this->uri->segment(1) == "pemasukan_sip") {
                                        echo 'active';
                                      } elseif ($this->uri->segment(1) == "pengeluaran_sip") {
                                        echo 'active';
                                      } ?>">
            <i class=" nav-icon fas fa-star"></i>
            <p>PT. SIP</p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item has-treeview">
              <a href="<?= base_url('pemasukan_sip') ?>" class="nav-link <?php if ($this->uri->segment(1) == "pemasukan_sip") {
                                                                            echo 'active';
                                                                          }
                                                                          ?>">
                <i class=" fas fa-angle-double-down nav-icon"></i>
                <p>Pemasukan Barang</p>
              </a>
          </ul>
          <ul class="nav nav-treeview">
            <li class="nav-item has-treeview">
              <a href="<?= base_url('pengeluaran_sip') ?>" class="nav-link <?php if ($this->uri->segment(1) == "pengeluaran_sip") {
                                                                              echo 'active';
                                                                            }
                                                                            ?>">
                <i class="fas fa-angle-double-up nav-icon nav-icon-sm"></i>
                <p>Pengeluaran Barang</p>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-item has-treeview">
          <a href="" class="nav-link <?php if ($this->uri->segment(1) == "#") {
                                        echo 'active';
                                      } elseif ($this->uri->segment(1) == "#") {
                                        echo 'active';
                                      } ?>">
            <i class=" nav-icon far fa-star"></i>
            <p>PT. DAIP</p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item has-treeview">
              <a href="<?= base_url('#') ?>" class="nav-link <?php if ($this->uri->segment(1) == "#") {
                                                                echo 'active';
                                                              } elseif ($this->uri->segment(1) == "#") {
                                                                echo 'active';
                                                              }
                                                              ?>">
                <i class=" fas fa-angle-double-down nav-icon"></i>
                <p>Pemasukan Barang</p>
              </a>
          </ul>
          <ul class="nav nav-treeview">
            <li class="nav-item has-treeview">
              <a href="<?= base_url('#') ?>" class="nav-link <?php if ($this->uri->segment(1) == "#") {
                                                                echo 'active';
                                                              } elseif ($this->uri->segment(1) == "#") {
                                                                echo 'active';
                                                              }
                                                              ?>">
                <i class="fas fa-angle-double-up nav-icon nav-icon-sm"></i>
                <p>Pengeluaran Barang</p>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-item has-treeview">
          <a href="" class="nav-link <?php if ($this->uri->segment(1) == "#") {
                                        echo 'active';
                                      } elseif ($this->uri->segment(1) == "#") {
                                        echo 'active';
                                      } ?>">
            <i class=" nav-icon far fa-star"></i>
            <p>PT. SMAP</p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item has-treeview">
              <a href="<?= base_url('#') ?>" class="nav-link <?php if ($this->uri->segment(1) == "#") {
                                                                echo 'active';
                                                              } elseif ($this->uri->segment(1) == "#") {
                                                                echo 'active';
                                                              }
                                                              ?>">
                <i class=" fas fa-angle-double-down nav-icon"></i>
                <p>Pemasukan Barang</p>
              </a>
          </ul>
          <ul class="nav nav-treeview">
            <li class="nav-item has-treeview">
              <a href="<?= base_url('#') ?>" class="nav-link <?php if ($this->uri->segment(1) == "#") {
                                                                echo 'active';
                                                              } elseif ($this->uri->segment(1) == "#") {
                                                                echo 'active';
                                                              }
                                                              ?>">
                <i class="fas fa-angle-double-up nav-icon nav-icon-sm"></i>
                <p>Pengeluaran Barang</p>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-item has-treeview">
          <a href="" class="nav-link <?php if ($this->uri->segment(1) == "#") {
                                        echo 'active';
                                      } elseif ($this->uri->segment(1) == "#") {
                                        echo 'active';
                                      } ?>">
            <i class=" nav-icon far fa-star"></i>
            <p>PT. FSC</p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item has-treeview">
              <a href="<?= base_url('#') ?>" class="nav-link <?php if ($this->uri->segment(1) == "#") {
                                                                echo 'active';
                                                              } elseif ($this->uri->segment(1) == "#") {
                                                                echo 'active';
                                                              }
                                                              ?>">
                <i class=" fas fa-angle-double-down nav-icon"></i>
                <p>Pemasukan Barang</p>
              </a>
          </ul>
          <ul class="nav nav-treeview">
            <li class="nav-item has-treeview">
              <a href="<?= base_url('#') ?>" class="nav-link <?php if ($this->uri->segment(1) == "#") {
                                                                echo 'active';
                                                              } elseif ($this->uri->segment(1) == "#") {
                                                                echo 'active';
                                                              }
                                                              ?>">
                <i class="fas fa-angle-double-up nav-icon nav-icon-sm"></i>
                <p>Pengeluaran Barang</p>
              </a>
            </li>
          </ul>
        </li>


        <?php if ($this->session->userdata('username') == "superuser") { ?>
          <li class="nav-header">Management User</li>
          <li class="nav-item has-treeview">
            <a href="<?= base_url('user') ?>" class="nav-link <?php if ($this->uri->segment(1) == "user") {
                                                                echo 'active';
                                                              } ?>">
              <i class="nav-icon fas fa-user-cog"></i>
              <p>User</p>
            </a>
          </li>
        <?php } ?>
      </ul>
    </nav>
  </div>
</aside>