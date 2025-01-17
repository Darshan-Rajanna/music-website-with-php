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
  <title>Edit Album</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <style>
    body {
      margin: 0;
      padding: 0;
      height: 100vh;
      justify-content: center;
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
    <h1>Edit Album</h1>
    <a href="./admin_songs.php" style="color: white; text-decoration: none;"><i class="fas fa-arrow-left"></i> Back to
      Album</a>
  </div>

  <div class="form-container">
    <h2>Edit Album</h2>
    <?php
    include "connection.php";
    $album = $_GET['album'];
    $sql = "SELECT * from albums where Album = '$album'";
    $res = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($res);
    $album = $row['Album'];
    $dates = $row['dates'];
    ?>
    <form action="admin_edit_album.php" method="post" enctype="multipart/form-data">
      <label for="Album">Edit Album title:</label>
      <input type="text" id="album" name="Album" value="<?php echo $album ?>" required>
      <input type="hidden" id="album" name="album" value="<?php echo $album ?>" required>
      <label for="dates">Edit Release date:</label>
      <input type="text" id="dates" name="dates" value="<?php echo $dates ?>" required>
      <input type="submit" value="Edit Album" name="submit">
    </form>
    <?php
    if (isset($_POST['submit'])) {
      # code...
      $Album = $_POST['Album'];
      $album = $_POST['album'];
      $dates = $_POST['dates'];
      $sql = "UPDATE albums SET Album = '$Album', dates = '$dates' WHERE Album = '$album';";

      $res = mysqli_query($conn, $sql);
      if ($res) {
        header("Location: admin_albums.php?Edited=true?$sql");
      } else {
        header("Location: admin_edit_album.php?Error=true");
      }
    }
    // Now let's Insert the video path into database
    ?>


  </div>
  <?php
  if (isset($_GET['Error']) && $_GET['Error']) {
    ?>
    <script>
      alert("Album editing failed");
    </script>
    <?php
  }
  ?>
</body>

</html>