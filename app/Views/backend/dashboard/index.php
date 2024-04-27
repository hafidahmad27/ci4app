<?= $this->extend('template/adminlte/layout') ?>

<?= $this->section('content') ?>

<div class="col-12">
    <h5>Selamat datang, <?= session()->get('level') ?></h5>
</div>

<?= $this->endSection() ?>