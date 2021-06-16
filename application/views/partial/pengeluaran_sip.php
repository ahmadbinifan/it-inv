<script type="text/javascript">
    function formatNumber(num) {
        return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
    }
    var table;
    $(document).ready(function() {
        $('#btn-filter').on('click', function() {
            table.page.len(-1).draw();
        });
        table = $('#tablePengeluaran').DataTable({

            "order": [
                [1, "desc"]
            ],
            "scrollY": "400px",
            "scrollX": "100%",
            "scrollCollapse": true,
            "select": true,
            "processing": true,
            "serverSide": true,
            "retrieve": true,
            "ajax": {
                "url": "<?= base_url('Pengeluaran_Sip/ajax_list') ?>",
                "type": "POST",
                "data": function(data) {
                    data.TGLINVOICE = $('#start').val();
                    data.TGLINVOICE_KLR = $('#end').val();
                }
            },
            "columnDefs": [{
                "targets": [0], //first column / numbering column
                "orderable": false,
            }, ],

            buttons: [
                <?php if ($this->session->userdata('excel') == 1) { ?> {
                        "text": '<span class="fas fa-file-excel">Excel</span>',
                        "className": 'btn btn-success btn-sm',
                        action: function previewData() {
                            let start = $('#start').val();
                            let end = $('#end').val();
                            let url = "<?= base_url('report/excel_pengeluaran_sip/') ?>" + start + "/" + end;
                            window.open(url, "_blank");
                        }
                    },
                <?php } ?>
                <?php if ($this->session->userdata('pdf') == 1) { ?> {
                        "text": '<span class="fas fa-file-pdf">Pdf</span>',
                        "className": 'btn btn-danger btn-sm',
                        action: function previewData() {
                            let start = $('#start').val();
                            let end = $('#end').val();
                            let url = "<?= base_url('report/pdf_pengeluaran_sip/') ?>" + start + "/" + end;
                            window.open(url, "_blank");
                        }
                    },
                <?php } ?>
            ],
            dom: 'Blfrtip',
            lengthMenu: [
                [25, 50, 125, -1],
                ['25 File', '50 File', '125 File', 'Show All']
            ],
        });
        table.buttons().container()
            .appendTo('#tableTimbangan .col-md-6:eq(0)');

    });

    $('#btn-filter').click(function() { //button filter event click
        table.ajax.reload(); //just reload table
    });
    $('#btn-reset').click(function() { //button reset event click
        let form = $('#form-filter');
        $('#form-filter')[0].reset();
        table.ajax.reload(); //just reload table
    });
</script>