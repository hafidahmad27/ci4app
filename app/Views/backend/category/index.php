<?= $this->extend('backend/layouts/index') ?>

<?= $this->section('content') ?>

<div class="col-md-8">
    <div class="card card-primary card-outline">
        <div class="card-body">
            <?= session()->getFlashdata('message'); ?>
            <table id="example1" class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th width="5%">#</th>
                        <th width="50%">Nama Kategori</th>
                        <th width="25%" style="text-align: center;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1;
                    foreach ($categories as $category) : ?>
                        <tr>
                            <td><?= $no++ ?></td>

                            <!-- FORM UPDATE START -->
                            <form action="<?= url_to('backend.category.update'); ?>" method="post" class="d-inline">
                                <td>
                                    <div style="display: none;"><?= $category['category_name']; ?></div>
                                    <input type="text" name="category_name" maxlength="30" class="form-control" value="<?= $category['category_name']; ?>">
                                </td>

                                <!-- TD ACTION (UPDATE & DELETE) START -->
                                <td width="15%" align="center">
                                    <input type="hidden" name="id" value="<?= $category['id'] ?>">
                                    <button type="submit" class="btn btn-primary btn-sm"><i class="nav-icon fas fa-sync"></i> Update</button>
                            </form>
                            <!-- /.FORM UPDATE END -->

                            <?php if (session()->get('level') == 'superadmin') : ?>
                                <form action="<?= url_to('backend.category.delete'); ?>" method="post" class="d-inline"> |
                                    <input type="hidden" name="id" value="<?= $category['id'] ?>">
                                    <button type="submit" class="btn btn-danger btn-sm"><i class="nav-icon fas fa-trash"></i></button>
                                </form>
                            <?php endif ?>
                            </td><!-- /.TD ACTION (UPDATE & DELETE) END -->
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="col-md-4">
    <div class="card card-primary">
        <div class="card-header bg-primary">
            <h3 class="card-title">Form Tambah Kategori</h3>
        </div>
        <div class="card-body">
            <?= session()->getFlashdata('message_add'); ?>
            <form action="<?= url_to('backend.category.insert'); ?>" method="post">
                <?= csrf_field(); ?>
                <div class="form-group">
                    <label>Nama Kategori</label>
                    <input type="text" name="category_name" maxlength="30" class="form-control" autofocus required>
                </div>
                <button type="submit" class="btn btn-primary form-control mt-3"><i class="fas fa-plus"></i> Add</button>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection() ?>