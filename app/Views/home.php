<?= $this->extend('layout/layoutMain'); ?>
<?= $this->section('content') ?>
<div class="wrapper">

    <?= view('layout/layoutMainHeader') ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0"><?= $title ?></h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <?php foreach ($breadcrumbs as $key => $value) : ?>
                                <li class="breadcrumb-item <?= ($key == (count($breadcrumbs) - 1)) ? 'active' : '' ?>"><?= ($key == (count($breadcrumbs) - 1)) ? $value : '<a href="/">' . $value . '</a>' ?></li>
                            <?php endforeach ?>
                            <!-- <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Dashboard v1</li> -->
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">

            </div>
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <?= view('layout/layoutMainFooter') ?>
</div>
<!-- ./wrapper -->
<?= $this->endSection() ?>