<?php
    require_once 'database.php';

    $pesan_error = "";
    if (isset($_GET['id']) && !empty($_GET['id'])) {
        $id_cari = intval($_GET['id']);
        
        // Query untuk cek apakah ID ada di database
        $cek_query = $mysqli->prepare("SELECT email FROM users WHERE id = ?");
        $cek_query->bind_param("i", $id_cari);
        $cek_query->execute();
        $hasil_cek = $cek_query->get_result();

        if ($hasil_cek->num_rows > 0) {
            $data_user = $hasil_cek->fetch_assoc();
            $pesan_error = "<p style='color: black;'><b>User dengan email " . $data_user['email'] . " ditemukan.</b></p>";
        } else {
            $pesan_error = "<p style='color: black;'><b>User dengan ID $id_cari tidak ditemukan.</b></p>";
        }
        $cek_query->close();
    }

    $query = "SELECT * FROM users";
    $result = $mysqli->query($query);
?>
<html>
    <head><title>View Users</title></head>
    <body>
        <h1>Users</h1>

        <?php 
            echo $pesan_error; 
            if (isset($_GET['status']) && $_GET['status'] == 'success') {
                echo "<p style='color: black;'><b>User berhasil dihapus.</b></p>";
            }
        ?>

        <table border="1">
            <tr>
                <th>ID</th>
                <th>Email</th>
                <th>Password</th>
                <th>Aksi</th>
            </tr>
            <?php
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["id"] . "</td>";
                    echo "<td>" . $row["email"] . "</td>";
                    echo "<td>" . $row["password"] . "</td>";
                    echo "<td>
                            <a href='delete_user.php?id=" . $row["id"] . "' 
                               onclick=\"return confirm('Apakah anda ingin menghapus user dengan email " . $row["email"] . "?')\">
                               Hapus
                            </a>
                          </td>";
                    echo "</tr>";
                }
            ?>
        </table>
    </body>    
</html>
<?php
    $mysqli->close();
?>