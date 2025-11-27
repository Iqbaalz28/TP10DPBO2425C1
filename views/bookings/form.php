<?php include 'views/template/header.php'; ?>

<h3>New Dyno/Service Booking</h3>

<div style="background: var(--panel-bg); padding: 20px; border: 1px solid #333;">
    <form action="index.php?page=booking_save" method="POST">
        
        <div class="form-group">
            <label>Pilih Mobil</label>
            <select name="id_car">
                <?php foreach($viewModel->dropdownCars as $row): ?>
                    <option value="<?= $row['id'] ?>"><?= $row['model'] ?> (<?= $row['nama_owner'] ?>)</option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group">
            <label>Layanan</label>
            <select name="id_service">
                <?php foreach($viewModel->dropdownServices as $row): ?>
                    <option value="<?= $row['id'] ?>"><?= $row['nama_layanan'] ?> - Rp <?= number_format($row['harga']) ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group">
            <label>Tuner / Mekanik</label>
            <select name="id_mechanic">
                <?php foreach($viewModel->dropdownMechanics as $row): ?>
                    <option value="<?= $row['id'] ?>"><?= $row['nama_tuner'] ?> (Spec: <?= $row['spesialisasi'] ?>)</option>
                <?php endforeach; ?>
            </select>
        </div>

        <button type="submit" class="btn">SUBMIT BOOKING</button>
        <a href="index.php" class="btn btn-danger">CANCEL</a>
    </form>
</div>

<?php include 'views/template/footer.php'; ?>