<?php
$conn = mysqli_connect("localhost", "root", "", "expense_tracker", 3307);

$id = $_GET['id'];

$sql = "DELETE FROM expenses WHERE id=$id";

mysqli_query($conn, $sql);

header("Location: index.php");
?>