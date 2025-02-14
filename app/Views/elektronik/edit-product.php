<?= $this->extend('/layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container">
    <div class="row">
        <div class="col-8">
            <h2 class="my-3">Form Edit Produk Elektronik</h1>

            <form action="/elektronik/update" method="post">
                <div class="row mb-3">
                    <label for="nama" class="col-sm-2 col-form-label">Nama Barang</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="nama" name="nama" value="<?= $product->getNama(); ?>">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="harga" class="col-sm-2 col-form-label">Harga</label>
                    <div class="col-sm-10">
                        <input type="number" class="form-control" id="harga" name="harga" value="<?= $product->getHarga(); ?>">
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-10"> 
                        <input type="hidden" class="form-control" id="type" name="type" value="elektronik">
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-10"> 
                        <input type="hidden" class="form-control" id="id" name="id" value="<?= $product->getId(); ?>">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="is_baterai" class="col-sm-2 col-form-label">Pakai Baterai</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="is_baterai" name="is_baterai" value="<?= ($product->getIsBaterai() == 1) ? "true" : "false"; ?>">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="aliran_listrik" class="col-sm-2 col-form-label">Aliran Listrik</label>
                    <div class="col-sm-10">
                        <input type="number" class="form-control" id="aliran_listrik" name="aliran_listrik" value="<?= $product->getAliranListrik(); ?>">
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Edit Produk</button>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>