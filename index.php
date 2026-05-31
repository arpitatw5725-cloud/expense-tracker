<?php
session_start();

$conn = mysqli_connect("localhost", "root", "", "expense_tracker", 3307);

if (!$conn) {
    die("Connection Failed");
}

if(isset($_POST['submit']))
{
    $amount = $_POST['amount'];
    $category = $_POST['category'];
    $username = $_SESSION['user'];
    $date = $_POST['date'];

   $sql = "INSERT INTO expenses(amount, category, date, username)
        VALUES('$amount', '$category', '$date', '$username')";
    mysqli_query($conn, $sql);
}
$search = "";
$month = "";

if(isset($_GET['search']))
{
    $search = $_GET['search'];
}

if(isset($_GET['month']))
{
    $month = $_GET['month'];
}

if($search != "" || $month != "")
{
    $username = $_SESSION['user'];

$fetch = "SELECT * FROM expenses
          WHERE username='$username'
          AND category LIKE '%$search%'
          AND date LIKE '$month%'";
}
else
{
    $username = isset($_SESSION['user']) ? $_SESSION['user'] : '';

$fetch = "SELECT * FROM expenses
          WHERE username='$username'";
}
$result = mysqli_query($conn, $fetch);
$total = 0;
$budget = 5000;
$food = 0;

$travel = 0;

$shopping = 0;

?>
<?php



if(!isset($_SESSION['user']))
{
    header("Location: login.php");
    exit();
}

$username = $_SESSION['user'];

?>

<!DOCTYPE html>
<html>
<head>
    <title>Expense Tracker</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <button onclick="darkMode()" id="dark-btn">
    Dark Mode
</button>
<a href="report.php" target="_blank" id="report-btn">
    Download Report
</a>
<a href="logout.php" id="logout-btn">
    Logout
</a>

<div class="container">

    <h1>Personal Expense Tracker</h1>

    <form method="POST">

        <input type="number"
               name="amount"
               placeholder="Enter Amount"
               required>

        <input type="text"
               name="category"
               placeholder="Enter Category"
               required>

        <input type="date"
               name="date"
               required>

        <button type="submit" name="submit">
            Add Expense
        </button>

    </form>
    <h2>Expense List</h2>

<table border="1" cellpadding="10">

<tr>
    <th>Amount</th>
    <th>Category</th>
    <th>Date</th>
</tr>

<?php

while($row = mysqli_fetch_assoc($result))
{
    $total += $row['amount'];
    if($row['category'] == "Food"){
    $food += $row['amount'];
}

if($row['category'] == "Travel"){
    $travel += $row['amount'];
}

if($row['category'] == "Shopping"){
    $shopping += $row['amount'];
}

?>

<tr>
    <td><?php echo $row['amount']; ?></td>
    <td><?php echo $row['category']; ?></td>
    <td><?php echo $row['date']; ?></td>
     <td>
      <a href="edit.php?id=<?php echo $row['id']; ?>">
         Edit
      </a>
   </td>
    <td>
   <a href="delete.php?id=<?php echo $row['id']; ?>">
      Delete
   </a>
</td>
</tr>

<?php
}
?>

</table>

<h2>
    Total Expense =
    ₹<?php echo $total; ?>
</h2>
<?php

if($total > $budget)
{
    echo "<h2 class='warning'>
          Warning: Budget Exceeded!
          </h2>";
}

?>
<form method="GET">

    <input type="text"
           name="search"
           placeholder="Search Category">
           <input type="month" name="month">

    <button type="submit">
        Search
    </button>

</form>
<h3>Food Total = ₹<?php echo $food; ?></h3>

<h3>Travel Total = ₹<?php echo $travel; ?></h3>

<h3>Shopping Total = ₹<?php echo $shopping; ?></h3>
<div class="chart-container">
    <canvas id="myChart"></canvas>
</div>

</div>
<script>

const ctx = document.getElementById('myChart');

new Chart(ctx, {
    type: 'pie',

    data: {
        labels: ['Food', 'Travel', 'Shopping'],

        datasets: [{
            label: 'Expenses',

            data: [
                <?php echo $food; ?>,
                <?php echo $travel; ?>,
                <?php echo $shopping; ?>
            ],

            backgroundColor: [
                'pink',
                'skyblue',
                'lightgreen'
            ],

            borderWidth: 1
        }]
    }
});

</script>
<script>

function darkMode()
{
    document.body.classList.toggle("dark");
}

</script>
</body>
</html>