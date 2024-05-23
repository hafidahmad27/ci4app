<?= $this->extend('template/adminlte/layout') ?>

<?= $this->section('content') ?>

<style>
    .content-header {
        display: none;
    }
</style>

<div class="col-12 mt-4">
    <div class="card card-primary">
        <div class="card-header bg-primary">
            <h3 class="card-title">Form Tambah Item</h3>
            <div class="text-dark">
                <a href="<?= url_to('backend.item.view'); ?>" class="btn btn-default text-dark btn-xs float-right"><i class="fas fa-reply"></i> Back</a>
            </div>
        </div>
        <div class="card-body">
            <?= session()->getFlashdata('message'); ?>
            <form action="<?= url_to('backend.item.insert'); ?>" method="post">
                <?= csrf_field(); ?>
                <div class="row">
                    <div class="form-group col-md-7">
                        <label>Nama Item</label>
                        <input type="text" id="item_name" name="item_name" maxlength="30" class="form-control" autofocus required>
                    </div>
                    <div class="form-group col-md-5">
                        <label>Kategori</label>
                        <select name="category_id" class="form-control" required>
                            <option value="" selected="selected" disabled="disabled">Pilih..</option>
                            <?php foreach ($category_options as $category_option) : ?>
                                <option value="<?= $category_option['id']; ?>"><?= $category_option['category_name']; ?></option>
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
                <div class="form-group">
                    <label>Deskripsi</label>
                    <textarea class="form-control" rows="2" id="description" name="description" maxlength="255" placeholder="Tuliskan deskripsi.."></textarea>
                </div>
                <!-- <div class="form-group">
                    <label>Tanggal</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                        </div>
                        <input type="text" class="form-control" value="<?= date('d/m/Y'); ?>" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask>
                    </div>
                </div> -->
                <button type="submit" class="btn btn-primary mt-3"><i class="fas fa-save"></i> &nbsp;Save</button>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection() ?>