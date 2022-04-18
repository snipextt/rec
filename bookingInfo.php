<?php
session_start();
if (!isset($_SESSION['loggedInUser'])) {
    header("location: login.php");
    die();
}
if (!isset($_SESSION['userId'])) {
    header("location: login.php");
    die();
}
require './config.php';
$userId = $_SESSION['userId'];
$listingId = $_GET["listingId"];
$sql = "SELECT * FROM listings WHERE id = '$listingId' and userId = '$userId'";
$result = $conn->query($sql);
if ($result->num_rows == 0) {
    header("location: dashboard.php");
    die();
}
$bookingsSql = "SELECT * FROM bookings WHERE listingId = '$listingId'";
$bookingsResult = $conn->query($bookingsSql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listing Booking Info</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://unpkg.com/flowbite@1.4.1/dist/flowbite.min.css" />
    <script src="https://unpkg.com/flowbite@1.4.1/dist/flowbite.js"></script>
</head>

<body>
    <br />
    <h2 class="text-lg text-center font-semibold">Booking Information for <?php echo $listingId ?></h2>
    <br />

    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left ">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 ">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        ID
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Name
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Email
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Date
                    </th>
                </tr>
            </thead>
            <tbody>
                <!-- <tr class="bg-white border-b">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                        Apple MacBook Pro 17"
                    </th>
                    <td class="px-6 py-4">
                        Sliver
                    </td>
                    <td class="px-6 py-4">
                        Laptop
                    </td>
                    <td class="px-6 py-4">
                        $2999
                    </td>
                    <td class="px-6 py-4 text-right">
                        <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                    </td>
                </tr> -->
                <?php
                foreach ($bookingsResult->fetch_all() as $booking) {
                    $bookingId = $booking[0];
                    $name = $booking[1];
                    $email = $booking[2];
                    $bookingDate = $booking[3];
                ?>
                    <tr class="bg-white border-b">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                            <?php echo $bookingId; ?>
                        </th>
                        <td class="px-6 py-4">
                            <?php echo $name; ?>
                        </td>
                        <td class="px-6 py-4">
                            <?php echo $email; ?>
                        </td>
                        <td class="px-6 py-4">
                            <?php echo $bookingDate; ?>
                        </td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>

</body>

</html>