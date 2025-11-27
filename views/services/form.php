<?php include 'views/templates/header.php'; ?>
<h3><?= ($viewModel->editData ? "Edit Service Info" : "Add New Service") ?></h3>

<div style="background: var(--panel-bg); padding: 20px; border: 1px solid #333;">
    <form action="index.php?page=service_save" method="POST">
        <input type="hidden" name="id" value="<?= $viewModel->editData['id'] ?? '' ?>">

        <div class="form-group">
            <label>Nama Layanan</label>
            <input type="text" name="nama" value="<?= $viewModel->editData['nama_layanan'] ?? '' ?>" required>
        </div>
        <div class="form-group">
            <label>Jenis</label>
            <select name="jenis">
                <option value="Service" <?= (isset($viewModel->editData['jenis']) && $viewModel->editData['jenis'] == 'Service') ? 'selected' : '' ?>>Regular Service</option>
                <option value="Dyno Tuning" <?= (isset($viewModel->editData['jenis']) && $viewModel->editData['jenis'] == 'Dyno Tuning') ? 'selected' : '' ?>>Dyno Tuning</option>
            </select>
        </div>
        <div class="form-group">
            <label>Harga (Rp)</label>
            <input type="number" name="harga" value="<?= $viewModel->editData['harga'] ?? '' ?>" required>
        </div>

        <button type="submit" class="btn">SAVE SERVICE</button>
        <a href="index.php?page=service_list" class="btn btn-danger">CANCEL</a>
    </form>
</div>
<?php include 'views/templates/footer.php'; ?>