<?= $this->extend('/layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container">
    <div class="row">
        <div class="col-8">
            <h2 class="my-3">Add Fashion Product Form</h1>

                <form action="/fashion/save" method="post" enctype="multipart/form-data">
                    <div class="row mb-3">
                        <label for="name" class="col-sm-2 col-form-label">Product Name</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control <?= (validation_show_error('name')) ? 'is-invalid' : '' ?>" id="name" name="name" value="<?= old('name'); ?>">
                        </div>
                        <div class="row mb-3">
                            <?= validation_show_error('name') ?>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="type" class="col-sm-2 col-form-label">Type</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control <?= (validation_show_error('type')) ? 'is-invalid' : '' ?>" id="type" name="type">
                        </div>
                        <div class="row mb-3">
                            <?= validation_show_error('type') ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="image" class="col-form-label col-sm-2">Pilih Gambar</label>
                        <div class="col-sm-2">
                            <img src="/img/default.jpg" class="img-thumbnail img-preview">
                        </div>
                        <div class="col-sm-8">
                            <input class="form-control" type="file" id="image" name="image" onchange="previewImg()">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Add Product</button>
                </form>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>