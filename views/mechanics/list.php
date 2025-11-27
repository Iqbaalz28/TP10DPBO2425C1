<?php include 'views/templates/header.php'; ?>

<div style="display: flex; justify-content: space-between; align-items: center;">
    <h3>List Tuner / Mechanic</h3>
    <a href="index.php?page=mech_add" class="btn">+ Add Tuner</a>
</div>

<table>
    <thead>
        <tr>
            <th>Nama Tuner</th>
            <th>Spesialisasi Engine</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($viewModel->mechList as $mech): ?>
        <tr>
            <td><?= $mech->nama ?></td>
            <td style="font-family:monospace; color:var(--neon-blue)"><?= $mech->spec ?></td>
            <td><?= $mech->status_display ?></td>
            <td>
                <a href="index.php?page=mech_edit&id=<?= $mech->id ?>" class="btn" style="padding:5px 10px; font-size:0.8em">Edit</a>
                <a href="index.php?page=mech_delete&id=<?= $mech->id ?>" class="btn btn-danger" style="padding:5px 10px; font-size:0.8em" onclick="return confirm('Hapus tuner?')">X</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php include 'views/templates/footer.php'; ?>