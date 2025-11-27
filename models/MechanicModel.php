<?php
include_once 'config/Database.php';

class MechanicModel extends Database {
    public function getAllMechanics() {
        $query = "SELECT * FROM mechanics ORDER BY status ASC, nama_tuner ASC";
        return $this->execute($query);
    }

    public function getMechanicById($id) {
        $query = "SELECT * FROM mechanics WHERE id='$id'";
        return $this->execute($query)->fetch_assoc();
    }

    public function createMechanic($nama, $spec, $status) {
        $query = "INSERT INTO mechanics (nama_tuner, spesialisasi, status) VALUES ('$nama', '$spec', '$status')";
        return $this->execute($query);
    }

    public function updateMechanic($id, $nama, $spec, $status) {
        $query = "UPDATE mechanics SET nama_tuner='$nama', spesialisasi='$spec', status='$status' WHERE id='$id'";
        return $this->execute($query);
    }

    public function deleteMechanic($id) {
        $query = "DELETE FROM mechanics WHERE id='$id'";
        return $this->execute($query);
    }
}
?>