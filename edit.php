<?php

$conn = mysqli_connect("localhost", "root", "", "expense_tracker", 3307);

$id = $_GET['id'];

$result = mysqli_query($conn, "SELECT * FROM expenses WHERE id=$id");

$row = mysqli_fetch_assoc($result);

if(isset($_POST['update'])){

    $amount = $_POST['amount'];
    $category = $_POST['category'];
    $date = $_POST['date'];

    $sql = "UPDATE expenses 
            SET amount='$amount',
                category='$category',
                date='$date'
            WHERE id=$id";

    mysqli_query($conn, $sql);

    header("Location: index.php");
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Expense</title>
</head>

<body>

<h2>Edit Expense</h2>

<form method="POST">

<input type="number"
       name="amount"
       value="<?php echo $row['amount']; ?>"
       required>

<br><br>

<input type="text"
       name="category"
       value="<?php echo $row['category']; ?>"
       required>

<br><br>

<input type="date"
       name="date"
       value="<?php echo $row['date']; ?>"
       required>

<br><br>

<button name="update">
   Update Expense
</button>

</form>

</body>
</html>