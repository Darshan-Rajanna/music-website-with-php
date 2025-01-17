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
  <title>Edit Song</title>
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
    <h1>Edit Song</h1>
    <a href="./admin_songs.php" style="color: white; text-decoration: none;"><i class="fas fa-arrow-left"></i> Back to
      Songs</a>
  </div>

  <div class="form-container">
    <h2>Edit Song</h2>
    <?php
    include "connection.php";
    $title = $_GET['title'];
    $sql = "SELECT * from songs where Title = '$title'";
    $res = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($res);
    $title = $row['Title'];
    $Artist = $row['Artist'];
    $Album = $row['Album'];
    $audio = $row['audio'];
    ?>
    <form action="admin_edit_song.php" method="post" enctype="multipart/form-data">
      <label for="title">Edit Title:</label>
      <input type="text" id="title" name="Title" value="<?php echo $title ?>" required>
      <input type="hidden" id="title" name="title" value="<?php echo $title ?>" required>
      <label for="artist">Edit Artist:</label>
      <input type="text" id="Artist" name="Artist" value="<?php echo $Artist ?>" required>
      <label for="album">Edit Album:</label>
      <input type="text" id="Album" name="Album" value="<?php echo $Album ?>" required>
      <label for="album">Edit Audio:</label>
      <input type="text" id="audio" name="audio" value="<?php echo $audio ?>" required>
      <input type="submit" value="Edit Song" name="submit">
    </form>
    <?php
    if (isset($_POST['submit'])) {
      $Title = $_POST['Title'];
      $title = $_POST['title'];
      $Artist = $_POST['Artist'];
      $Album = $_POST['Album'];
      $audio = $_POST['audio'];
      $sql = "UPDATE songs SET Title = '$Title', Artist = '$Artist', Album = '$Album', audio = '$audio' WHERE Title = '$title';";

      $res = mysqli_query($conn, $sql);
      if ($res) {
        header("Location: admin_songs.php?Edited=true?$sql");
      } else {
        header("Location: admin_editing_song.php?Error=true");
      }
    }
    ?>
  </div>
  <?php
  if (isset($_GET['Error']) && $_GET['Error']) {
    ?>
    <script>
      alert("Audio uploading failed");
    </script>
    <?php
  }
  ?>
</body>

</html>