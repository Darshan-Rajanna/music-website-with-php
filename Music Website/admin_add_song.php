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
<title>Add Song</title>
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

  input[type="text"],
  input[type="file"] {
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
    <h1>Add/Edit Song</h1>
    <a href="./admin_songs.php" style="color: white; text-decoration: none;"><i class="fas fa-arrow-left"></i> Back to Songs</a>
</div>

<div class="form-container">
    <h2>Add Song</h2>
    <form action="admin_upload_song.php" method="post" enctype="multipart/form-data">
        <label for="title">Title:</label>
        <input type="text" id="title" name="Title" required>
        <label for="audio">Audio:</label>
        <input type="file" id="audio" name="audio" accept=".mp3" required>
        <label for="artist">Artist:</label>
<select id="artist" name="Artist" required>
    <?php
    include "connection.php";

    // Fetch artist names from the database
    $sql = "SELECT * FROM artists;";
    $res = mysqli_query($conn, $sql);

    // Check if there are any results
    if (mysqli_num_rows($res) > 0) {
        // Output data of each row
        while ($row = mysqli_fetch_assoc($res)) {
            echo "<option value='" . $row['Artist'] . "'>" . $row['Artist'] . "</option>";
        }
    } else {
        echo "<option value=''>No artists found</option>";
    }

    // Close connection
    mysqli_close($conn);
    ?>
</select>

<label for="album">Album:</label>
<select id="album" name="Album" required>
    <?php
    include "connection.php";

    // Fetch album names from the database
    $sql = "SELECT * FROM albums;";
    $res = mysqli_query($conn, $sql);

    // Check if there are any results
    if (mysqli_num_rows($res) > 0) {
        // Output data of each row
        while ($row = mysqli_fetch_assoc($res)) {
            echo "<option value='" . $row['Album'] . "'>" . $row['Album'] . "</option>";
        }
    } else {
        echo "<option value=''>No albums found</option>";
    }

    // Close connection
    mysqli_close($conn);
    ?>
</select>
        <input type="submit" value="Add Song" name="submit">
    </form>
  
</div>

<?php
    if(isset($_GET['Error']) && $_GET['Error']){
?>
      <script>
        alert("Audio uploading failed");
      </script>
<?php
    }
?>
</body>
</html>
