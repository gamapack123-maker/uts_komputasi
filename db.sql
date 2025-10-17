-- 1. Buat database-nya
CREATE DATABASE studio_booking;

-- 2. Gunakan database tersebut
USE studio_booking;

-- 3. Buat tabel untuk menyimpan data booking
CREATE TABLE bookings (
    id INT AUTO_INCREMENT PRIMARY KEY,
    customer_name VARCHAR(100) NOT NULL,
    phone_number VARCHAR(20) NOT NULL,
    booking_date DATE NOT NULL,
    start_time TIME NOT NULL,
    package_type VARCHAR(50),
    status VARCHAR(20) DEFAULT 'Confirmed',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
