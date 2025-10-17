<?php
// edit.php
require 'db.php';

$id = $_GET['id'] ?? null;
if (!$id) {
    header("Location: index.php");
    exit;
}

// U: Logika UPDATE
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update'])) {
    $stmt = $db->prepare("UPDATE bookings SET customer_name=?, phone_number=?, booking_date=?, start_time=?, package_type=? WHERE id=?");
    $stmt->execute([
        $_POST['customer_name'],
        $_POST['phone_number'],
        $_POST['booking_date'],
        $_POST['start_time'],
        $_POST['package_type'],
        $id
    ]);
    header("Location: index.php");
    exit;
}

// Ambil data lama untuk ditampilkan di form
$stmt = $db->prepare("SELECT * FROM bookings WHERE id = ?");
$stmt->execute([$id]);
$book = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$book) {
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Booking</title>
    <style>
        body { font-family: sans-serif; margin: 2em; background: #f4f4f4; }
        form { background: white; padding: 20px; border-radius: 8px; }
        input, select { width: calc(100% - 20px); padding: 8px; margin-bottom: 10px; }
        button { background: #007bff; color: white; padding: 10px 15px; border: none; cursor: pointer; }
    </style>
</head>
<body>
    <h1>Edit Booking: <?= htmlspecialchars($book['customer_name']) ?></h1>

    <form method="POST">
        <input type="text" name="customer_name" value="<?= htmlspecialchars($book['customer_name']) ?>" required>
        <input type="text" name="phone_number" value="<?= htmlspecialchars($book['phone_number']) ?>" required>
        <input type="date" name="booking_date" value="<?= htmlspecialchars($book['booking_date']) ?>" required>
        <input type="time" name="start_time" value="<?= htmlspecialchars($book['start_time']) ?>" required>
        <select name="package_type">
            <option value="Paket A" <?= $book['package_type'] == 'Paket A' ? 'selected' : '' ?>>Paket A</option>
            <option value="Paket B" <?= $book['package_type'] == 'Paket B' ? 'selected' : '' ?>>Paket B</option>
            <option value="Paket C" <?= $book['package_type'] == 'Paket C' ? 'selected' : '' ?>>Paket C</option>
        </select>
        <button type="submit" name="update">Update Data</button>
    </form>
    <a href="index.php">Kembali ke Daftar</a>
</body>
</html>
