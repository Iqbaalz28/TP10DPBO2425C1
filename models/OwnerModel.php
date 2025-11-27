<?php
include_once 'config/Database.php';

class OwnerModel extends Database {
    public function getAllOwners() {
        $query = "SELECT * FROM owners ORDER BY id DESC";
        return $this->execute($query);
    }

    public function getOwnerById($id) {
        $query = "SELECT * FROM owners WHERE id='$id'";
        return $this->execute($query)->fetch_assoc();
    }

    public function createOwner($nama, $kontak, $status) {
        $query = "INSERT INTO owners (nama_owner, kontak, membership_status) VALUES ('$nama', '$kontak', '$status')";
        return $this->execute($query);
    }

    public function updateOwner($id, $nama, $kontak, $status) {
        $query = "UPDATE owners SET nama_owner='$nama', kontak='$kontak', membership_status='$status' WHERE id='$id'";
        return $this->execute($query);
    }

    public function deleteOwner($id) {
        $query = "DELETE FROM owners WHERE id='$id'";
        return $this->execute($query);
    }
}
?>