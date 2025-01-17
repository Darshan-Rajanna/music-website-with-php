<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Manage Artists</title>
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

.form-popup {
    display: none;
    position: fixed;
    top: 0; /* Position form at the top */
    left: 0; /* Position form at the left */
    width: 100%; /* Take full width */
    height: 100%; /* Take full height */
    background-color: rgba(0, 0, 0, 0.5); /* Semi-transparent background */
    z-index: 9;
}

.form-container {
    position: relative;
    margin: auto;
    margin-top: 50px; /* Adjust top margin as needed */
    max-width: 300px;
    padding: 20px;
    background-color: white;
    border-radius: 5px;
}

.form-container input[type=text], .form-container input[type=password] {
    width: 100%;
    padding: 10px;
    margin: 5px 0 15px 0;
    border: none;
    background: #f1f1f1;
}

.close {
    position: absolute;
    top: 5px;
    right: 10px;
    color: #aaa;
    font-size: 20px;
    font-weight: bold;
    cursor: pointer;
}

.close:hover,
.close:focus {
    color: black;
    text-decoration: none;
}
</style>
</head>
<body>
<div class="navbar">
    <h1>Music Database - Artists</h1>
    <button id="addArtistBtn">Add Artist</button>
</div>
<div class="sidebar" id="sidebar">
    <a href="./dashboard.php" class="active"><i class="fas fa-database"></i> Database</a>
    <a href="./admin_songs.php"><i class="fas fa-music"></i> Songs</a>
    <a href="./admin_albums.php"><i class="fas fa-compact-disc"></i> Albums</a>
    <a href="./admin_artists.php"><i class="fas fa-user"></i> Artists</a>
    <a href="./admin_users.php"><i class="fas fa-users"></i> Users</a>
</div>
<div class="form-popup" id="addArtistForm">
    <div class="form-container">
        <span class="close" onclick="closeForm()">&times;</span>
        <h2>Add Artist</h2>
        <form action="admin_artists.php" method="post" enctype="multipart/form-data">
            <label for="name">Name:</label>
            <input type="text" id="Artist" name="Artist" required>
            <label for="photo">Photo:</label>
            <input type="file" id="photo" name="photo" accept="image/*" required>
            <button type="submit">Add</button>
        </form>
        <?php
        if ($_SERVER["REQUEST_METHOD"]=="POST") {
            $Artist=$_POST["Artist"];
            
            // Database connection
            include "connection.php";
            
            // File upload handling
            $target_dir = "images/";
            $target_file = $target_dir . basename($_FILES["photo"]["name"]);
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
            
                if (move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file)) {
                    $sql="INSERT INTO `artists` (`Artist`, `Artist_cover`, `no_songs`) VALUES ('$Artist', '$target_file', NULL);";
                    $res = mysqli_query($conn, $sql);
                } else {
                    echo "Sorry, there was an error uploading your file.";
                }
        
        }
        ?>
    </div>
</div>
<div class="content">
    <table>
        <tr>
            <th>Artist</th>
            <th>Number of Songs</th>
            <th>Option</th>
        </tr>
        <?php
        include "connection.php";
        $sql = "UPDATE artists AS a
        SET a.no_songs = (
            SELECT COUNT(s.Artist)
            FROM songs AS s
            WHERE s.Artist = a.Artist
        )
        WHERE EXISTS (
            SELECT 1
            FROM songs AS s
            WHERE s.Artist = a.Artist
        )";
        $res=mysqli_query($conn, $sql);
        $sql="SELECT * FROM artists;";
        $res=mysqli_query($conn, $sql);
        $num=mysqli_num_rows($res);
        for ($i=0; $i <$num ; $i++) { 
          $row=mysqli_fetch_assoc($res);
          
        ?>
        <tr>
            <td><?php echo $row['Artist'] ?></td>
            <td><?php echo $row['no_songs'] ?></td>
            <td>
            <a href="./admin_edit_artist.php?artist=<?php echo $row['Artist'] ?>"><button>Edit</button></a>
            </td>
        </tr>
        <?php

        }
        ?>
    </table>
</div>

<script>
    function openForm() {
        document.getElementById("addArtistForm").style.display = "block";
    }

    function closeForm() {
        document.getElementById("addArtistForm").style.display = "none";
    }

    document.getElementById("addArtistBtn").addEventListener("click", function() {
        openForm();
    });
</script>
</body>
</html>
