<?php
  require_once 'database.php';

  // Create a new table if it doesn't exist
  $create_table_query = "CREATE TABLE IF NOT EXISTS news(
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    content TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
  )";

  if (!$mysqli->query($create_table_query)) {
    die("Error creating table: " . $mysqli->error);
  }

  if ($_POST) {
    $title = $_POST['title'];
    $content = $_POST['content'];

    // Insert the data into the database
    $stmt = $mysqli->prepare("INSERT INTO news (title, content) VALUES (?, ?)");
    $stmt->bind_param("ss", $title, $content);
    $stmt->execute();
    $stmt->close();
  }
?>
<html>
  <head><title>XSS Example</title></head>
  <body>
    <h1>XSS Example</h1>
    <form action="news.php" method="post">
      <label for="title">Title:</label>
      

      <input type="text" name="title" required>
      


      <label for="content">Content:</label>
      

      <textarea name="content" required></textarea>
      


      <input type="submit" value="Submit">
    </form>

    <hr>

    <h2>News Articles</h2>
    <!-- <?php
    // Fetch and display all news articles
    // $result = $mysqli->query("SELECT * FROM news ORDER BY created_at DESC");
    // while ($row = $result->fetch_assoc()) {
    //   echo "<h3>" . $row['title'] . "</h3>";
    //   echo "<p>" . $row['content'] . "</p>";
    //   echo "<small>Posted on " . $row['created_at'] . "</small><hr>";
    // }

    // $mysqli->close();
    // ?> -->

    <?php
    // Fetch and display all news articles
    $result = $mysqli->query("SELECT * FROM news ORDER BY created_at DESC");
    while ($row = $result->fetch_assoc()) {
      echo "<h3>" . htmlspecialchars($row['title']) . "</h3>";
      echo "<p>" . htmlspecialchars($row['content']) . "</p>";
      echo "<small>Posted on " . $row['created_at'] . "</small><hr>";
    }

    $mysqli->close();
    ?>
  </body>
</html>