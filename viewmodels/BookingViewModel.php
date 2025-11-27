<?php
include_once 'models/BookingModel.php';
// Include model lain untuk data dropdown
include_once 'models/CarModel.php'; 
include_once 'models/ServiceModel.php';
include_once 'models/MechanicModel.php';

class BookingViewModel {
    private $model;
    // Properti Data Binding untuk View 
    public $dataList = []; 
    public $dropdownCars = [];
    public $dropdownServices = [];
    public $dropdownMechanics = [];

    public function __construct() {
        $this->model = new BookingModel();
    }

    public function viewData() {
        $result = $this->model->getAllBookings();
        $this->dataList = []; // Reset data

        while ($row = $result->fetch_assoc()) {
            // --- ATURAN BISNIS 1: Hitung Diskon Komunitas ---
            $finalPrice = $row['harga'];
            $isVip = false;
            
            if ($row['membership_status'] == 'JDM_VIP') {
                $finalPrice = $row['harga'] * 0.85; // Diskon 15%
                $isVip = true;
            }

            // --- ATURAN BISNIS 2: Validasi Kecocokan Tuner (Warning Logic) ---
            // Misal: Mesin Rotary (RX7) sebaiknya dipegang spesialis Rotary
            $warningNote = "";
            if (strpos($row['kode_mesin'], '13B') !== false && $row['spesialisasi'] != 'Rotary') {
                $warningNote = "⚠️ Tuner Mismatch!";
            }

            // --- DATA BINDING: Menyiapkan Objek untuk View ---
            $obj = new stdClass();
            $obj->id = $row['id'];
            $obj->kode = $row['kode_booking'];
            $obj->mobil = $row['model'] . " <span class='engine-badge'>".$row['kode_mesin']."</span>";
            $obj->owner = $row['nama_owner'] . ($isVip ? " <span class='badge-vip'>VIP</span>" : "");
            $obj->layanan = $row['nama_layanan'];
            $obj->tuner = $row['nama_tuner'] . " <small>(".$row['spesialisasi'].")</small> " . $warningNote;
            $obj->status = $row['status'];
            
            // Styling Status (Logic Warna)
            $obj->statusColor = match($row['status']) {
                'Pending' => 'warning',
                'OnProcess' => 'info',
                'Done' => 'success',
            };

            // Formatting Rupiah
            $obj->biaya = "Rp " . number_format($finalPrice, 0, ',', '.');
            
            $this->dataList[] = $obj;
        }
    }

    public function addBooking($postData) {
        // --- Generator Kode Booking Unik ---
        $kode = "JDM-" . rand(1000, 9999);
        
        $id_car = $postData['id_car'];
        $id_service = $postData['id_service'];
        $id_mechanic = $postData['id_mechanic'];
        $date = date('Y-m-d');

        return $this->model->createBooking($kode, $id_car, $id_service, $id_mechanic, $date);
    }

    public function deleteBooking($id) {
        return $this->model->deleteBooking($id);
    }

    // Helper untuk mengisi dropdown di form
    public function prepareForm() {
        $carModel = new CarModel(); 
        $srvModel = new ServiceModel(); 
        $mecModel = new MechanicModel(); 
        
        $this->dropdownCars = $carModel->getAllCars();
        $this->dropdownServices = $srvModel->getAllServices();
        $this->dropdownMechanics = $mecModel->getAllMechanics();
    }
}
?>