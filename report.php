<?php

$conn = mysqli_connect("localhost", "root", "", "expense_tracker", 3307);

$result = mysqli_query($conn, "SELECT * FROM expenses");

?>

<!DOCTYPE html>
<html>
<head>

<title>Expense Report</title>

<style>

table{
    width: 100%;
    border-collapse: collapse;
}

th, td{
    border: 1px solid black;
    padding: 10px;
    text-align: center;
}

</style>

</head>

<body>

<h2>Expense Report</h2>

<table>

<tr>
    <th>ID</th>
    <th>Amount</th>
    <th>Category</th>
    <th>Date</th>
</tr>

<?php

while($row = mysqli_fetch_assoc($result))
{
?>

<tr>

<td><?php echo $row['id']; ?></td>

<td><?php echo $row['amount']; ?></td>

<td><?php echo $row['category']; ?></td>

<td><?php echo $row['date']; ?></td>

</tr>

<?php
}
?>

</table>

<script>
window.print();
</script>

</body>
</html>