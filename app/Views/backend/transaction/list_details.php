<?= $this->extend('template/adminlte/layout') ?>

<?= $this->section('content') ?>

<div class="col-12">
    <!-- <div class="callout callout-info">
        <h5><i class="fas fa-info"></i> Note:</h5>
        This page has been enhanced for printing. Click the print button at the bottom of the invoice to test.
    </div> -->

    <!-- Main content -->
    <div class="invoice p-3">
        <!-- title row -->
        <div class="row">
            <div class="col-12">
                <h4 class="text-bold">
                    <i class="fas fa-globe"></i> HFD Corp.
                    <small class="float-right text-bold">INVOICE</small>
                </h4>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
        <div class="d-flex flex-row-reverse mb-3">
            <div>
                <?php foreach ($transactions as $transaction) : ?>
                    <b>Kode Transaksi &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : </b>&nbsp;<?= $transaction['transaction_code'] ?><br>
                    <b>Tanggal Transaksi : </b> <?= date('d M Y H:i:s', strtotime($transaction['transaction_date'])); ?>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- Table row -->
        <div class="row">
            <div class="col-12 table-responsive">
                <table class="table table-striped">
                    <thead class="bg-secondary">
                        <tr>
                            <th>Item Name</th>
                            <th style="text-align: right;">Qty</th>
                            <th style="text-align: center;">Price</th>
                            <th style="text-align: center;">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($transaction_details as $transaction_detail) : ?>
                            <tr>
                                <td><?= $transaction_detail['item_name']; ?></td>
                                <td align="right"><?= $transaction_detail['qty']; ?></td>
                                <td align="right"><?= number_format($transaction_detail['price'], 0, ',', '.'); ?></td>
                                <td align="right" class="text-bold"><?= number_format($transaction_detail['qty'] * $transaction_detail['price'], 0, ',', '.'); ?></td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->

        <div class="row">
            <div class="col-3 ml-auto">
                <div class="table-responsive">
                    <table class="table">
                        <tr style="font-size: 14pt;">
                            <?php foreach ($transactions as $transaction) : ?>
                                <th>Total</th>
                                <td align="right" class="text-bold"><?= number_format($transaction['total'], 0, ',', '.'); ?></td>
                            <?php endforeach; ?>
                        </tr>
                        <tr>
                            <th></th>
                            <td></td>
                        </tr>
                    </table>
                </div>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->

        <!-- this row will not appear when printing -->
        <div class="row no-print">
            <div class="col-12">
                <a href="<?= url_to('backend.transaction.lists.view'); ?>" class="btn btn-default"><i class="fas fa-reply"></i> Back</a>
                <!-- <a rel="noopener" target="_blank" class="btn btn-outline-dark float-right"><i class="fas fa-print"></i>&nbsp; Print</a> -->
            </div>
        </div>
    </div>
    <!-- /.invoice -->
</div><!-- /.col -->

<?= $this->endSection() ?>