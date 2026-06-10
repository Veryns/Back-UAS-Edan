<?php
require_once('database.php');

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header("Location: view_users.php?error=" . urlencode("ID user tidak valid."));
    exit;
}

$id = (int) $_GET['id'];

$stmt = $mysqli->prepare("DELETE FROM users WHERE id = ?");
$stmt->bind_param("i", $id);

if (!$stmt->execute()) {
    $errorMsg = "Gagal menghapus user: " . $stmt->error;
    $stmt->close();
    header("Location: view_users.php?error=" . urlencode($errorMsg));
    exit;
}

if ($stmt->affected_rows === 0) {
    $stmt->close();
    $mysqli->close();
    header("Location: view_users.php?error=" . urlencode("User dengan ID $id tidak ditemukan."));
    exit;
}

$stmt->close();
$mysqli->close();

header("Location: view_users.php?success=" . urlencode("User dengan ID $id berhasil dihapus."));
exit;