<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AdminLTE 3 | Dashboard</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= base_url('assets/plugins/fontawesome-free/css/all.min.css') ?>">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="<?= base_url('assets/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') ?>">
    <!-- iCheck -->
    <link rel="stylesheet" href="<?= base_url('assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css') ?>">
    <!-- JQVMap -->
    <link rel="stylesheet" href="<?= base_url('assets/plugins/jqvmap/jqvmap.min.css') ?>">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url('assets/dist/css/adminlte.min.css') ?>">
    <style>
        .card-disabled {
            background-color: #ccc;
            opacity: .4;
        }
    </style>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <?= $this->renderSection('content') ?>

    <!-- jQuery -->
    <!-- <script src="<? //= base_url('assets/plugins/jquery/jquery.min.js') 
                        ?>"></script> -->
    <!-- jQuery UI 1.11.4 -->
    <!-- <script src="<? //= base_url('assets/plugins/jquery-ui/jquery-ui.min.js') 
                        ?>"></script> -->
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- Bootstrap 4 -->
    <script src="<?= base_url('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
    <!-- daterangepicker -->
    <script src="<?= base_url('assets/plugins/moment/moment.min.js') ?>"></script>
    <script src="<?= base_url('assets/plugins/daterangepicker/daterangepicker.js') ?>"></script>
    <!-- AdminLTE App -->
    <script src="<?= base_url('assets/dist/js/adminlte.js') ?>"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="<?= base_url('assets/dist/js/demo.js') ?>"></script>

    <script>
        function addKeranjang(id) {
            $.ajax({
                url: "/pos",
                type: "POST",
                data: {
                    'idProduk': id
                },
                success: function(response) {
                    // console.log(response);


                    $('#itemKeranjang').empty();
                    let total = 0;
                    JSON.parse(response)['data'].map((item, idx) => {
                        total = total + parseInt(item.jumlah) * parseInt(item.hargaProduk)
                        let ele = '';
                        ele += '<div class="callout callout-info">'
                        ele += '<div class="row">'
                        ele += '<div class="col-2 center">'
                        ele += '<h3><span class="badge badge-primary">' + item.jumlah + '</span></h3>'
                        ele += '</div>'
                        ele += '<div class="col-8">'
                        ele += '<h5>' + item.namaProduk + '</h5>'
                        ele += '<p>' + item.hargaProduk + '</p>'
                        ele += '</div>'
                        ele += '<div class="col-2">'
                        ele += '<button type="button" class="btn btn-danger"><i class="fas fa-trash"></i></button>'
                        ele += '</div>'
                        ele += '</div>'
                        ele += ' </div>'
                        $('#itemKeranjang').append(ele);
                    });

                    $('.harga').empty();
                    let formatCurrency = new Intl.NumberFormat('id-ID', {
                        style: 'currency',
                        currency: 'IDR',
                    }).format(total)
                    $('.harga').append('Total : ' + formatCurrency);
                },
                error: function(xhr, status, error) {
                    console.log('Error:', status, xhr);
                }
            })
        }
    </script>
</body>

</html>