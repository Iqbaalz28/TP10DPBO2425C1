# TP10DPBO2425C1
## 🙏🏻 Agreement

I, Iqbal Rizky Maulana, with student ID number 2408622, have completed Practical Assignment 10 for the Object-Oriented Design and Programming course for His blessings, and I have not committed any acts of cheating as specified. Amen.
# 🔰 JDM Workshop Management System (MVVM PHP)

![Project Status](https://img.shields.io/badge/status-active-success)
![PHP Version](https://img.shields.io/badge/php-%3E%3D7.4-blue)
![Architecture](https://img.shields.io/badge/architecture-MVVM-orange)
![Style](https://img.shields.io/badge/style-JDM%20Cyberpunk-ff0055)

A comprehensive web-based management system for a **JDM (Japanese Domestic Market) Performance Shop**. This project demonstrates the implementation of the **Model-View-ViewModel (MVVM)** architecture pattern using **Native PHP** (without frameworks).

## 📖 About The Project

This application is designed to manage day-to-day operations of a specialized car workshop. Unlike traditional MVC web apps, this project strictly separates the **Business Logic (ViewModel)** from the **UI (View)** and **Data Access (Model)**.

**Key Design Principles:**
* **Separation of Concerns:** ViewModels handle all data processing, formatting, and business rules.
* **Data Binding:** Views are "dumb"; they only display pre-processed data objects provided by ViewModels.
* **OOP Standards:** Usage of Inheritance, Encapsulation, and Interfaces (based on academic modules).

## ✨ Key Features

### 🛠️ Core Modules (CRUD)
1.  **Garage/Cars Management**: Manage customer cars with automatic "Legendary Engine" detection (e.g., 2JZ, RB26).
2.  **Booking System**: Transaction processing for Service & Dyno Tuning.
3.  **Tuner/Mechanic Roster**: Manage mechanics with specific engine specializations (Rotary, V-Type, etc.).
4.  **Service Catalog**: List of services and parts with dynamic icons.
5.  **Owners/Members**: Customer management with Membership tiers.

### 🧠 Business Logic (ViewModel Intelligence)
* **VIP Membership System**: Automatic **15% Discount** calculation for owners with `JDM_VIP` status.
* **Tuner Compatibility Check**: System warns (`⚠️ Tuner Mismatch`) if a Rotary engine car is assigned to a non-Rotary specialist.
* **Dynamic Status Badging**: Visual indicators for booking statuses (Pending, OnProcess, Done).
* **Auto-Generated Codes**: Booking codes generated automatically (e.g., `JDM-2025-X99`).

## 📂 Project Structure (MVVM)

```text
JDM_Workshop/
│
├── config/             # Database Connection (MySQLi Wrapper)
│   └── Database.php
│
├── models/             # Data Access Layer (Pure SQL Queries)
│   ├── BookingModel.php
│   ├── CarModel.php
│   └── ...
│
├── viewmodels/         # Logic Layer & Data Binding
│   ├── BookingViewModel.php  <-- Brain of the application
│   ├── CarViewModel.php
│   └── ...
│
├── views/              # Presentation Layer (HTML/CSS)
│   ├── bookings/
│   ├── cars/
│   └── templates/      # Header & Footer (Cyberpunk Theme)
│
└── index.php           # Simple Router / Controller
```

## 📚 References & Architecture Analysis
This project implements MVVM in PHP as follows:

### 1. Model: Extends Database class. Contains methods like getAllCars(), createBooking(). Returns raw ResultSet.
### 2. ViewModel:
   
  - Instantiates the Model.
  - Fetches raw data.
  - Processes Logic: Converts price to Rp 1.000.000, determines statusColor, calculates discounts.
  - Binds Data: Stores processed objects into public properties (e.g., $this->dataList).
    
### 3. View:
   
  - Includes the ViewModel.
  - Loops through $viewModel->dataList.
  - Zero logic (no if-else for business rules), purely display.

## 🗄️ Database Schema Architecture

The system uses a normalized relational database (`jdm_workshop`) consisting of 6 tables.

### 1. Master Data (Reference Tables)
* **`owners`** (Customers)
    * Stores customer details.
    * **Key Attribute:** `membership_status` (`Reguler` / `JDM_VIP`). This triggers the **15% Discount Logic**.
* **`mechanics`** (Tuners)
    * Stores staff expertise.
    * **Key Attribute:** `spesialisasi` (`Rotary`, `Inline-6`, etc.). Used for **Compatibility Validation**.
* **`services`** (Catalog)
    * Stores available services and parts.
    * **Key Attribute:** `jenis` (`Service` / `Dyno Tuning`). Determines UI Icons.

### 2. Transactional Data
* **`cars`** (Inventory)
    * Links cars to `owners`.
    * **Relation:** Foreign Key to `owners(id)` (ON DELETE CASCADE).
    * **Key Attribute:** `kode_mesin`. Used to detect "Legendary Engines" (e.g., 2JZ, RB26).
* **`bookings`** (Main Transaction)
    * The central table linking `cars`, `services`, and `mechanics`.
    * **Attributes:** `kode_booking`, `tanggal`, `total_biaya`, `status`.
* **`service_logs`** (History)
    * Stores technical notes for specific bookings.
    * **Relation:** Foreign Key to `bookings(id)`.
 
## 🔄 System Workflow (MVVM Pattern)

The data flow follows a strict **One-Way Dependency** rule: View depends on ViewModel, ViewModel depends on Model.

### Step 1: User Request (Controller Layer)
* **Action:** User accesses `index.php?page=booking_list`.
* **Router:** The `index.php` acts as a simple router. It instantiates the specific **ViewModel** (`BookingViewModel`) required for the page.

### Step 2: Data Fetching (Model Layer)
* **Action:** ViewModel calls `$this->model->getAllBookings()`.
* **Execution:** The **Model** (`BookingModel.php`) executes complex SQL JOIN queries to fetch raw data from MySQL. It returns a raw `ResultSet`.

### Step 3: Logic Processing (ViewModel Layer) 🧠
* **Action:** ViewModel iterates through the raw data.
* **Business Logic Execution:**
    1.  **VIP Check:** Calculates discounted price if Owner is VIP.
    2.  **Validation:** Checks if the Car's Engine matches the Mechanic's Specialization. If not, adds a warning flag.
    3.  **Formatting:** Converts dates, currency (IDR), and determines status colors (e.g., Pending = Yellow).
* **Binding:** The processed objects are stored in a public property (e.g., `$viewModel->dataList`).

### Step 4: Presentation (View Layer)
* **Action:** The Router includes the View file (`views/bookings/list.php`).
* **Rendering:** The View iterates through `$viewModel->dataList` and renders HTML.
* **Result:** The user sees a fully formatted page with badges, colors, and alerts, without the View performing any calculations.
