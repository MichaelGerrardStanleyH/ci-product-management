<?= $this->extend('/layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container">
    <div class="row">
        <div class="col-8">
            <h2 class="my-3">Form Tambah Produk Elektronik</h1>

            <form action="/elektronik/save" method="post">
                <div class="row mb-3">
                    <label for="nama" class="col-sm-2 col-form-label">Nama Barang</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="nama" name="nama">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="harga" class="col-sm-2 col-form-label">Harga</label>
                    <div class="col-sm-10">
                        <input type="number" class="form-control" id="harga" name="harga">
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-10"> 
                        <input type="hidden" class="form-control" id="type" name="type" value="elektronik">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="is_baterai" class="col-sm-2 col-form-label">Pakai Baterai</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="is_baterai" name="is_baterai">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="aliran_listrik" class="col-sm-2 col-form-label">Aliran Listrik</label>
                    <div class="col-sm-10">
                        <input type="number" class="form-control" id="aliran_listrik" name="aliran_listrik">
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Tambah Produk</button>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>