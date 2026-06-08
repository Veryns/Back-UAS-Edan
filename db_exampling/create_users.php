<html>
    <head><title>Create Users</title></head>
    <body>
        <h1>Create Users</h1>
        <form action="create_users.php" method="post">
            <label for="email">Email:</label>
            <br>
            <input type="email" id="email" name="email" required>
            <br><br>
            <label for="password">Password:</label>
            <br>
            <input type="password" id="password" name="password" required>
            <br><br>
            <input type="submit" value="Create User">
        </form>
        <?php
        require_once('database.php');
        
        if ($_POST){
            $email = $_POST ['email'] ;
            $password = $_POST ['password'] ;

            $query = "INSERT INTO users (email, password) VALUES ('$email', '$password')";
            if ($mysqli->query($query)){
                echo "User created successfully";
            } else {
                echo "Error: " . $mysqli->error;
            }
            $mysqli->close();

        }
        ?>
    </body>
</html>