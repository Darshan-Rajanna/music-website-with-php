<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Welcome Page</title>
<style>
  body {
    margin: 0;
    padding: 0;
    height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
    background: linear-gradient(135deg, #667eea, #764ba2);
  }

  .container {
    text-align: center;
    background: rgba(255, 255, 255, 0.8);
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
  }

  button {
    padding: 50px 50px;
    margin: 10px;
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
    <h1>Register</h1>
    <button onclick="window.location.href = 'user_signin.php'">User</button>
    <button onclick="window.location.href = 'admin_signin.php'">Admin</button>
  </div>
</body>
</html>



