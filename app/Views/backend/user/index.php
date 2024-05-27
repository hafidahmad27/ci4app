<?= $this->extend('backend/layouts/index') ?>

<?= $this->section('content') ?>

<div class="col-md-8">
    <div class="card card-primary card-outline">
        <div class="card-body">
            <?= session()->getFlashdata('message'); ?>
            <table id="example1" class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama</th>
                        <th>Username</th>
                        <th>Password</th>
                        <th style="text-align: center;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1;
                    foreach ($users as $user) : ?>
                        <?php if ($user['role_id'] != 1) : ?>
                            <tr class="<?= $user['is_active'] != 0 ? '' : 'bg-dark'; ?>">
                                <td><?= $no++ ?></td>
                                <td>
                                    <?php if ($user['role_id'] == 2) : ?>
                                        <?= $user['name']; ?> <span class="badge badge-info"><?= strtoupper($user['role_name']) ?></span>
                                    <?php elseif ($user['role_id'] == 3) : ?>
                                        <?= $user['name']; ?> <span class="badge badge-secondary"><?= strtoupper($user['role_name']) ?></span>
                                    <?php endif ?>
                                </td>
                                <td><?= $user['username']; ?></td>
                                <td>
                                    <?php if (password_verify($user['username'], $user['password'])) { ?>
                                        DEFAULT
                                    <?php } else { ?>
                                        ********
                                        <form action="<?= url_to('backend.user.resetPassword'); ?>" method="post" class="d-inline float-right">
                                            <?= csrf_field(); ?>
                                            <input type="hidden" name="id" value="<?= $user['id'] ?>">
                                            <button type="submit" class="btn btn-light btn-sm"><i class="nav-icon fas fa-sync-alt"></i></button>
                                        </form>
                                    <?php } ?>
                                </td>
                                <td width="25%" align="center">
                                    <button type="button" class="btn btn-primary btn-sm btnEditUser" data-id="<?= $user['id'] ?>" data-toggle="modal" data-target="#staticBackdrop"><i class=" nav-icon fas fa-edit"></i></button>
                                    <form action="<?= url_to('backend.user.userStatus'); ?>" method="post" class="d-inline"> |
                                        <input type="hidden" name="id" value="<?= $user['id'] ?>">
                                        <?php if ($user['is_active'] == 1) { ?>
                                            <button type="submit" class="btn btn-outline-dark btn-sm"><i class="fas fa-toggle-on"></i></button>
                                        <?php } else { ?>
                                            <button type="submit" class="btn btn-outline-light btn-sm"><i class="fas fa-toggle-off"></i></button>
                                        <?php } ?>
                                    </form>
                                    <?php if (session()->get('role_id') == 1) : ?>
                                        <form action="<?= url_to('backend.user.delete'); ?>" method="post" class="d-inline"> |
                                            <?= csrf_field(); ?>
                                            <input type="hidden" name="id" value="<?= $user['id'] ?>">
                                            <button type="submit" class="btn btn-danger btn-sm"><i class="nav-icon fas fa-trash"></i></button>
                                        </form>
                                    <?php endif ?>
                                </td>
                            </tr>
                        <?php endif ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="col-md-4">
    <div class="card card-primary">
        <div class="card-header bg-primary">
            <h3 class="card-title">Form Tambah User</h3>
        </div>
        <div class="card-body">
            <?= session()->getFlashdata('message_add'); ?>
            <form action="<?= url_to('backend.user.insert'); ?>" method="post">
                <?= csrf_field(); ?>
                <div class="form-group">
                    <label>Nama</label>
                    <input type="text" name="name" maxlength="50" class="form-control" placeholder="Nama user.." required>
                </div>
                <div class="row">
                    <div class="form-group col-md-7">
                        <label>Username</label>
                        <input type="text" name="username" maxlength="25" class="form-control" placeholder="Username.." required>
                    </div>
                    <div class="form-group col-md-5">
                        <label>Role</label>
                        <select name="role_id" class="form-control" required>
                            <?php foreach ($role_options as $role_option) : ?>
                                <option value="<?= $role_option['id']; ?>"><?= strtoupper($role_option['role_name']); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <small class="font-weight-bolder">*) Default password = username</small>
                <button type="submit" class="btn btn-primary form-control mt-3"><i class="fas fa-plus"></i> Add</button>
            </form>
        </div>
    </div>
</div>

<!-- MODAL FORM Edit User -->
<div class="modal fade" id="staticBackdrop" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Form Edit User</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= url_to('backend.user.update'); ?>" method="post" id="formEditUser">
                    <input type="hidden" name="id">
                    <div class="form-group">
                        <label>Nama</label>
                        <input type="text" id="name" name="name" maxlength="50" class="form-control" placeholder="Nama user.." required>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-7">
                            <label>Username</label>
                            <input type="text" id="username" name="username" maxlength="25" class="form-control" placeholder="Username.." required>
                        </div>
                        <div class="form-group col-md-5">
                            <label>Role</label>
                            <select id="role_id" name="role_id" class="form-control" required>
                                <?php foreach ($role_options as $role_option) : ?>
                                    <option value="<?= $role_option['id']; ?>"><?= strtoupper($role_option['role_name']); ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <small class="font-weight-bolder">*) Default password = username</small>
                    <button type="submit" class="btn btn-primary float-right"><i class="nav-icon fas fa-sync"></i> &nbsp;Update</button>
                </form>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<?= $this->endSection() ?>