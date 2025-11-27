<?php
// Load All ViewModels
require_once 'viewmodels/BookingViewModel.php';
require_once 'viewmodels/CarViewModel.php';
require_once 'viewmodels/OwnerViewModel.php';
require_once 'viewmodels/MechanicViewModel.php';
require_once 'viewmodels/ServiceViewModel.php';

$page = isset($_GET['page']) ? $_GET['page'] : 'home';

// Instansiasi semua ViewModel
$bookingVM = new BookingViewModel();
$carVM = new CarViewModel();
$ownerVM = new OwnerViewModel();
$mechVM = new MechanicViewModel();
$serviceVM = new ServiceViewModel();

switch ($page) {
    case 'home':
    case 'booking_list':
        $bookingVM->viewData();
        $viewModel = $bookingVM;
        include 'views/bookings/list.php';
        break;
    case 'booking_add':
        $bookingVM->prepareForm();
        $viewModel = $bookingVM;
        include 'views/bookings/form.php';
        break;
    case 'booking_save':
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $bookingVM->addBooking($_POST);
            header("Location: index.php?page=booking_list");
        }
        break;
    case 'booking_delete':
        $bookingVM->deleteBooking($_GET['id']);
        header("Location: index.php?page=booking_list");
        break;

    // --- CARS ---
    case 'car_list':
        $carVM->viewCars();
        $viewModel = $carVM;
        include 'views/cars/list.php';
        break;
    case 'car_add':
        $carVM->prepareForm();
        $viewModel = $carVM;
        include 'views/cars/form.php';
        break;
    case 'car_edit':
        $carVM->prepareForm($_GET['id']);
        $viewModel = $carVM;
        include 'views/cars/form.php';
        break;
    case 'car_save':
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $carVM->saveCar($_POST);
            header("Location: index.php?page=car_list");
        }
        break;
    case 'car_delete':
        $carVM->deleteCar($_GET['id']);
        break;

    // --- OWNERS ---
    case 'owner_list':
        $ownerVM->viewOwners();
        $viewModel = $ownerVM;
        include 'views/owners/list.php';
        break;
    case 'owner_add':
        $viewModel = $ownerVM;
        include 'views/owners/form.php';
        break;
    case 'owner_edit':
        $ownerVM->prepareForm($_GET['id']);
        $viewModel = $ownerVM;
        include 'views/owners/form.php';
        break;
    case 'owner_save':
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $ownerVM->saveOwner($_POST);
            header("Location: index.php?page=owner_list");
        }
        break;
    case 'owner_delete':
        $ownerVM->deleteOwner($_GET['id']);
        break;

    // --- MECHANICS ---
    case 'mech_list':
        $mechVM->viewMechanics();
        $viewModel = $mechVM;
        include 'views/mechanics/list.php';
        break;
    case 'mech_add':
        $viewModel = $mechVM;
        include 'views/mechanics/form.php';
        break;
    case 'mech_edit':
        $mechVM->prepareForm($_GET['id']);
        $viewModel = $mechVM;
        include 'views/mechanics/form.php';
        break;
    case 'mech_save':
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $mechVM->saveMechanic($_POST);
            header("Location: index.php?page=mech_list");
        }
        break;
    case 'mech_delete':
        $mechVM->deleteMechanic($_GET['id']);
        break;

    // --- SERVICES ---
    case 'service_list':
        $serviceVM->viewServices();
        $viewModel = $serviceVM;
        include 'views/services/list.php';
        break;
    case 'service_add':
        $viewModel = $serviceVM;
        include 'views/services/form.php';
        break;
    case 'service_edit':
        $serviceVM->prepareForm($_GET['id']);
        $viewModel = $serviceVM;
        include 'views/services/form.php';
        break;
    case 'service_save':
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $serviceVM->saveService($_POST);
            header("Location: index.php?page=service_list");
        }
        break;
    case 'service_delete':
        $serviceVM->deleteService($_GET['id']);
        break;

    default:
        echo "<h1 style='color:white; text-align:center; margin-top:50px;'>404 Page Not Found</h1>";
        break;
}
?>