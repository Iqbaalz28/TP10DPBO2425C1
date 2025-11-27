<?php
include_once 'config/Database.php';

class BookingModel extends Database {
    
    public function getAllBookings() {
        // Join kompleks untuk mendapatkan data lengkap (Sesuai syarat minimal 2 relasi)
        $query = "SELECT b.*, c.model, c.kode_mesin, o.nama_owner, o.membership_status, 
                         s.nama_layanan, s.harga, s.jenis, m.nama_tuner, m.spesialisasi
                  FROM bookings b
                  JOIN cars c ON b.id_car = c.id
                  JOIN owners o ON c.id_owner = o.id
                  JOIN services s ON b.id_service = s.id
                  JOIN mechanics m ON b.id_mechanic = m.id
                  ORDER BY b.id DESC";
        return $this->execute($query);
    }

    public function createBooking($kode, $car, $service, $mech, $date) {
        $query = "INSERT INTO bookings (kode_booking, id_car, id_service, id_mechanic, tanggal) 
                  VALUES ('$kode', '$car', '$service', '$mech', '$date')";
        return $this->execute($query);
    }

    public function deleteBooking($id) {
        $query = "DELETE FROM bookings WHERE id = '$id'";
        return $this->execute($query);
    }
    
    // Method update status (untuk alur bengkel)
    public function updateStatus($id, $status) {
        $query = "UPDATE bookings SET status = '$status' WHERE id = '$id'";
        return $this->execute($query);
    }
}
?>