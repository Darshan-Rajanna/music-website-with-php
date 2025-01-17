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
    <h1>Edit Artist</h1>
    <a href="./admin_songs.php" style="color: white; text-decoration: none;"><i class="fas fa-arrow-left"></i> Back to
      Album</a>
  </div>

  <div class="form-container">
    <h2>Edit Artist</h2>
    <?php
    include "connection.php";
    $artist = $_GET['artist'];
    $sql = "SELECT * from artists where Artist = '$artist'";
    $res = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($res);
    $artist = $row['Artist'];
    ?>
    <form action="admin_edit_artist.php" method="post" enctype="multipart/form-data">
      <label for="Album">Edit Artist title:</label>
      <input type="text" id="artist" name="Artist" value="<?php echo $artist ?>" required>
      <input type="hidden" id="artist" name="artist" value="<?php echo $artist ?>" required>
      <input type="submit" value="Edit Artist" name="submit">
    </form>
    <?php
    if (isset($_POST['submit'])) {
      # code...
      $Artist = $_POST['Artist'];
      $artist = $_POST['artist'];
      $sql = "UPDATE artists SET Artist = '$Artist' WHERE Artist = '$artist';";

      $res = mysqli_query($conn, $sql);
      if ($res) {
        header("Location: admin_artists.php?Edited=true?$sql");
      } else {
        header("Location: admin_edit_artist.php?Error=true");
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