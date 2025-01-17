<?php
require 'connection.php';
if ($_SERVER["REQUEST_METHOD"]=="POST") {
    $id=$_POST["id"];
    $email=$_POST["email"];
    $pass=$_POST["pass"];
    $cpass=$_POST["cNewPass"];
    $sql="INSERT INTO `user_login` (`id`, `email`, `pass`) VALUES ('$id', '$email', '$pass');";
    $res = mysqli_query($conn, $sql);
      if ($res) {
        header("Location: user_signin.php?uploaded=true?$sql");
      } else {
        header("Location: sign-up.php?Error=true");
      }
    }
    ?>
  <?php
  if (isset($_GET['Error']) && $_GET['Error']) {
    ?>
    <script>
      alert("Sigu-up failed");
    </script>
    <?php
  }
  ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Signup Page</title>
<style>
  body {
    margin: 0;
    padding: 0;
    height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
    background: linear-gradient(135deg, #667eea, #764ba2);
    overflow: hidden;
  }

  .container {
    position: relative;
    width: 300px;
    height: 400px;
    background: rgba(255, 255, 255, 0.8);
    border-radius: 10px;
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
    overflow: hidden;
    text-align: center;
    animation: animateContainer 5s ease-in-out infinite alternate;
  }

  @keyframes animateContainer {
    0% {
      transform: scale(1);
    }
    100% {
      transform: scale(1.05);
    }
  }

  form {
    padding: 20px;
  }

  input[type="text"], input[type="email"], input[type="password"] {
    width: 100%;
    padding: 10px;
    margin-bottom: 20px;
    border: 1px solid #ccc;
    border-radius: 5px;
    box-sizing: border-box;
  }

  button {
    width: 100%;
    padding: 10px;
    background: #667eea;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background 0.3s;
  }

  button:hover {
    background: #764ba2;
  }
</style>
</head>
<body>
  <div class="container">
    <h1>Sign-up</h1>
    <form action="sign-up.php" method="post">
      <input type="text" name='id' placeholder="Username" required>
      <input type="text" name='email' placeholder="Email" required>
      <input type="text" name='pass' placeholder="Enter Password" required>
      <button type="submit">Signup</button>
      <a href="./user_signin.php">back</a>
    </form>
  </div>
</body>
</html>
