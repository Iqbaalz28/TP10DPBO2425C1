<?php include 'views/templates/header.php'; ?>

<div style="display: flex; justify-content: space-between; align-items: center;">
    <h3>Garage / Cars List</h3>
    <a href="index.php?page=car_add" class="btn">+ Add JDM Car</a>
</div>

<table>
    <thead>
        <tr>
            <th>Model</th>
            <th>Engine Code</th>
            <th>Owner</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($viewModel->carList as $car): ?>
        <tr>
            <td style="font-weight:bold; color: var(--neon-blue);"><?= $car->model ?></td>
            <td><?= $car->engine_display ?></td>
            <td><?= $car->owner ?> <?= $car->vip_label ?></td>
            <td>
                <a href="index.php?page=car_edit&id=<?= $car->id ?>" class="btn" style="font-size:0.8em">Edit</a>
                <a href="index.php?page=car_delete&id=<?= $car->id ?>" class="btn btn-danger" style="font-size:0.8em" onclick="return confirm('Yakin hapus mobil ini?')">X</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php include 'views/templates/footer.php'; ?>