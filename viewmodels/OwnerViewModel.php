<?php
include_once 'models/OwnerModel.php';

class OwnerViewModel {
    private $model;
    public $ownerList = [];
    public $editData = null;

    public function __construct() {
        $this->model = new OwnerModel();
    }

    public function viewOwners() {
        $result = $this->model->getAllOwners();
        $this->ownerList = [];

        while ($row = $result->fetch_assoc()) {
            $owner = new stdClass();
            $owner->id = $row['id'];
            $owner->nama = $row['nama_owner'];
            $owner->kontak = $row['kontak'];
            
            // Logic Tampilan VIP
            if ($row['membership_status'] == 'JDM_VIP') {
                $owner->status_badge = "<span class='badge-vip' style='font-size:0.8em'>VIP MEMBER</span>";
                $owner->row_style = "border-left: 3px solid var(--neon-pink);";
            } else {
                $owner->status_badge = "<span style='color:#888'>Reguler</span>";
                $owner->row_style = "";
            }

            $this->ownerList[] = $owner;
        }
    }

    public function prepareForm($id = null) {
        if ($id) {
            $this->editData = $this->model->getOwnerById($id);
        }
    }

    public function saveOwner($data) {
        if (!empty($data['id'])) {
            return $this->model->updateOwner($data['id'], $data['nama'], $data['kontak'], $data['status']);
        } else {
            return $this->model->createOwner($data['nama'], $data['kontak'], $data['status']);
        }
    }

    public function deleteOwner($id) {
        return $this->model->deleteOwner($id);
    }
}
?>