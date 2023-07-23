<?= $this->extend('layout/layoutLogin'); ?>
<?= $this->section('content') ?>

<body class="hold-transition login-page">
    <div class="login-box">
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <a href="<?= url_to('forgot') ?>" class="h1"><?= lang('Auth.forgotPassword') ?></a>
            </div>
            <div class="card-body">
                <p class="login-box-msg">
                    <?= view('Myth\Auth\Views\_message_block') ?>
                <p><?= lang('Auth.enterEmailForInstructions') ?></p>
                </p>
                <form action="<?= url_to('forgot') ?>" method="post">
                    <?= csrf_field() ?>
                    <div class="input-group mb-3">
                        <input type="email" class="form-control <?php if (session('errors.email')) : ?>is-invalid<?php endif ?>" placeholder="<?= lang('Auth.emailAddress') ?>">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                        <div class="invalid-feedback">
                            <?= session('errors.email') ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary btn-block"><?= lang('Auth.sendInstructions') ?></button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>

                <p class="mt-3 mb-1">
                    <a href="<?= url_to('login') ?>"><?= lang('Auth.loginTitle') ?></a>
                </p>
            </div>
            <!-- /.login-card-body -->
        </div>
    </div>
    <!-- /.login-box -->
    <?= $this->endSection() ?>