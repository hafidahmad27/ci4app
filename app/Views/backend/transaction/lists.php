<?= $this->extend('template/adminlte/layout') ?>

<?= $this->section('content') ?>

<div class="col-12">
    <div class="card card-primary">
        <div class="card-body">
            <?= session()->getFlashdata('message'); ?>
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th style="text-align: right;">#</th>
                        <th style="text-align: center;">Tanggal</th>
                        <th>Kode Transaksi</th>
                        <th style="text-align: center;">Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1;
                    foreach ($transactions as $transaction) : ?>
                        <tr>
                            <td align="right"><?= $no++ ?></td>
                            <td align="center"><?= date('d M Y H:i:s', strtotime($transaction['transaction_date'])); ?></td>
                            <td><a href="<?= url_to('backend.transaction.list_details.view', $transaction['transaction_code']); ?>" class="text-bold" style="font-size: 13pt;"><u><?= $transaction['transaction_code']; ?></u></a></td>
                            <td align="right" class="text-bold"><?= number_format($transaction['total'], 0, ',', '.'); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?= $this->endSection() ?>