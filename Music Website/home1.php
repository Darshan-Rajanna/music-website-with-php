<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Music Database</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-repeat: no-repeat;
            background-size: cover;
            background-image: url(https://www.atlantaonthecheap.com/wp-content/uploads/2023/07/music-concept-Depositphotos_10701850_S-e1688665472811.jpg);
            text-align: center;
        }
        header {
            background-color: transparent;
            color: white;
            padding: 10px 0;
        }
        h1 {
            margin: 20px 0;
            font-size: 4em;
            font-family: 'Times New Roman', Times, serif;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }
        h4 {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 2em;
            line-height: 1.5;
        }
        h6 {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 1.5em;
            line-height: 1.5;
        }
        a {
            color: #333;
            text-decoration: none;
            padding: 5px 10px;
            background-color: #f0f0f0;
            border-radius: 5px;
        }
        a:hover {
            background-color: #ccc;
        }
    </style>
</head>
<body>
    <header>
        <h1>Welcome to the Melomaniczz</h1>
    </header>
    <div class="container">
        <h4>Melomaniczz contains a collection of music albums, artists, and songs.</h4>
        <h6>Explore to find your favorite music!</h6>
        <a href="./artists.php">View Artists</a>
        <a href="./album.php">View Albums</a>
        <a href="./song.php">View Songs</a>
    </div>
    <form method="GET">
        <div class="search">
            <span class="search-icon material-symbols-outlined">search</span>
            <input class="search-input" type="search" name="search" placeholder="search"> 
            <input type="submit" value="Search">
        </div>
    </form>
    <?php
// Connect to your database
$servername = "localhost:3307";
$username = "root";
$password = "";
$dbname = "melo";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$searchTerm = "";

if(isset($_GET['search'])) {
    $searchTerm = $_GET['search'];

    // Check if search term is not empty
    if (!empty($searchTerm)) {
        $sql = "SELECT * FROM songs WHERE audio LIKE '%$searchTerm%'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                ?>
                <div class="song">
                    <h3><?php echo $row['Title']; ?></h3>
                    <p>Artist: <?php echo $row['Artist']; ?></p>
                    <p>Album: <?php echo $row['Album']; ?></p>
                    <audio controls>
                        <source src="<?php echo $row['audio']; ?>" type="audio/mpeg">
                        Your browser does not support the audio element.
                    </audio>
                </div>
                <?php
            }
        } else {
            echo "0 results";
        }
    } else {
        echo "Please enter a search term.";
    }
}
?>

</body>
</html>