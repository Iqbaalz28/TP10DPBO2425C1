<?php include 'views/templates/header.php'; ?>
<h3><?= ($viewModel->editData ? "Edit Tuner Profile" : "Add New Tuner") ?></h3>

<div style="background: var(--panel-bg); padding: 20px; border: 1px solid #333;">
    <form action="index.php?page=mech_save" method="POST">
        <input type="hidden" name="id" value="<?= $viewModel->editData['id'] ?? '' ?>">

        <div class="form-group">
            <label>Nama Tuner</label>
            <input type="text" name="nama" value="<?= $viewModel->editData['nama_tuner'] ?? '' ?>" required>
        </div>
        <div class="form-group">
            <label>Spesialisasi</label>
            <select name="spec">
                <?php 
                $specs = ['Rotary', 'Inline-6', 'Boxer', 'V-Type', 'General'];
                foreach($specs as $s): 
                    $selected = (isset($viewModel->editData['spesialisasi']) && $viewModel->editData['spesialisasi'] == $s) ? 'selected' : '';
                ?>
                    <option value="<?= $s ?>" <?= $selected ?>><?= $s ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group">
            <label>Status Saat Ini</label>
            <select name="status">
                <option value="Available" <?= (isset($viewModel->editData['status']) && $viewModel->editData['status'] == 'Available') ? 'selected' : '' ?>>Available</option>
                <option value="Busy" <?= (isset($viewModel->editData['status']) && $viewModel->editData['status'] == 'Busy') ? 'selected' : '' ?>>Busy</option>
            </select>
        </div>

        <button type="submit" class="btn">SAVE TUNER</button>
        <a href="index.php?page=mech_list" class="btn btn-danger">CANCEL</a>
    </form>
</div>
<?php include 'views/templates/footer.php'; ?>