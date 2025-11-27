<?php include 'views/templates/header.php'; ?>

<div style="display: flex; justify-content: space-between; align-items: center;">
    <h3>Data Owners / Member</h3>
    <a href="index.php?page=owner_add" class="btn">+ Add Owner</a>
</div>

<table>
    <thead>
        <tr>
            <th>Nama Owner</th>
            <th>Kontak</th>
            <th>Status Membership</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($viewModel->ownerList as $owner): ?>
        <tr style="<?= $owner->row_style ?>">
            <td style="color: var(--neon-blue); font-weight:bold;"><?= $owner->nama ?></td>
            <td><?= $owner->kontak ?></td>
            <td><?= $owner->status_badge ?></td>
            <td>
                <a href="index.php?page=owner_edit&id=<?= $owner->id ?>" class="btn" style="padding:5px 10px; font-size:0.8em">Edit</a>
                <a href="index.php?page=owner_delete&id=<?= $owner->id ?>" class="btn btn-danger" style="padding:5px 10px; font-size:0.8em" onclick="return confirm('Hapus member ini?')">X</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php include 'views/templates/footer.php'; ?>