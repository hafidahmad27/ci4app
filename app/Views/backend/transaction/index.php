<?= $this->extend('template/adminlte/layout') ?>

<?= $this->section('content') ?>

<div class="col-12">
    <div class="card card-primary">
        <div class="card-body">
            <?= session()->getFlashdata('message'); ?>
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Column 1</th>
                        <th>Column 2</th>
                        <th>Column 3</th>
                        <th>Column 4</th>
                        <th style="text-align: center;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td align="justify"></td>
                        <td width="12%" align="center">
                            <button type="button" class="btn btn-primary btn-sm btnEditItem"><i class=" nav-icon fas fa-edit"></i></button>
                            <form action="" method="post" class="d-inline"> |
                                <?= csrf_field(); ?>
                                <input type="hidden" name="id" value="">
                                <button type="submit" class="btn btn-danger btn-sm"><i class="nav-icon fas fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
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

<?= $this->endSection() ?>