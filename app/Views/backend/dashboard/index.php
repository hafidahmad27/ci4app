<?= $this->extend('template/adminlte/layout') ?>

<?= $this->section('content') ?>

<div class="col-12">
    <h5>Selamat datang, <?= session()->get('name') ?></h5>
</div>

<?= $this->endSection() ?>