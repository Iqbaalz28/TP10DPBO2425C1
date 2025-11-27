<?php
include_once 'models/ServiceModel.php';

class ServiceViewModel {
    private $model;
    public $serviceList = [];
    public $editData = null;

    public function __construct() {
        $this->model = new ServiceModel();
    }

    public function viewServices() {
        $result = $this->model->getAllServices();
        $this->serviceList = [];

        while ($row = $result->fetch_assoc()) {
            $srv = new stdClass();
            $srv->id = $row['id'];
            $srv->nama = $row['nama_layanan'];
            $srv->jenis = $row['jenis'];
            $srv->harga = "Rp " . number_format($row['harga'], 0, ',', '.');
            
            // Icon Logic
            if ($row['jenis'] == 'Dyno Tuning') {
                $srv->icon = "⚡";
            } else {
                $srv->icon = "🔧";
            }

            $this->serviceList[] = $srv;
        }
    }

    public function prepareForm($id = null) {
        if ($id) {
            $this->editData = $this->model->getServiceById($id);
        }
    }

    public function saveService($data) {
        if (!empty($data['id'])) {
            return $this->model->updateService($data['id'], $data['nama'], $data['jenis'], $data['harga']);
        } else {
            return $this->model->createService($data['nama'], $data['jenis'], $data['harga']);
        }
    }

    public function deleteService($id) {
            try {
                // Coba hapus
                $this->model->deleteService($id);
                // Jika sukses, redirect
                header("Location: index.php?page=service_list");
            } catch (mysqli_sql_exception $e) {
                // Jika gagal karena Foreign Key (Error 1451)
                if ($e->getCode() == 1451) {
                    echo "<script>
                            alert('GAGAL MENGHAPUS: Layanan ini sedang digunakan dalam data Booking. Hapus data Booking terkait terlebih dahulu.');
                            window.location.href='index.php?page=service_list';
                        </script>";
                } else {
                    // Error lain
                    echo "Error: " . $e->getMessage();
                }
            }
        }
    }
?>