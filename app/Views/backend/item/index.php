<?= $this->extend('template/adminlte/layout') ?>

<?= $this->section('content') ?>

<div class="col-12">
    <div class="card card-primary">
        <div class="card-body">
            <a href="<?= url_to('backend.item.form_add'); ?>" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i> Add Item</a>
            <?= session()->getFlashdata('message'); ?>
            <table id="example1" class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama Item</th>
                        <th>Kategori</th>
                        <th>Harga</th>
                        <th>Deskripsi</th>
                        <th style="text-align: center;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1;
                    foreach ($relations as $items) : ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $items['item_name']; ?></td>
                            <td><?= $items['category_name']; ?></td>
                            <td><?= number_format($items['price'], 0, ',', '.'); ?></td>
                            <td align="justify"><?= $items['description']; ?></td>
                            <td width="12%" align="center">
                                <button type="button" class="btn btn-primary btn-sm btnEditItem" data-id="<?= $items['id'] ?>" data-toggle="modal" data-target="#staticBackdrop"><i class=" nav-icon fas fa-edit"></i></button>
                                <?php if (session()->get('level') == 'superadmin') : ?>
                                    <form action="<?= url_to('backend.item.delete'); ?>" method="post" class="d-inline"> |
                                        <?= csrf_field(); ?>
                                        <input type="hidden" name="id" value="<?= $items['id'] ?>">
                                        <button type="submit" class="btn btn-danger btn-sm"><i class="nav-icon fas fa-trash"></i></button>
                                    </form>
                                <?php endif ?>
                            </td>
                        </tr>
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

<!-- MODAL FORM Edit Item -->
<div class="modal fade" id="staticBackdrop" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Form Edit Item</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= url_to('backend.item.update'); ?>" method="post" id="formEditItem">
                    <input type="hidden" name="id">
                    <div class="row">
                        <div class="form-group col-md-7">
                            <label>Nama Item</label>
                            <input type="text" id="item_name" name="item_name" maxlength="30" class="form-control" autofocus required>
                        </div>
                        <div class="form-group col-md-5">
                            <label>Kategori</label>
                            <select id="category_id" name="category_id" class="form-control" style="width: 100%;" required>
                                <option value="" selected="selected" disabled="disabled">Pilih..</option>
                                <?php foreach ($options as $categories) : ?>
                                    <option value="<?= $categories['id']; ?>"><?= $categories['category_name']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Harga</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Rp.</span>
                            </div>
                            <input type="number" id="price" name="price" min="0" maxlength="9" oninput="if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" class="form-control">
                        </div>
                    </div>
                    <div class="form-group pb-2">
                        <label>Deskripsi</label>
                        <textarea class="form-control" rows="3" id="description" name="description" maxlength="255" placeholder="Tuliskan deskripsi.."></textarea>
                    </div>
                    <!-- <div class="form-group pb-3">
        <label>Deskripsi</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
            </div>
            <input type="text" name="" id="" class="form-control" value="" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask>
        </div>
    </div> -->
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