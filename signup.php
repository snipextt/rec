<?php
if (isset($_SESSION["loggedInUser"])) {
    header("location: dashboard.php");
    die();
}
$err = null;
$errMessage = null;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include './config.php';
    $username = $_POST["username"];
    $password = $_POST["password"];
    $confirmPassword = $_POST["confirmPassword"];
    if (!$username || !$password || !$confirmPassword) {
        $err = true;
        $errMessage = "All Fields are required";
    } else {
        $checkUserExistSql = "Select * FROM users WHERE username='$username'";
        $result = mysqli_query($conn, $checkUserExistSql);
        $err = mysqli_num_rows($result) == 1;
        if ($err) {
            $errMessage = "User already exists";
        }
        if ($password != $confirmPassword) {
            $err = true;
            $errMessage = "Passwords do not match";
        }
        if ($password == $confirmPassword and !$err) {
            session_start();
            $sql = "INSERT INTO `users`(`username`, `password`) VALUES ('$username', '$password')";
            $result = $conn->query($sql);
            $fetchUserRowSql = "Select * FROM users WHERE username='$username'";
            $result = $conn->query($fetchUserRowSql);
            $_SESSION['loggedInUser'] = $username;
            $_SESSION['userId'] = $result->fetch_assoc()['id'];
            header("location: dashboard.php");
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://unpkg.com/flowbite@1.4.1/dist/flowbite.min.css" />
    <script src="https://unpkg.com/flowbite@1.4.1/dist/flowbite.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>

    <title>Signup</title>
</head>

<body class="bg-gray-100 flex items-center flex-col">


    <?php
    require './partials/header.php';
    require './partials/signupform.php';
    if ($err) {
        require './partials/errorToast.php';
    }
    ?> </body>

</html>