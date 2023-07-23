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

            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <h5 class="mb-2">Kategori</h5>
                <div class="row">
                    <?php foreach ($kategori as $key => $item) : ?>
                        <div class="col-md-4">
                            <a href="/pos?kat=<?= $item->idKategori ?>" style="color: inherit">
                                <div class="info-box">
                                    <span class="info-box-icon bg-<?= $item->colorKategori ?>"><i class="fas <?= $item->iconKategori ?>"></i></span>
                                    <div class="info-box-content">
                                        <span class="info-box-text"><?= $item->namaKategori ?></span>
                                    </div>
                                    <!-- /.info-box-content -->
                                </div>
                                <!-- /.info-box -->
                            </a>
                        </div>
                        <!-- /.col -->
                    <?php endforeach ?>
                </div>
                <div class="row">
                    <div class="col-md-9">
                        <div class="card card-default">
                            <div class="card-header">
                                <h1 class="card-title">
                                    <i class="fas fa-list"></i>
                                    Menu
                                </h1>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <?php foreach ($produk as $prd => $prod) : ?>
                                        <div class="col-md-3" onclick="addKeranjang('<?= $prod->idProduk ?>')">
                                            <div class="card shadow <?= $prod->isReadyProduk ? '' : 'card-disabled' ?>" >
                                                <img src="<?= base_url('assets/images/' . $prod->slugKategori . '/' . $prod->gambarProduk) ?>" class="card-img-top" style="height: 12rem;">
                                                <div class="card-body">
                                                    <h3 class="card-title"><strong><?= $prod->namaProduk ?> (<?= $prod->skuProduk ?>)</strong></h3>
                                                    <p class="card-text"><?= number_to_currency((float)$prod->hargaProduk, 'IDR', 'id_ID') ?></p>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card card-default">
                            <div class="card-header">
                                <h1 class="card-title">
                                    <i class="fas fa-shopping-cart"></i>
                                    Keranjang
                                </h1>
                            </div>
                            <div class="card-body">
                                <div id="itemKeranjang">
                                    <?php foreach ($keranjang as $key => $value) :?>
                                    <div class="callout callout-info">
                                        <div class="row">
                                            <div class="col-2 center">
                                                <h3><span class="badge badge-primary"><?=$value->jumlah?></span></h3>
                                            </div>
                                            <div class="col-8">
                                                <h5><?=$value->namaProduk?></h5>
                                                <p><?=$value->hargaProduk?></p>
                                            </div>
                                            <div class="col-2">
                                            <button type="button" class="btn btn-danger"><i class="fas fa-trash"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                    <?php endforeach?>
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
                <!-- /.row -->
        </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <?= view('layout/layoutMainFooter') ?>
</div>
<!-- ./wrapper -->
<?= $this->endSection() ?>