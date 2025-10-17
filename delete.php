<?php
// delete.php
require 'db.php';

$id = $_GET['id'] ?? null;
if ($id) {
    $stmt = $db->prepare("DELETE FROM bookings WHERE id = ?");
    $stmt->execute([$id]);
}

header("Location: index.php");
exit;
?>
