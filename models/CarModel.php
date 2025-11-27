<?php
include_once 'config/Database.php';

class CarModel extends Database {
    public function getAllCars() {
        // Join ke Owner untuk data lengkap
        $query = "SELECT c.*, o.nama_owner, o.membership_status 
                  FROM cars c 
                  JOIN owners o ON c.id_owner = o.id 
                  ORDER BY c.id DESC";
        return $this->execute($query);
    }

    public function getCarById($id) {
        $id = $this->escapeString($id);
        $query = "SELECT * FROM cars WHERE id='$id'";
        return $this->execute($query)->fetch_assoc();
    }

    public function createCar($owner, $model, $engine) {
        // SANITASI INPUT
        $owner = $this->escapeString($owner);
        $model = $this->escapeString($model);
        $engine = $this->escapeString($engine);

        $query = "INSERT INTO cars (id_owner, model, kode_mesin) VALUES ('$owner', '$model', '$engine')";
        return $this->execute($query);
    }

    public function updateCar($id, $owner, $model, $engine) {
        // SANITASI INPUT
        $id = $this->escapeString($id);
        $owner = $this->escapeString($owner);
        $model = $this->escapeString($model);
        $engine = $this->escapeString($engine);

        $query = "UPDATE cars SET id_owner='$owner', model='$model', kode_mesin='$engine' WHERE id='$id'";
        return $this->execute($query);
    }

    public function deleteCar($id) {
        $id = $this->escapeString($id);
        $query = "DELETE FROM cars WHERE id='$id'";
        return $this->execute($query);
    }
}
?>