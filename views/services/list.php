<?php include 'views/templates/header.php'; ?>

<div style="display: flex; justify-content: space-between; align-items: center;">
    <h3>Service & Parts Catalog</h3>
    <a href="index.php?page=service_add" class="btn">+ Add Service</a>
</div>

<table>
    <thead>
        <tr>
            <th>Jenis</th>
            <th>Nama Layanan</th>
            <th>Harga</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($viewModel->serviceList as $srv): ?>
        <tr>
            <td><?= $srv->icon ?> <?= $srv->jenis ?></td>
            <td><?= $srv->nama ?></td>
            <td style="color: lightgreen;"><?= $srv->harga ?></td>
            <td>
                <a href="index.php?page=service_edit&id=<?= $srv->id ?>" class="btn" style="padding:5px 10px; font-size:0.8em">Edit</a>
                <a href="index.php?page=service_delete&id=<?= $srv->id ?>" class="btn btn-danger" style="padding:5px 10px; font-size:0.8em" onclick="return confirm('Hapus layanan?')">X</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php include 'views/templates/footer.php'; ?>