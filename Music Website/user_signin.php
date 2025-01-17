<?php
require 'connection.php';
if ($_SERVER["REQUEST_METHOD"]=="POST") {
    $id=$_POST["user"];
    $pass=$_POST["pass"];
    $sql="SELECT * FROM user_login WHERE id = '$id';";
    $result=mysqli_query($conn,$sql);
    $num=mysqli_num_rows($result);
    if ($num==1) {
        $row=mysqli_fetch_assoc($result);
        if ($pass==$row['pass']) {
            session_start();
            $_SESSION['loggedin']=true;
            $_SESSION['uid']=$id;
            header("location: home1.php");
        }
        else{
            $passerror="Password incorrect";
        }
    }
       else{
        $iderr="Error no such id exists, Create one first";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login Page</title>
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
    height: 350px;
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

  input[type="text"], input[type="password"] {
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
    <h1>Sign-in User</h1>
    <form action="user_signin.php" method="post">
      <input type="text" name='user' placeholder="Username" required>
      <?php
       if (isset($iderr)) {
        ?>
        <p class="error"><?php echo $iderr ?></p>
        <?php
       }
       ?>
      <input type="password" name='pass' placeholder="Password" required>
      <?php
       if (isset($passerror)) {
        ?>
        <p class="error"><?php echo $passerror ?></p>
        <?php
       }
       ?>
      <button type="submit">Login</button>
      <a href="./sign-up.php">Sign-up</a>
    </form>
    <a href="./index.php">back</a>
  </div>
  <?php
    if(isset($_GET['uploaded']) && $_GET['uploaded']){
?>
      <script>
        alert(" Signed Up sucessfully");
      </script>
<?php
    }
?>
</body>
</html>


