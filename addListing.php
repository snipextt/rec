<?php
$target_dir = "uploads/";
session_start();
if (!isset($_SESSION['loggedInUser'])) {
    header("location: login.php");
    die();
}
if (!isset($_SESSION['userId'])) {
    header("location: login.php");
    die();
}
if (!isset($_FILES['fileToUpload'])) {
    $_SESSION["error"] =  true;
    $_SESSION["errorMessage"] = "Image is required";
    header("location: dashboard.php");
    die();
}
if (!isset($_POST["name"])) {
    $_SESSION["error"] =  true;
    $_SESSION["errorMessage"] = "Name is required";
    header("location: dashboard.php");
    die();
}
if (!isset($_POST["description"])) {
    $_SESSION["error"] =  true;
    $_SESSION["errorMessage"] = "Description is required";
    header("location: dashboard.php");
    die();
}
if (!isset($_POST["price"])) {
    $_SESSION["error"] =  true;
    $_SESSION["errorMessage"] = "Price is required";
    header("location: dashboard.php");
    die();
}
$target_file = $target_dir . basename("{$_POST["name"]}{$_SESSION['userId']}{$_FILES["fileToUpload"]["name"]}");
$uploadOk = 1;
$imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
if (isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if ($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}
if (
    $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif"
) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "The file " . basename($_FILES["fileToUpload"]["name"]) . " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}

if ($uploadOk) {
    include './config.php';
    $name = $_POST["name"];
    $description = $_POST["description"];
    $price = $_POST["price"];
    $userId = $_SESSION['userId'];
    $username = $_SESSION['loggedInUser'];
    $sql = "INSERT INTO listings (name, description, price, userId, image, username) VALUES ('$name', '$description', '$price', '$userId', '$target_file', '$username')";
    if ($conn->query($sql) === TRUE) {
        $_SESSION["message"] =  true;
        $_SESSION["toastMessage"] = "Listing Added";
        header("location: dashboard.php");
        die();
    } else {
        $_SESSION["error"] =  true;
        $_SESSION["errorMessage"] = "Failed to add listing";
        header("location: dashboard.php");
        die();
    }
}
