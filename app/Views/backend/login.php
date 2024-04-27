<!DOCTYPE html>
<html lang="en">

<head>
    <title><?= $title; ?></title>

    <?= $this->include('template/adminlte/head') ?>
</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <a href="#"><b>HFD </b>APP</a>
        </div>
        <div class="card">
            <div class="card-body login-card-body rounded">
                <p class="login-box-msg">Halaman Login Admin</p>
                <?php if (session()->getFlashdata('error')) : ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong><?= session()->getFlashdata('error'); ?></strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                <?php endif; ?>
                <form action="<?= url_to('backend.login'); ?>" method="post">
                    <?= csrf_field(); ?>
                    <div class="input-group mb-3">
                        <input type="text" id="username" name="username" class="form-control" value="<?= old('username'); ?>" placeholder="Username" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" id="password" name="password" class="form-control" placeholder="Password" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <!-- <div class="col-8">
                            <div class="icheck-primary">
                                <input type="checkbox" id="remember">
                                <label for="remember">
                                    Remember Me
                                </label>
                            </div>
                        </div> -->
                        <div class="col-12 pt-2">
                            <button type="submit" class="btn btn-primary btn-block btnLogin">Login</button>
                        </div>
                    </div>
                </form>
                <!-- <p class="mb-1">
                    <a href="#">I forgot my password</a>
                </p>
                <p class="mb-0">
                    <a href="#" class="text-center">Register a new membership</a>
                </p> -->
            </div>
        </div>
    </div>
    <small class="text-muted mt-1">Copyright &copy; 2023 <a href="#">HFD Corp</a>. All rights reserved.</small>

    <?= $this->include('template/adminlte/script') ?>
</body>

</html>