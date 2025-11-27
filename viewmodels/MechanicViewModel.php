<?php
include_once 'models/MechanicModel.php';

class MechanicViewModel {
    private $model;
    public $mechList = [];
    public $editData = null;

    public function __construct() {
        $this->model = new MechanicModel();
    }

    public function viewMechanics() {
        $result = $this->model->getAllMechanics();
        $this->mechList = [];

        while ($row = $result->fetch_assoc()) {
            $mech = new stdClass();
            $mech->id = $row['id'];
            $mech->nama = $row['nama_tuner'];
            $mech->spec = $row['spesialisasi'];
            
            // Status Logic Color
            if ($row['status'] == 'Available') {
                $mech->status_display = "<span style='color:lightgreen'>● Available</span>";
            } else {
                $mech->status_display = "<span style='color:orange'>● Busy (On Dyno)</span>";
            }

            $this->mechList[] = $mech;
        }
    }

    public function prepareForm($id = null) {
        if ($id) {
            $this->editData = $this->model->getMechanicById($id);
        }
    }

    public function saveMechanic($data) {
        if (!empty($data['id'])) {
            return $this->model->updateMechanic($data['id'], $data['nama'], $data['spec'], $data['status']);
        } else {
            return $this->model->createMechanic($data['nama'], $data['spec'], $data['status']);
        }
    }

    public function deleteMechanic($id) {
        try {
            $this->model->deleteMechanic($id);
            header("Location: index.php?page=mech_list");
            exit;
        } catch (mysqli_sql_exception $e) {
            if ($e->getCode() == 1451) {
                echo "<script>
                        alert('⛔ ERROR: Tuner/Mekanik ini sedang terdaftar dalam tugas/booking aktif atau riwayat servis lama. Data tidak boleh dihapus.');
                        window.location.href='index.php?page=mech_list';
                      </script>";
            } else {
                echo "Error System: " . $e->getMessage();
            }
        }
    }
}
?>