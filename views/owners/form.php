<?php include 'views/templates/header.php'; ?>
<h3><?= ($viewModel->editData ? "Edit Owner Data" : "Register New Owner") ?></h3>

<div style="background: var(--panel-bg); padding: 20px; border: 1px solid #333;">
    <form action="index.php?page=owner_save" method="POST">
        <input type="hidden" name="id" value="<?= $viewModel->editData['id'] ?? '' ?>">

        <div class="form-group">
            <label>Nama Lengkap</label>
            <input type="text" name="nama" value="<?= $viewModel->editData['nama_owner'] ?? '' ?>" required>
        </div>
        <div class="form-group">
            <label>Kontak (HP/Email)</label>
            <input type="text" name="kontak" value="<?= $viewModel->editData['kontak'] ?? '' ?>" required>
        </div>
        <div class="form-group">
            <label>Membership Status</label>
            <select name="status">
                <option value="Reguler" <?= (isset($viewModel->editData['membership_status']) && $viewModel->editData['membership_status'] == 'Reguler') ? 'selected' : '' ?>>Reguler</option>
                <option value="JDM_VIP" <?= (isset($viewModel->editData['membership_status']) && $viewModel->editData['membership_status'] == 'JDM_VIP') ? 'selected' : '' ?>>JDM VIP (Diskon 15%)</option>
            </select>
        </div>

        <button type="submit" class="btn">SAVE OWNER</button>
        <a href="index.php?page=owner_list" class="btn btn-danger">CANCEL</a>
    </form>
</div>
<?php include 'views/templates/footer.php'; ?>