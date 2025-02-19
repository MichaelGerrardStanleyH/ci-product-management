<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container">
    <div class="row">
        <div class="col">
            <h1>Electronic Product Page</h1>

            <a href="/electronic/create" class="btn btn-primary">Add Electronic Product</a>

            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Product Name</th>
                        <th scope="col">Electric</th>
                        <th scope="col">Image</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($products as $product) : ?>
                        <tr>
                            <th scope="row"><?= $i++; ?></th>
                            <td><?= $product->getName(); ?></td>
                            <td><?= $product->getElectric(); ?></td>
                            <td><img src="/img/<?= $product->getImage(); ?>" alt="" class="image"></td>
                            <td>
                                <a href="/electronic/edit/<?= $product->getIdBaseProduct(); ?>" class="btn btn-warning">Edit</a>
                                <form action="/electronic/<?= $product->getIdBaseProduct(); ?>" method="post" class="d-inline">
                                    <?= csrf_field(); ?>
                                    <input type="hidden" name="_method" value="DELETE">
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('apakah anda yakin?')">Delete</button>
                                </form>

                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

        </div>
    </div>
</div>
<?= $this->endSection(); ?>