<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">PT. SIP - IT Inventory Report </h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">Home</li>
                        <li class="breadcrumb-item">Master</li>
                        <li class="breadcrumb-item active">Pengeluaran Barang</li>
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
                    <?php if (!empty($this->session->flashdata('status'))) { ?>
                        <div class="alert alert-info" role="alert"><?= $this->session->flashdata('status'); ?></div>
                    <?php } ?>
                    <?php if ($this->session->userdata('import') == 1) { ?>
                        <form action="<?= base_url('Pengeluaran_Sip/import_excel'); ?>" method="post" class="form-horizontal" enctype="multipart/form-data">
                            <div class="row mb-2">
                                <label class="col-2 col-md-3">Pilih File Excel</label>
                                <div class="col-3 col-md-7">
                                    <input type="file" name="fileExcel" class="form-control" required accept=".xls, .xlsx">
                                </div>
                                <button class='btn btn-success' type="submit">
                                    Import
                                    <i class="fas fas fa-upload"></i>
                                </button>
                            </div>
                        </form>
                    <?php } ?>
                    <form id="form-filter" class="form-horizontal">
                        <div class="row mb-2">
                            <label class="col-2 col-md-3">Period</label>
                            <div class="col-3 col-md-3">
                                <input type="date" class="form-control " name="TGLINVOICE" id="start" />
                            </div>
                            <label class="col-6 col-md-2">To</label>
                            <div class="col-md-3 col-6">
                                <input type="date" class="form-control" name="TGLINVOICE_KLR" id="end" />
                            </div>
                        </div>

                        <div class="float-right">
                            <button type="button" id="btn-filter" class="btn btn-primary ">Filter
                                <i class="fas fas fa-sort"></i></button>
                            <button type="button" id="btn-reset" class="btn btn-default">Reset
                                <i class="fas fas fa-undo"></i></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <!-- <button type="button" class="btn btn-primary" onclick=create()> <i class="fas fa-plus"></i> Input Data</button> -->
                <div class="table-responsive mt-4">
                    <table id="tablePengeluaran" class="table table-sm">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>JenisDok.</th>
                                <th>Dok.NoPabean</th>
                                <th>Tgl.Pabean</th>
                                <th>No.Invoice</th>
                                <th>Tgl.Invoice</th>
                                <th>NamaPembeli</th>
                                <th>KodeBarang</th>
                                <th>NamaBarang</th>
                                <th>Unit</th>
                                <th>Qty</th>
                                <th>MataUang</th>
                                <th>NilaiBarang</th>
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