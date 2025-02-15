<?= $this->extend('/layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container">
    <div class="row">
        <div class="col-8">
            <h2 class="my-3">Form Edit Produk Elektronik</h1>

                <form action="/elektronik/update" method="post" enctype="multipart/form-data">
                    <div class="row mb-3">
                        <label for="name" class="col-sm-2 col-form-label">Product Name</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="name" name="name" value="<?= $product->getName(); ?>">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-10">
                            <input type="hidden" class="form-control" id="idBaseProduct" name="idBaseProduct" value="<?= $product->getIdBaseProduct(); ?>">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-10">
                            <input type="hidden" class="form-control" id="idElectronicProduct" name="idElectronicProduct" value="<?= $product->getIdElectronicProduct(); ?>">
                        </div>
                    </div>
                    <input type="hidden" name="oldImage" value="<?= $product->getImage(); ?>">
                    <div class="row mb-3">
                        <label for="electric" class="col-sm-2 col-form-label">Electric</label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control" id="electric" name="electric" value="<?= $product->getElectric(); ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="image" class="col-form-label col-sm-2">Pilih Gambar</label>
                        <div class="col-sm-2">
                            <img src="/img/<?= $product->getImage(); ?>" class="img-thumbnail img-preview">
                        </div>
                        <div class="col-sm-8">
                            <input class="form-control" type="file" id="image" name="image" onchange="previewImg()">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Edit Produk</button>
                </form>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>