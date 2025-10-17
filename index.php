<?php
// index.php
require 'db.php';

// C: Logika CREATE (Tambah Data)
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add'])) {
    $stmt = $db->prepare("INSERT INTO bookings (customer_name, phone_number, booking_date, start_time, package_type) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([
        $_POST['customer_name'],
        $_POST['phone_number'],
        $_POST['booking_date'],
        $_POST['start_time'],
        $_POST['package_type']
    ]);
    header("Location: index.php"); // Refresh halaman
    exit;
}

// R: Logika READ (Ambil Semua Data)
$stmt = $db->query("SELECT * FROM bookings ORDER BY booking_date DESC, start_time DESC");
$bookings = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Booking Studio Foto</title>
    <style>
        body { font-family: sans-serif; margin: 2em; background: #f4f4f4; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #ccc; padding: 8px; text-align: left; }
        th { background: #333; color: white; }
        form { background: white; padding: 20px; border-radius: 8px; margin-bottom: 20px; }
        input, select { width: calc(100% - 20px); padding: 8px; margin-bottom: 10px; }
        button { background: #333; color: white; padding: 10px 15px; border: none; cursor: pointer; }
        .actions a { text-decoration: none; padding: 5px; }
        .edit { color: blue; }
        .delete { color: red; }
    </style>
</head>
<body>
    <h1>Papan Kontrol Booking Studio</h1>

    <form method="POST">
        <h2>Tambah Booking Baru</h2>
        <input type="text" name="customer_name" placeholder="Nama Customer" required>
        <input type="text" name="phone_number" placeholder="Nomor Telepon" required>
        <input type="date" name="booking_date" required>
        <input type="time" name="start_time" required>
        <select name="package_type">
            <option value="Paket A">Paket A</option>
            <option value="Paket B">Paket B</option>
            <option value="Paket C">Paket C</option>
        </select>
        <button type="submit" name="add">Tambah Booking</button>
    </form>

    <h2>Daftar Booking</h2>
    <table>
        <thead>
            <tr>
                <th>Nama</th>
                <th>Telepon</th>
                <th>Tanggal</th>
                <th>Waktu</th>
                <th>Paket</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($bookings as $book): ?>
            <tr>
                <td><?= htmlspecialchars($book['customer_name']) ?></td>
                <td><?= htmlspecialchars($book['phone_number']) ?></td>
                <td><?= htmlspecialchars($book['booking_date']) ?></td>
                <td><?= htmlspecialchars($book['start_time']) ?></td>
                <td><?= htmlspecialchars($book['package_type']) ?></td>
                <td class="actions">
                    <a href="edit.php?id=<?= $book['id'] ?>" class="edit">Edit</a>
                    <a href="delete.php?id=<?= $book['id'] ?>" class="delete" onclick="return confirm('Yakin mau hapus data ini?')">Hapus</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
