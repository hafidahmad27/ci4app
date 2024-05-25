<?= $this->extend('backend/layouts/index') ?>

<?= $this->section('content') ?>

<style>
    .content-header {
        display: none;
    }
</style>

<div class="col-12 mt-3">
    <div class="card card-primary">
        <div class="card-header bg-primary">
            <h3 class="card-title">Form Transaksi</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="form-group col-md-2">
                    <label>Kode Transaksi</label>
                    <input type="text" value="<?= $display_transaction_code ?>" maxlength="11" class="form-control" readonly>
                </div>
                <div class="form-group col-md-2">
                    <label>Tanggal</label>
                    <input value="<?= date('d M Y'); ?>" maxlength="30" class="form-control" readonly>
                </div>
            </div>

            <form action="<?= url_to('backend.transaction.addToCart'); ?>" method="post">
                <div class="row">
                    <div class="form-group col-md-4">
                        <label>Nama Item</label>
                        <select name="item_id" class="form-control" autofocus required>
                            <option value="" disabled="disabled" selected>Pilih..</option>
                            <?php foreach ($item_options as $item_option) : ?>
                                <option value="<?= $item_option['id']; ?>"><?= $item_option['item_name']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group col-md-1">
                        <label>Qty</label>
                        <input type="number" name="qty" value="1" min="1" maxlength="3" oninput="if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength)" class="form-control" required>
                    </div>
                    <div class="form-inline col-md-1 mt-3">
                        <button type="submit" class="btn btn-primary"><i class="fas fa-plus"></i></button>
                    </div>
                </div>
            </form>

            <?= session()->getFlashdata('message-failed') ?>
            <div class="card-body table-responsive p-0 mb-2" style="max-height: 305px;">
                <table class="table table-bordered table-striped table-head-fixed mb-3">
                    <thead>
                        <tr>
                            <th style="text-align: center;">#</th>
                            <th>Nama Item</th>
                            <th width="10%" style="text-align: right;">Qty</th>
                            <th style="text-align: right;">Harga</th>
                            <th style="text-align: right;">Subtotal</th>
                            <th style="text-align: center;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1;
                        foreach ($cart_items as $cart_item) : ?>
                            <tr>
                                <td align="right"><?= $no++; ?></td>
                                <td><?= $cart_item['item_name'] ?></td>
                                <td align="right"><?= $cart_item['qty']; ?></td>
                                <td align="right"><?= number_format($cart_item['price'], 0, ',', '.'); ?></td>
                                <td class="text-bold text-right"><?= number_format($cart_item['qty'] * $cart_item['price'], 0, ',', '.'); ?></td>
                                <td align="center">
                                    <button type="button" class="btn btn-primary btn-sm btnEditCartItem" data-id="<?= $cart_item['id']; ?>" data-toggle="modal" data-target="#staticBackdrop"><i class=" nav-icon fas fa-edit"></i></button>
                                    <form action="<?= url_to('backend.transaction.deleteFromCart'); ?>" method="post" class="d-inline"> |
                                        <input type="hidden" name="id" value="<?= $cart_item['id'] ?>">
                                        <button type="submit" class="btn btn-danger btn-sm"><i class="nav-icon fas fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
                <?= session()->getFlashdata('message') ?>
            </div>
            <div class="row mr-1 float-right">
                <form action="<?= url_to('backend.transaction.insert'); ?>" method="post">
                    <input type="hidden" name="transaction_code" value="<?= $display_transaction_code ?>">
                    <label class="col-form-label" style="font-size: 16pt;">Total:&nbsp;&nbsp; <?= number_format($display_total_price, 0, ',', '.'); ?></label>
                    <button type="submit" class="btn btn-primary btn-lg ml-4" <?= $display_total_price != null ? '' : 'disabled'; ?>><i class="fas fa-spinner"></i> &nbsp;Proses</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- MODAL FORM Edit Qty Item -->
<div class="modal fade" id="staticBackdrop" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit Qty Item</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= url_to('backend.transaction.updateCart'); ?>" method="post" id="formEditCartItem">
                    <input type="hidden" name="id">
                    <div class="row">
                        <div class="form-group col-md-7">
                            <label>Nama Item</label>
                            <input type="text" id="item_name" class="form-control" readonly>
                        </div>
                        <div class="form-group col-md-2">
                            <label>Qty</label>
                            <input type="number" id="qty_edit" name="qty_edit" min="1" maxlength="3" oninput="if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" class="form-control">
                        </div>
                        <div class="form-group col-md-3">
                            <label style="color: white;">Action</label>
                            <button type="submit" class="btn btn-primary float-right"><i class="nav-icon fas fa-sync"></i> &nbsp;Update</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<?= $this->endSection() ?>