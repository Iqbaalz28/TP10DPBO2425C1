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
        return $this->model->deleteService($id);
    }
}
?>