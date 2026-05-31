<?php

session_start();

$conn = mysqli_connect("localhost", "root", "", "expense_tracker", 3307);

if(isset($_POST['login']))
{
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users
            WHERE username='$username'
            AND password='$password'";

    $result = mysqli_query($conn, $sql);

    if(mysqli_num_rows($result) > 0)
    {
        $_SESSION['user'] = $username;

        header("Location: index.php");
    }
    else
    {
        echo "Invalid Username or Password";
    }
}

?>

<!DOCTYPE html>
<html>
<head>

<title>Login</title>

<link rel="stylesheet" href="css/style.css">

</head>

<body>

<div class="container">

<h1>Login</h1>

<form method="POST">

<input type="text"
       name="username"
       placeholder="Enter Username"
       required>

<input type="password"
       name="password"
       placeholder="Enter Password"
       required>

<button type="submit" name="login">
    Login
</button>

</form>

</div>

</body>
</html>