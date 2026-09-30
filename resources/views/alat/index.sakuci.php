<?php \Sakuci\View::startSection('content'); ?>
<div class="container-fluid px-4">
    <h1 class="mt-4">Manajemen Alat</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="<?= route('dashboard') ?>">Dashboard</a></li>
        <li class="breadcrumb-item active">Data Alat</li>
    </ol>

    <?php if (session('success')): ?>
        <div class="alert alert-success"><?= session('success') ?></div>
    <?php endif; ?>

    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Daftar Alat
            <a href="<?= route('alat.create') ?>" class="btn btn-primary btn-sm float-end">Tambah Alat</a>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode Alat</th>
                        <th>Nama Alat</th>
                        <th>Kategori</th>
                        <th>Jumlah</th>
                        <th>Kondisi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($data)): ?>
                        <?php $no = 1; foreach ($data as $row): ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $row->kode_alat ?? '' ?></td>
                            <td><?= $row->nama_alat ?? '' ?></td>
                            <td><?= $row->kategori ?? '' ?></td>
                            <td><?= $row->jumlah ?? '' ?></td>
                            <td><?= $row->kondisi ?? '' ?></td>
                            <td>
                                <a href="<?= route('alat.edit', [$row->id_alat]) ?>" class="btn btn-warning btn-sm">Edit</a>
                                <form action="<?= route('alat.destroy', [$row->id_alat]) ?>" method="POST" style="display:inline-block;" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                    <!-- Pengganti csrf_field() agar tidak error undefined function -->
                                    <input type="hidden" name="_token" value="<?= $_SESSION['_token'] ?? '' ?>">
                                    <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                </form>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="7" class="text-center">Tidak ada data alat.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php \Sakuci\View::stopSection(); ?>