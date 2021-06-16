<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style type="text/css">
        @page {}

        /* body {
            margin: 3px;
        } */
        #footer {
            position: fixed;
            right: 0px;
            bottom: 10px;
            text-align: center;

        }

        #footer .page:after {
            content: counter(page, decimal);
        }

        p {
            font-size: 10px;
        }

        p.custom {
            font-size: 13px;
        }

        p.form {
            font-size: 8px;
            text-align: start;
            float: right;
        }

        img {
            float: left;
        }

        table,
        th {
            border: 1px solid black;
        }

        td {
            border: 1px solid black;
            font-size: 8px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-family: Arial, Helvetica, sans-serif;
            font-size: 10px;
            text-align: center;
            font-weight: bold;
            /* text-transform: uppercase; */
            page-break-inside: auto
        }

        div.bold {
            font-size: 10px;
            tab-size: 8;
        }

        .border-top {
            border-top-style: solid;
            border-bottom-style: solid;
        }

        .center {
            margin-left: auto;
            margin-right: auto;
        }

        tr {
            page-break-inside: avoid;
            page-break-after: auto;
        }

        table.noborder {
            width: 100%;
        }

        thead {
            display: table-header-group
        }

        tfoot {
            display: table-footer-group
        }

        #box1 {
            width: 80px;
            font-size: 8px;
            font-family: 'Times New Roman', Times, serif;
            height: 40px;
            background: white;
            border: solid 1px black;
            float: right;
        }

        hr {
            border-top: 0.5px solid;
        }

        .tab {
            display: inline-block;
            margin-left: 40px;
        }
    </style>

    <title><?= $title ?></title>
</head>

<body>
    <h4><?= $title ?> <br><?= $title2 ?></h4>
    <p><?= $date ?></p>

    <table>
        <thead style="font-size: 11px;">

            <tr>
                <th>No.</th>
                <th>Jenis Dok.</th>
                <th>Dok.No. Pabean</th>
                <th>Tgl Pabean</th>
                <th>No. Invoice</th>
                <th>Tgl. Invoice</th>
                <th>Nama Pembeli</th>
                <th>Kode Barang</th>
                <th>Nama Barang</th>
                <th>Unit</th>
                <th>Qty</th>
                <th>Mata Uang</th>
                <th>Nilai Barang</th>
            </tr>
        </thead>
        <tbody>

            <?php
            $count = 0;
            foreach ($header as $value) {
                $count = $count + 1;
            ?>
                <tr>

                    <td><?= $count ?></td>
                    <td><?= $value['JENISDOK'] ?></td>
                    <td><?= $value['DOKNOPABEAN'] ?></td>
                    <td><?= $value['TGLPABEAN'] ?></td>
                    <td><?= $value['NOINVOICE'] ?></td>
                    <td><?= date('d-M-Y', strtotime($value['TGLINVOICE'])) ?></td>
                    <td><?= $value['NAMAPEMBELI'] ?></td>
                    <td><?= $value['KODEBARANG'] ?></td>
                    <td><?= $value['NAMABARANG'] ?></td>
                    <td><?= $value['UNIT'] ?></td>
                    <td><?= $value['QTY'] ?></td>
                    <td><?= $value['MATAUANG'] ?></td>
                    <td><?= number_format($value['NILAIBARANG']) ?></td>
                </tr>
                $value[''] <?php } ?>
        </tbody>
    </table>
    <div id="footer">
        <p class="page">Page
    </div>
</body>

</html>
<!-- <script>
    window.print();
</script> -->