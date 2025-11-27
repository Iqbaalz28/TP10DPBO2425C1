<?php include 'views/templates/header.php'; ?>

<div style="display: flex; justify-content: space-between; align-items: center;">
    <h3>Booking List</h3>
    <a href="index.php?page=booking_add" class="btn">+ New Booking</a>
</div>

<table>
    <thead>
        <tr>
            <th>Kode</th>
            <th>Mobil (Engine)</th>
            <th>Pemilik</th>
            <th>Layanan</th>
            <th>Tuner</th>
            <th>Est. Biaya</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($viewModel->dataList as $data): ?>
        <tr>
            <td style="font-family: monospace;"><?= $data->kode ?></td>
            <td><?= $data->mobil ?></td>
            <td><?= $data->owner ?></td>
            <td><?= $data->layanan ?></td>
            <td><?= $data->tuner ?></td>
            <td style="color: lightgreen;"><?= $data->biaya ?></td>
            <td>
                <span style="color: var(--<?= ($data->statusColor == 'success') ? 'neon-blue' : 'text-main' ?>)">
                    <?= $data->status ?>
                </span>
            </td>
            <td>
                <a href="index.php?page=booking_delete&id=<?= $data->id ?>" class="btn btn-danger" onclick="return confirm('Cancel booking?')">X</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php include 'views/templates/footer.php'; ?>