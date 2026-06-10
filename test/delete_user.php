<?php
require_once 'database.php';

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = intval($_GET['id']);
    $stmt = $mysqli->prepare("DELETE FROM users WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    if ($mysqli->affected_rows > 0) {
        header("Location: view_users.php?status=success");
    } else {
        header("Location: view_users.php?status=notfound&id=" . $id);
    }

    $stmt->close();
} else {
    header("Location: view_users.php");
}

$mysqli->close();
exit();
?>