<?php include 'views/templates/header.php'; ?>

<h3><?= ($viewModel->editData ? "Edit Car Spec" : "Add New JDM Car") ?></h3>

<div style="background: var(--panel-bg); padding: 20px; border: 1px solid #333;">
    <form action="index.php?page=car_save" method="POST">
        <input type="hidden" name="id" value="<?= $viewModel->editData['id'] ?? '' ?>">

        <div class="form-group">
            <label>Owner</label>
            <select name="id_owner" required>
                <option value="">-- Pilih Owner --</option>
                <?php foreach($viewModel->ownersDropdown as $owner): ?>
                    <?php 
                        $selected = ($viewModel->editData && $viewModel->editData['id_owner'] == $owner['id']) ? 'selected' : ''; 
                    ?>
                    <option value="<?= $owner['id'] ?>" <?= $selected ?>>
                        <?= $owner['nama_owner'] ?> (<?= $owner['membership_status'] ?>)
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group">
            <label>Car Model (ex: Nissan Silvia S15)</label>
            <input type="text" name="model" value="<?= $viewModel->editData['model'] ?? '' ?>" required placeholder="Masukkan Model Mobil">
        </div>

        <div class="form-group">
            <label>Engine Code (ex: SR20DET)</label>
            <input type="text" name="kode_mesin" value="<?= $viewModel->editData['kode_mesin'] ?? '' ?>" required placeholder="Kode Mesin">
        </div>

        <button type="submit" class="btn">SAVE CAR DATA</button>
        <a href="index.php?page=car_list" class="btn btn-danger">CANCEL</a>
    </form>
</div>

<?php include 'views/templates/footer.php'; ?>