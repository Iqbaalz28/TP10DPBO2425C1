<?php
include_once 'config/Database.php';

class ServiceModel extends Database {
    public function getAllServices() {
        $query = "SELECT * FROM services ORDER BY jenis ASC";
        return $this->execute($query);
    }

    public function getServiceById($id) {
        $query = "SELECT * FROM services WHERE id='$id'";
        return $this->execute($query)->fetch_assoc();
    }

    public function createService($nama, $jenis, $harga) {
        $query = "INSERT INTO services (nama_layanan, jenis, harga) VALUES ('$nama', '$jenis', '$harga')";
        return $this->execute($query);
    }

    public function updateService($id, $nama, $jenis, $harga) {
        $query = "UPDATE services SET nama_layanan='$nama', jenis='$jenis', harga='$harga' WHERE id='$id'";
        return $this->execute($query);
    }

    public function deleteService($id) {
        $query = "DELETE FROM services WHERE id='$id'";
        return $this->execute($query);
    }
}
?>