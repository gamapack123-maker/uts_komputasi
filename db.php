<?php
// db.php
$host = 'localhost';
$db_name = 'studio_booking';
$username = 'studio_user'; // Gunakan user yang baru kita buat
$password = 'PasswordSuperAman123!'; // Ganti dengan password-mu

try {
    $db = new PDO("mysql:host=$host;dbname=$db_name", $username, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Koneksi database gagal: " . $e->getMessage());
}
?>
