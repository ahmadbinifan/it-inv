<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">User</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">Home</li>
                        <li class="breadcrumb-item active">User</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <button type="button" class="btn btn-primary" onclick=clearAdd() data-toggle="modal" data-target="#modalAdd" data-backdrop='static' data-keyboard='false'> <i class="fas fa-plus"></i> Input Data</button>
                    <div class="table-responsive mt-4">
                        <table id="tableUser" class="table table-sm">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Fullname</th>
                                    <th>Username</th>
                                    <th>User Status</th>
                                    <th>Pdf</th>
                                    <th>Excel</th>
                                    <th>Import</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" id="modalAdd" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-5">
                            <h3>Create User</h3>
                        </div>
                        <div class="col-7 text-right">
                            <button class="btn btn-danger btn-sm" onclick="$('#modalAdd').modal('hide');">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <form id="create">
                    <div class="card-body">
                        <div class="row mb-3">
                            <label class="col-md-3">Fullname</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" name="fullname" placeholder="Fullname" onkeypress="return /^[A-Z ]*$/i.test(event.key)" required />
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-md-3 col-6">Username</label>
                            <div class="col-md-3 col-6">
                                <input type="text" class="form-control" name="username" onkeypress="return /^[0-9A-Z ]*$/i.test(event.key)" placeholder="Username" required />
                            </div>
                            <label class="col-6 col-md-3">Password</label>
                            <div class="col-6 col-md-3">
                                <input type="password" name="password" class="form-control" placeholder="Password" required />
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-md-3 col-6">Pdf</label>
                            <div class="col-md-3 col-6">
                                <select name="pdf">
                                    <option value="">Choose</option>
                                    <option value="0">No</option>
                                    <option value="1">Yes</option>
                                </select>
                            </div>
                            <label class="col-md-3 col-6">Import</label>
                            <div class="col-md-3 col-6">
                                <select name="import">
                                    <option value="">Choose</option>
                                    <option value="0">No</option>
                                    <option value="1">Yes</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-md-3 col-6">Excel</label>
                            <div class="col-md-3 col-6">
                                <select name="excel">
                                    <option value="">Choose</option>
                                    <option value="0">No</option>
                                    <option value="1">Yes</option>
                                </select>
                            </div>
                            <label class="col-md-3 col-6">Section</label>
                            <div class="col-md-3 col-6">
                                <input type="text" name="section" class="form-control" placeholder="Section">
                            </div>
                        </div>
                        <div class="row float-right">
                            <button class="btn btn-info mr-2" type="submit">Submit</button>
                            <button class="btn btn-danger" onclick="$('#modalAdd').modal('hide');">Cancel</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" id="modalEdit" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-5">
                            <h3>User Detail Information</h3>
                        </div>
                        <div class="col-7 text-right">
                            <button class="btn btn-danger btn-sm" onclick="$('#modalEdit').modal('hide');">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <form id="edit">
                    <input type="hidden" name="id_user">
                    <div class="card-body">
                        <div class="row mb-3">
                            <label class="col-md-3">Fullname</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" name="fullname" placeholder="Fullname" onkeypress="return /^[A-Z ]*$/i.test(event.key)" required />
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-6 col-md-3">Password</label>
                            <div class="col-6 col-md-9">
                                <input type="password" name="password" class="form-control" placeholder="Password" required />
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-md-3 col-6">Pdf</label>
                            <div class="col-md-3 col-6">
                                <select name="pdf" id="pdf">
                                    <option value="">Choose</option>
                                    <option value="0">No</option>
                                    <option value="1">Yes</option>
                                </select>
                            </div>
                            <label class="col-md-3 col-6">Import</label>
                            <div class="col-md-3 col-6">
                                <select name="import" id="import">
                                    <option value="">Choose</option>
                                    <option value="0">No</option>
                                    <option value="1">Yes</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-md-3 col-6">Excel</label>
                            <div class="col-md-3 col-6">
                                <select name="excel" id="excel">
                                    <option value="">Choose</option>
                                    <option value="0">No</option>
                                    <option value="1">Yes</option>
                                </select>
                            </div>
                            <label class="col-md-3 col-6">Section</label>
                            <div class="col-md-3 col-6">
                                <input type="text" name="section" class="form-control" placeholder="Section">
                            </div>
                        </div>
                        <div class="row float-right">
                            <button class="btn btn-info mr-2" type="submit">Update</button>
                            <button class="btn btn-danger" type="button" onclick="$('#modalEdit').modal('hide');">Cancel</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>