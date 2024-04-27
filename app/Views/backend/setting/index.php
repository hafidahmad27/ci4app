<?= $this->extend('template/adminlte/layout') ?>

<?= $this->section('content') ?>

<div class="col-md-6">
    <div class="card">
        <div class="card-header bg-primary">
            <h3 class="card-title">Ubah Profil</h3>
        </div>
        <form action="<?= url_to('backend.setting.changeProfil'); ?>" method="post">
            <?= csrf_field(); ?>
            <input type="hidden" name="id" value="<?= $table['id'] ?>">
            <div class="card-body">
                <?= session()->getFlashdata('message') ?>
                <div class="row">
                    <div class="form-group col-md-7">
                        <label>Nama</label>
                        <input type="text" name="name" value="<?= $table['name'] ?>" class="form-control" <?= $table['level'] != 'superadmin' ? 'readonly' : ''; ?>>
                    </div>
                    <div class="form-group col-md-5">
                        <label>Level</label>
                        <input type="text" value="<?= strtoupper($table['level']) ?>" class="form-control" readonly>
                    </div>
                </div>
                <div class="form-group">
                    <label>Username</label>
                    <input type="text" name="username" value="<?= $table['username'] ?>" class="form-control" placeholder="Masukkan username baru..">
                </div>
                <button type="submit" class="btn btn-primary mt-3"><i class="fas fa-sync"></i>&nbsp; Ubah Profil</button>
            </div>
        </form>
    </div>
</div>

<div class="col-md-6">
    <div class="card">
        <div class="card-header bg-primary">
            <h3 class="card-title">Ubah Password</h3>
        </div>
        <form action="<?= url_to('backend.setting.changePassword'); ?>" method="post">
            <?= csrf_field(); ?>
            <input type="hidden" name="id" value="<?= $table['id'] ?>">
            <div class="card-body">
                <?php if (password_verify($table['username'], $table['password']) && $table['level'] != 'superadmin') : ?>
                    <div class="alert alert-info" role="alert">
                        <i class="fas fa-info-circle"></i> <b>Disarankan agar mengganti password yang masih default !<b>
                    </div>
                <?php endif ?>
                <?= session()->getFlashdata('message-password') ?>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control" placeholder="Masukkan password baru..">
                </div>
                <button type="submit" class="btn btn-primary mt-3"><i class="fas fa-sync"></i>&nbsp; Ubah Password</button>
            </div>
        </form>
    </div>
</div>

<?= $this->endSection() ?>