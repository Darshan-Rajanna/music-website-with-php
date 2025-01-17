<?php
session_start();
if (!isset($_SESSION['loggedin'])||$_SESSION['loggedin']!=true) {
    header("location: admin_signin.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Add Album</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<style>
  body {
    margin: 0;
    padding: 0;
    height: 100vh;
    justify-content:center;
    align-items: top;
    background: linear-gradient(135deg, #667eea, #764ba2);
    overflow: hidden;
    font-family: Arial, sans-serif;
  }

  .navbar {
    background: #333;
    color: white;
    padding: 10px 20px;
    display: flex;
    justify-content: space-between;
    align-items: center;
  }

  .navbar h1 {
    margin: 0;
  }

  .form-container {
    max-width: 500px;
    margin: 20px auto;
    padding: 20px;
    background: #fff;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  }

  form {
    display: flex;
    flex-direction: column;
    align-items: center;
  }

  label {
    margin-bottom: 10px;
  }

  input[type="text"] {
    width: 100%;
    padding: 8px;
    margin-bottom: 10px;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
  }
  .adding{
    max-width: 500px;
    margin: 20px auto;
    padding: 20px;
    background: #fff;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  }
  .adding form{
    max-width: 400px;
  }

  
  button {
    padding: 8px 16px;
    background-color: #333;
    color: white;
    border: none;
    border-radius: 4px;
    cursor: pointer;
  }

  button:hover {
    background-color: #555;
  }
</style>
</head>
<body>
<div class="navbar">
    <h1>Add Album</h1>
    <a href="./admin_albums.php" style="color: white; text-decoration: none;"><i class="fas fa-arrow-left"></i> Back to Dashboard</a>
</div>

<div class="form-container">
    <h2>Add Album</h2>
    <form action="admin_add_album.php" method="post" enctype="multipart/form-data">
        <label for="Album">Album:</label>
        <input type="text" id="Album" name="Album" required>
        <label for="dates">Release Date:</label>
        <input type="text" id="dates" name="dates" required>
        <label for="album_cover">Album Cover Photo:</label>
        <input type="file" id="album_cover" name="album_cover" accept="image/*" required>
        <input type="submit" value="Add Album" name="submit">
    </form>
  
</div>
<?php
require 'connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $Album = $_POST["Album"];
  $dates = $_POST["dates"];

  $target_dir = "images/"; 
  $album_cover_file = $target_dir . basename($_FILES["album_cover"]["name"]); 
  move_uploaded_file($_FILES["album_cover"]["tmp_name"], $album_cover_file); 

  $sql = "INSERT INTO albums (Album, no_songs, dates, Album_cover) VALUES ('$Album', NULL, '$dates', '$album_cover_file')";
  $res = mysqli_query($conn, $sql);
  if ($res) {
      header("Location: admin_albums.php?uploaded=true");
  } else {
      header("Location: admin_add_album.php?Error=true");
  }
}

if (isset($_GET['Error']) && $_GET['Error']) {
  ?>
  <script>
      alert("Album uploading failed");
  </script>
  <?php
}
?>
</body>
</html>
