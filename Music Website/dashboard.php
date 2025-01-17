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
<title>Music Database Dashboard</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<style>
  body {
    margin: 0;
    overflow:scroll;
    padding: 0;
    justify-content:center;
    align-items: top;
    background: linear-gradient(135deg, #667eea, #764ba2);
    font-family: Arial, sans-serif;   
  }

  .navbar {
    background: linear-gradient(135deg, #ea6666, #764ba2);
    color: white;
    padding: 10px 20px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    position: sticky;
    top:0px;
  }

  .navbar h1 {
    margin: 0;
    
  }

  .sidebar {
    position: fixed;
    left: 0;
    top: 60px;
    height: calc(100% - 60px);
    width: 250px;
    background: linear-gradient(135deg, #ea6666, #764ba2);
    padding-top: 20px;
    transition: all 0.3s;
  }

  .sidebar a {
    display: block;
    color: white;
    padding: 10px 20px;
    text-decoration: none;
    transition: background 0.3s;
  }

  .sidebar a:hover {
    background: #555;
  }

  .content {
    margin-left: 250px;
    padding: 20px;
    transition: all 0.3s;
  }

  h2 {
    margin-top: 0;
  }

  table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
  }

  table, th, td {
    border: 1px solid #ddd;
    padding: 8px;
    text-align: left;
  }

  th {
    background-color: #f2f2f2;
  }
</style>
</head>
<body>
<div class="navbar">
  <h1>Music Database Dashboard</h1>
  <div>
    <span>Welcome, Admin</span>
    <a href="./logout.php">Logout</a>
  </div>
</div>
<div class="sidebar" id="sidebar">
  <a href="./dashboard.php" class="active"><i class="fas fa-database"></i> Database</a>
  <a href="./admin_songs.php"><i class="fas fa-music"></i> Songs</a>
  <a href="./admin_albums.php"><i class="fas fa-compact-disc"></i> Albums</a>
  <a href="./admin_artists.php"><i class="fas fa-user"></i> Artists</a>
  <a href="./admin_users.php"><i class="fas fa-users"></i> Users</a>
</div>
<div class="content" id="content">
  <h2>Database Overview</h2>
  <p>Provide an overview of the music database here.</p>

  <!-- <div class="row"> -->
  <div class="col-sm-6">
    <div class="card">
      <div class="card-body">
        <h1 class="card-title">
      <?php
        include "connection.php";
        $sql = "SELECT COUNT(*) AS song_count FROM songs;";
        $res=mysqli_query($conn, $sql);
        $row=mysqli_fetch_assoc($res);
        echo $row['song_count'];
      ?>
      </h1>
        <p class="card-text"><h5>Songs count</h5></p>
        <a href="./admin_songs.php" class="btn btn-primary">view songs</a>
      </div>
    </div>
  </div>
  <h2></h2>
  <div class="col-sm-6">
    <div class="card">
      <div class="card-body">
      <h1 class="card-title">
      <?php
        include "connection.php";
        $sql = "SELECT COUNT(*) AS album_count FROM albums;";
        $res=mysqli_query($conn, $sql);
        $row=mysqli_fetch_assoc($res);
        echo $row['album_count'];
      ?>
      </h1>
        <p class="card-text"><h5>Albums Counts</h5></p>
        <a href="./admin_albums.php" class="btn btn-primary">view Albums</a>
      </div>
    </div>
  </div>
<!-- </div> -->
<h2></h2>
<!-- <div class="row"> -->
  <div class="col-sm-6">
    <div class="card">
      <div class="card-body">
        <h1 class="card-title">
          <?php
        include "connection.php";
        $sql = "SELECT COUNT(*) AS artist_count FROM artists;";
        $res=mysqli_query($conn, $sql);
        $row=mysqli_fetch_assoc($res);
        echo $row['artist_count'];
      ?>
        </h1>
        <p class="card-text"><h5>Artist count</h5></p>
        <a href="./admin_artists.php" class="btn btn-primary">view Artists</a>
      </div>
    </div>
  </div>
  <h2></h2>
  <div class="col-sm-6">
    <div class="card">
      <div class="card-body">
      <h1 class="card-title">
          <?php
        include "connection.php";
        $sql = "SELECT COUNT(*) AS user_count FROM user_login;";
        $res=mysqli_query($conn, $sql);
        $row=mysqli_fetch_assoc($res);
        echo $row['user_count'];
      ?>
        </h1>
        <p class="card-text"><h5>Users Counts</h5></p>
        <a href="./admin_users.php" class="btn btn-primary">view Users</a>
      </div>
    </div>
  </div>
<!-- </div> -->
<!-- <script>
  document.getElementById('sidebar').addEventListener('click', function(e) {
    var links = document.querySelectorAll('.sidebar a');
    for (var i = 0; i < links.length; i++) {
      links[i].classList.remove('active');
    }
    e.target.classList.add('active');
  });
</script> -->
</div>
</body>

</html>
