<?php

if (!isset($_POST['name'])) {
    header('location: dashboard.php');
    die();
}
if (!isset($_POST['email'])) {
    header('location: dashboard.php');
    die();
}
if (!isset($_POST['date'])) {
    header('location: dashboard.php');
    die();
}

require './config.php';

$email = $_POST['email'];
$name = $_POST['name'];
$date = $_POST['date'];
$listingId = $_POST['listingId'];

$sql = "INSERT INTO bookings (email, name, date, listingId) VALUES ('$email', '$name', '$date', '$listingId')";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Successful</title>
</head>

<body>
    <?php
    if ($conn->query($sql) === TRUE) {
        echo "Booking Successful. Redirecting to Homepage...";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    ?>
    <script>
        setTimeout(function() {
            window.location.href = 'index.php';
        }, 3000);
    </script>
</body>

</html>