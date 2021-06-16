        <footer class="main-footer">
            <strong>Copyright &copy; 2021 <a href="#">IT Team</a>.</strong>
            All rights reserved.
            <div class="float-right d-none d-sm-inline-block">
                <b>Version</b> 4.2.1
            </div>
        </footer>
        </div>


        <script src="<?= base_url('assets/'); ?>plugins/jquery/jquery.min.js"></script>
        <script src="<?= base_url('assets/'); ?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
        <script src="<?= base_url('assets/'); ?>plugins/sweetalert/sweetalert2.all.min.js"></script>
        <script src="<?= base_url('assets/'); ?>dist/js/adminlte.js"></script>
        <script src="<?= base_url('assets/'); ?>plugins/datatables/jquery.dataTables.min.js"></script>
        <script src="<?= base_url('assets/'); ?>plugins/bigInt/bigInt.min.js"></script>
        <script src="<?= base_url('assets/'); ?>plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
        <script src="<?= base_url('assets/'); ?>plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
        <!-- <script src="<?= base_url('assets/'); ?>plugins/datatables-bs4/Buttons/js/dataTables.button.min.js"></script> -->
        <script src="<?= base_url('assets/'); ?>plugins/button/dataTables.buttons.min.js"></script>

        <!-- <script src=" https://cdn.datatables.net/buttons/1.6.5/js/dataTables.buttons.min.js"></script>
        <script src=" https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
        <script src=" https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"> </script>
        <script src=" https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"> </script>
        <script src=" https://cdn.datatables.net/buttons/1.6.5/js/buttons.html5.min.js"> </script>
        <script src=" https://cdn.datatables.net/buttons/1.6.5/js/buttons.print.min.js"> </script> -->





        <script>
            $(document).ready(function() {
                $('select').select2();
            });
        </script>
        <?php
        // if ($this->uri->segment(1) == "capex") {
        //     $this->load->view('partial/capex.php');
        // } elseif ($this->uri->segment(1) == "section") {
        //     $this->load->view('partial/section.php');
        // } elseif ($this->uri->segment(1) == "position") {
        //     $this->load->view('partial/position.php');
        // } elseif ($this->uri->segment(1) == "uom") {
        //     $this->load->view('partial/uom.php');
        // } elseif ($this->uri->segment(1) == "division") {
        //     $this->load->view('partial/division.php');
        // } elseif ($this->uri->segment(1) == "departement") {
        //     $this->load->view('partial/departement.php');
        // } elseif ($this->uri->segment(1) == "currency") {
        //     $this->load->view('partial/currency.php');
        // } elseif ($this->uri->segment(1) == "user") {
        //     $this->load->view('partial/user.php');
        // }
        if ($this->uri->segment(1) != "home") {
            $this->load->view('partial/' . $this->uri->segment(1));
        }
        ?>
        </body>

        </html>