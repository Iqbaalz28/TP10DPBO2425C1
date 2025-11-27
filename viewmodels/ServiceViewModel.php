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
            // 1. Coba Hapus
            $this->model->deleteService($id);
            
            // 2. Jika SUKSES (tidak ada error), Redirect lewat PHP
            header("Location: index.php?page=service_list");
            exit; // Penting untuk menghentikan script
            
        } catch (mysqli_sql_exception $e) {
            // 3. Jika GAGAL (Terjadi Error SQL)
            
            // Cek Kode Error 1451 (Foreign Key Constraint Fails)
            if ($e->getCode() == 1451) {
                // Tampilkan Alert JS, lalu redirect lewat JS
                echo "<script>
                        alert('⛔ AKSES DITOLAK: Layanan ini tidak bisa dihapus karena masih tercatat dalam riwayat Booking (Transaksi). Hapus data Booking terkait terlebih dahulu.');
                        window.location.href='index.php?page=service_list';
                      </script>";
            } else {
                // Error lain
                echo "Error System: " . $e->getMessage();
            }
        }
    }
}
?>