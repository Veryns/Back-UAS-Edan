<?php
require_once('database.php');

$query = "SELECT * FROM users";
$result = $mysqli->query($query);
?>
<html>
    <head><title>View Users</title></head>
    <body>
        <h1>View Users</h1>
        <?php if (isset($_GET['error'])): ?>
            <div style="color: red; border: 1px solid red; padding: 8px; margin-bottom: 12px;">
                Error: <?= htmlspecialchars($_GET['error']) ?>
            </div>
        <?php endif; ?>

        <?php if (isset($_GET['success'])): ?>
            <div style="color: green; border: 1px solid green; padding: 8px; margin-bottom: 12px;">
                <?= htmlspecialchars($_GET['success']) ?>
            </div>
        <?php endif; ?>

        <table border="1">
            <tr>
                <th>ID</th>
                <th>Email</th>
                <th>Password</th>
                <th>Actions</th>
            </tr>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= $row['id'] ?></td>
                    <td><?= htmlspecialchars($row['email']) ?></td>
                    <td><?= htmlspecialchars($row['password']) ?></td>
                    <td>
                        <a href="delete_user.php?id=<?= $row['id'] ?>"
                           onclick="return confirm('Yakin ingin menghapus user ini?')">
                            Hapus
                        </a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </table>
    </body>
</html>
<?php $mysqli->close(); ?>