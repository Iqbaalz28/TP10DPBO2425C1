<?php
include_once 'models/CarModel.php';
include_once 'models/OwnerModel.php';

class CarViewModel {
    private $model;
    // Data Binding properties
    public $carList = [];
    public $ownersDropdown = [];
    public $editData = null; // Untuk form edit

    public function __construct() {
        $this->model = new CarModel();
    }

    public function viewCars() {
        $result = $this->model->getAllCars();
        $this->carList = [];

        while ($row = $result->fetch_assoc()) {
            $car = new stdClass();
            $car->id = $row['id'];
            $car->model = $row['model'];
            
            // LOGIC JDM: Highlight Mesin Legendaris
            $legendaryEngines = ['2JZ', 'RB26', '13B', 'K20', '4G63', 'EJ20'];
            $isLegend = false;
            foreach($legendaryEngines as $eng) {
                if (stripos($row['kode_mesin'], $eng) !== false) {
                    $isLegend = true; 
                    break;
                }
            }
            
            // Tampilan Badge Mesin
            if ($isLegend) {
                $car->engine_display = "<span class='engine-badge' style='color:#ff0055; border-color:#ff0055'>★ " . $row['kode_mesin'] . "</span>";
            } else {
                $car->engine_display = "<span class='engine-badge'>" . $row['kode_mesin'] . "</span>";
            }

            $car->owner = $row['nama_owner'];
            // Label VIP
            $car->vip_label = ($row['membership_status'] == 'JDM_VIP') ? "<span class='badge-vip'>VIP</span>" : "";

            $this->carList[] = $car;
        }
    }

    public function prepareForm($id = null) {
        $ownerModel = new OwnerModel();
        $this->ownersDropdown = $ownerModel->getAllOwners();

        if ($id) {
            $this->editData = $this->model->getCarById($id);
        }
    }

    public function saveCar($data) {
        if (!empty($data['id'])) {
            return $this->model->updateCar($data['id'], $data['id_owner'], $data['model'], $data['kode_mesin']);
        } else {
            return $this->model->createCar($data['id_owner'], $data['model'], $data['kode_mesin']);
        }
    }

    public function deleteCar($id) {
        return $this->model->deleteCar($id);
    }
}
?>