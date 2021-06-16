<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Account</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active">Account Settings /</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <section>
        <div class="container-fluid">
            <div class="card">
                <form id="edit">
                    <input type="hidden" name="id_user">
                    <div class="card-body">
                        <div class="row mb-3">
                            <label class="col-md-3">Fullname</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" value="<?= $user['fullname'] ?>" name="fullname" placeholder="Fullname" onkeypress="return /^[A-Z ]*$/i.test(event.key)" readonly />
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-md-3 col-6">Password</label>
                            <div class="col-md-3 col-6">
                                <input type="password" class="form-control" value="<?= $user['password'] ?>" name="password" readonly />
                            </div>
                            <label class="col-md-3 col-6">Section</label>
                            <div class="col-md-3 col-6">
                                <input type="text" class="form-control" value="" readonly>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-md-3 col-6">Export Pdf </label>
                            <div class="col-md-3 col-6"> <?php if ($this->session->userdata('pdf') == 1) {
                                                                echo "<div class='badge badge-success'>Access</div>";
                                                            } else {
                                                                echo "<div class='badge badge-danger'>No Access</div>";
                                                            } ?>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-md-3 col-6">Export Excel </label>
                            <div class="col-md-3 col-6"> <?php if ($this->session->userdata('excel') == 1) {
                                                                echo "<div class='badge badge-success'>Access</div>";
                                                            } else {
                                                                echo "<div class='badge badge-danger'>No Access</div>";
                                                            } ?>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-md-3 col-6">Import File Excel </label>
                            <div class="col-md-3 col-6"> <?php if ($this->session->userdata('import') == 1) {
                                                                echo "<div class='badge badge-success'>Access</div>";
                                                            } else {
                                                                echo "<div class='badge badge-danger'>No Access</div>";
                                                            } ?>
                            </div>
                        </div>
                        <div class="row float-right">
                            <button type="button" class="btn btn-warning" onclick=changePw()> <i class="fas fa-key"></i>Change Password</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>