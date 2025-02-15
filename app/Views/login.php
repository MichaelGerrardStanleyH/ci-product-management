<?= $this->extend('/layout/template'); ?>

<?= $this->section('content'); ?>

<div class="container">
    <div class="container col-6 mt-5 login">
        <h1>Login</h1>
        <form action="/auth/login" method="post">
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="username" class="form-control" id="username" name="username">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password">
            </div>

            <?php if (session()->getFlashdata('error')): ?>
                <p class="wrong-password"><?= session()->getFlashdata('error') ?></p>
            <?php endif; ?>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

</div>



<?= $this->endSection(); ?>