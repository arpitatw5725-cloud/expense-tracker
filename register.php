<?php

$conn = mysqli_connect("localhost", "root", "", "expense_tracker", 3307);

if(isset($_POST['register']))
{
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "INSERT INTO users(username, password)
            VALUES('$username', '$password')";

    mysqli_query($conn, $sql);

    echo "Registration Successful";
}

?>

<!DOCTYPE html>
<html>
<head>

<title>Register</title>

<link rel="stylesheet" href="css/style.css">

</head>

<body>

<div class="container">

<h1>Register</h1>

<form method="POST">

<input type="text"
       name="username"
       placeholder="Enter Username"
       required>

<input type="password"
       name="password"
       placeholder="Enter Password"
       required>

<button type="submit" name="register">
    Register
</button>

</form>

</div>

</body>
</html>