<?= $this->extend('template/adminlte/layout') ?>

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
                    foreach ($table as $users) : ?>
                        <?php if ($users['level'] != 'superadmin') : ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td>
                                    <?php if ($users['level'] == 'admin') : ?>
                                        <?= $users['name']; ?> <span class="badge badge-secondary"><?= strtoupper($users['level']) ?></span>
                                    <?php elseif ($users['level'] == 'pimpinan') : ?>
                                        <?= $users['name']; ?> <span class="badge badge-dark"><?= strtoupper($users['level']) ?></span>
                                    <?php endif ?>
                                </td>
                                <td><?= $users['username']; ?></td>
                                <td>
                                    <?php if (password_verify($users['username'], $users['password'])) { ?>
                                        DEFAULT
                                    <?php } else { ?>
                                        ********
                                        <form action="<?= url_to('backend.user.resetPassword'); ?>" method="post" class="d-inline float-right">
                                            <?= csrf_field(); ?>
                                            <input type="hidden" name="id" value="<?= $users['id'] ?>">
                                            <button type="submit" class="btn btn-light btn-sm"><i class="nav-icon fas fa-sync-alt"></i></button>
                                        </form>
                                    <?php } ?>
                                </td>
                                <td width="25%" align="center">
                                    <form action="<?= url_to('backend.user.userStatus'); ?>" method="post" class="d-inline">
                                        <input type="hidden" name="id" value="<?= $users['id'] ?>">
                                        <?php if ($users['is_active'] == 1) { ?>
                                            <button type="submit" class="btn btn-success btn-sm"><i class="fas fa-toggle-on"></i></button>
                                        <?php } else { ?>
                                            <button type="submit" class="btn btn-info btn-sm"><i class="fas fa-toggle-off"></i></button>
                                        <?php } ?>
                                    </form> |
                                    <button type="button" class="btn btn-primary btn-sm btnEditUser" data-id="<?= $users['id'] ?>" data-toggle="modal" data-target="#staticBackdrop">
                                        <i class=" nav-icon fas fa-edit"></i>
                                        <!--  -->
                                    </button>
                                    <?php if (session()->get('level') == 'superadmin') : ?>
                                        <form action="<?= url_to('backend.user.delete'); ?>" method="post" class="d-inline"> |
                                            <?= csrf_field(); ?>
                                            <input type="hidden" name="id" value="<?= $users['id'] ?>">
                                            <button type="submit" class="btn btn-danger btn-sm"><i class="nav-icon fas fa-trash"></i></button>
                                        </form>
                                    <?php endif ?>
                                </td>
                            </tr>
                        <?php endif ?>
                    <?php endforeach; ?>
                </tbody>
                <!-- <tfoot>
            <tr>
                <th>...</th>
                <th>...</th>
            </tr>
        </tfoot> -->
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
                <!-- <input type="hidden" name="id"> -->
                <div class="row">
                    <div class="form-group col-md-5">
                        <label>Level</label>
                        <select name="level" class="form-control" autofocus required>
                            <!-- level maxlength: 20 -->
                            <option value="" selected="selected" disabled="disabled">Pilih..</option>
                            <option value="admin">ADMIN</option>
                            <option value="pimpinan">PIMPINAN</option>
                        </select>
                    </div>
                    <div class="form-group col-md-7">
                        <label>Username</label>
                        <input type="text" name="username" maxlength="25" class="form-control" placeholder="Username.." required>
                    </div>
                </div>
                <div class="form-group">
                    <label>Nama</label>
                    <input type="text" name="name" maxlength="50" class="form-control" placeholder="Nama user.." required>
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
                            <label>Level</label>
                            <select id="level" name="level" class="form-control" required>
                                <!-- level maxlength level: 20 character -->
                                <option value="" selected="selected" disabled="disabled">Pilih..</option>
                                <option value="admin">ADMIN</option>
                                <option value="pimpinan">PIMPINAN</option>
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