<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container">
    <div class="row">
        <div class="col">
            <h1>Ini halaman Elektronik</h1>

            <a href="/elektronik/create" class="btn btn-primary">Tambah Barang elektronik</a>

            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nama Barang</th>
                        <th scope="col">Harga</th>
                        <th scope="col">Tipe</th>
                        <th scope="col">Pake Baterai</th>
                        <th scope="col">Aliran listrik</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($products as $product) : ?>
                        <tr>
                            <th scope="row"><?= $i++; ?></th>
                            <td><?= $product->getNama(); ?></td>
                            <td><?= $product->getHarga(); ?></td>
                            <td><?= $product->getType(); ?></td>
                            <td><?= ($product->getIsBaterai() == 1) ? "true" : "false"; ?></td>
                            <td><?= $product->getAliranListrik() . "v"; ?></td>
                            <td>
                                <a href="/elektronik/edit/<?= $product->getId(); ?>" class="btn btn-warning">Edit</a>
                                <form action="/elektronik/<?= $product->getId(); ?>" method="post" class="d-inline">
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