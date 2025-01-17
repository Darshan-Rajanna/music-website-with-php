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
<title>Manage Songs</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
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
    <h1>Music Database - Songs</h1>
    <a href="./admin_add_song.php"><button>Add Song</button></a>
</div>
<div class="sidebar" id="sidebar">
    <a href="./dashboard.php" class="active"><i class="fas fa-database"></i> Database</a>
    <a href="./admin_songs.php"><i class="fas fa-music"></i> Songs</a>
    <a href="./admin_albums.php"><i class="fas fa-compact-disc"></i> Albums</a>
    <a href="./admin_artists.php"><i class="fas fa-user"></i> Artists</a>
    <a href="./admin_users.php"><i class="fas fa-users"></i> Users</a>
  </div>
<div class="content">
    <table>
        <tr>
            <th>Title</th>
            <th>Artist</th>
            <th>Album</th>
            <th>audio</th>
            <th>Options</th>
        </tr>
        <?php
        include "connection.php";
        $sql="SELECT * FROM songs";
        $res=mysqli_query($conn, $sql);
        $num=mysqli_num_rows($res);
        for ($i=0; $i <$num ; $i++) { 
          $row=mysqli_fetch_assoc($res);
          $abc=$row['audio']
        ?>
        <tr>
            <td><?php echo $row['Title'] ?></td>
            <td><?php echo $row['Artist'] ?></td>
            <td><?php echo $row['Album'] ?></td>
            
            <td>
              <?php
              echo "<audio controls>";
              echo "<source src='$abc' type='audio/mpeg'>";
              echo "Your browser does not support the audio element.";
              echo "</audio>";
              echo "<br>";
             ?>
             </td>
            <td>
                <a href="./admin_edit_song.php?title=<?php echo $row['Title'] ?>"><button>Edit</button></a>
                <a href="./admin_delete_songs.php?title=<?php echo $row['Title'] ?>"><button>Delete</button></a>
            </td>
        </tr>
        <?php

        }
        ?>
        
    </table>
</div>
<!-- <script>
  document.getElementById('sidebar').addEventListener('click', function(e) {
    var links = document.querySelectorAll('.sidebar a');
    for (var i = 0; i < links.length; i++) {
      links[i].classList.remove('active');
    }
    e.target.classList.add('active');
  });
</script> -->

<?php
    if(isset($_GET['uploaded']) && $_GET['uploaded']){
?>
      <script>
        alert("Audio uploaded sucessfully");
      </script>
<?php
    }
?>
<?php
    if(isset($_GET['Edited']) && $_GET['Edited']){
?>
      <script>
        alert("Audio Edited sucessfully");
      </script>
<?php
    }
?>
<?php
    if(isset($_GET['Deleted']) && $_GET['Deleted']){
?>
      <script>
        alert("Audio Deleted sucessfully");
      </script>
<?php
    }
?>
</body>
</html>
