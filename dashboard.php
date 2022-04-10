<?php
session_start();
if (isset($_GET['logout'])) {
    require './logout.php';
    die();
}
require './config.php';
$err = null;
$errMessage = null;
$message = null;
$toastMessage = null;
if (!isset($_SESSION['loggedInUser'])) {
    header("location: login.php");
    die();
}
if (isset($_SESSION["error"])) {
    $err = true;
    $errMessage = $_SESSION["errorMessage"];
}
if (isset($_SESSION["message"])) {
    $message = true;
    $toastMessage = $_SESSION["toastMessage"];
}
$userId = $_SESSION["userId"];
$userListingSql = "SELECT * FROM listings WHERE userId='$userId'";
$result = $conn->query($userListingSql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://unpkg.com/flowbite@1.4.1/dist/flowbite.min.css" />
    <script src="https://unpkg.com/flowbite@1.4.1/dist/flowbite.js"></script>
    <title>Dashboard</title>
</head>

<body>
    <?php
    if ($err) {
        require './partials/errorToast.php';
    }
    if ($message) {
        require './partials/successToast.php';
    }
    ?>
    <aside class="ml-[-100%] fixed z-10 top-0 pb-3 px-6 w-full flex flex-col justify-between h-screen border-r bg-white transition duration-300 md:w-4/12 lg:ml-0 lg:w-[25%] xl:w-[20%] 2xl:w-[15%]">
        <div>

            <div class="mt-8 text-center">
                <img src="https://via.placeholder.com/600" alt="" class="w-10 h-10 m-auto rounded-full object-cover lg:w-28 lg:h-28">
                <h5 class="hidden mt-4 text-xl font-semibold text-gray-600 lg:block"><?php echo $_SESSION["loggedInUser"] ?></h5>
            </div>

            <ul class="space-y-2 tracking-wide mt-8">
                <li>
                    <a aria-label="dashboard" class="relative px-4 py-3 flex items-center space-x-4 rounded-xl text-white bg-blue-600">

                        <span class="-mr-1 font-medium">Dashboard</span>
                    </a>
                </li>
            </ul>
        </div>
        <div>
            <a href="./index.php" class="px-6 -mx-6 pt-4 flex justify-between items-center border-t">
                <button class="px-4 py-3 flex items-center space-x-4 rounded-md text-gray-600 group">
                    <svg fill="#000000" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24px" height="24px">
                        <path d="M 12 2.0996094 L 1 12 L 4 12 L 4 21 L 11 21 L 11 15 L 13 15 L 13 21 L 20 21 L 20 12 L 23 12 L 12 2.0996094 z M 12 4.7910156 L 18 10.191406 L 18 11 L 18 19 L 15 19 L 15 13 L 9 13 L 9 19 L 6 19 L 6 10.191406 L 12 4.7910156 z" />
                    </svg>
                    <span class="group-hover:text-gray-700">Home</span>
                </button>
            </a>
            <a href="./dashboard.php?logout=true" class="px-6 -mx-6 pt-4 flex justify-between items-center border-t">
                <button class="px-4 py-3 flex items-center space-x-4 rounded-md text-gray-600 group">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                    </svg>
                    <span class="group-hover:text-gray-700">Logout</span>
                </button>
            </a>
        </div>
    </aside>
    <div class="ml-auto mb-6 lg:w-[75%] xl:w-[80%] 2xl:w-[85%]">
        <div class="sticky z-10 top-0 h-16 border-b bg-white lg:py-2.5">
            <div class="px-6 flex items-center justify-between space-x-4 2xl:container">
                <h5 hidden class="text-2xl text-gray-600 font-medium lg:block">Dashboard</h5>
                <button class="w-12 h-16 -mr-2 border-r lg:hidden">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 my-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>
        </div>

        <div class="px-12 pt-12 2xl:container">
            <h3 class="text-xl font-semibold">Your Listings</h3>
            <br />
            <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
                <div class="md:col-span-2 lg:col-span-1">
                    <div class="h-full py-8 px-6 space-y-6 flex flex-col items-center rounded-xl border border-gray-200 bg-white cursor-pointer" data-modal-toggle="add-listing-modal">
                        <img src="./plus.png" class="h-72 m-auto" />
                        <h3 class="text-3xl">Add Listing</h3>
                    </div>
                </div>

                <?php
                foreach ($result->fetch_all() as $listing) {
                    $image = $listing[4];
                    $title = $listing[2];
                    $description = $listing[3];
                    $price = $listing[5];
                    echo "<div class='md:col-span-2 lg:col-span-1'><div class='h-full py-8 px-6 space-y-6 rounded-xl border border-gray-200 bg-white'><img src='$image' class='h-72 m-auto' />
                    <h4 class='text-center text-lg font-semibold'>$title</h4>
                    <p>$description</p>
                    <p>Price/hour: ₹ $price</p>
                    <button class='w-full bg-blue-600 text-white font-semibold py-2 px-4 rounded-md' data-modal-toggle='edit-listing-modal'>Edit</button>
                    <button class='w-full bg-red-600 text-white font-semibold py-2 px-4 rounded-md' data-modal-toggle='popup-modal'>Delete</button>
                    </div></div>";
                }
                ?>
            </div>
            <div id="popup-modal" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 md:inset-0 h-modal md:h-full">
                <div class="relative p-4 w-full max-w-md h-full md:h-auto">
                    <!-- Modal content -->
                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                        <!-- Modal header -->
                        <div class="flex justify-end p-2">
                            <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white" data-modal-toggle="popup-modal">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                </svg>
                            </button>
                        </div>
                        <!-- Modal body -->
                        <div class="p-6 pt-0 text-center">
                            <svg class="mx-auto mb-4 w-14 h-14 text-gray-400 dark:text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Are you sure you want to delete this listing?</h3>
                            <button data-modal-toggle="popup-modal" type="button" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
                                Yes
                            </button>
                            <button data-modal-toggle="popup-modal" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">No, cancel</button>
                        </div>
                    </div>
                </div>
            </div>
            <div id="add-listing-modal" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 w-full md:inset-0 h-modal md:h-full">
                <div class="relative p-4 w-full max-w-3xl h-full md:h-auto">
                    <div class="relative bg-white rounded-lg shadow">
                        <div class="flex justify-between items-center p-5 rounded-t border-b ">
                            <h3 class="text-xl font-medium text-gray-900 ">
                                Add Listing
                            </h3>
                            <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center" data-modal-toggle="add-listing-modal">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                </svg>
                            </button>
                        </div>
                        <!-- Modal body -->
                        <div class="p-6 space-y-6">
                            <form action="./addListing.php" method="POST" enctype="multipart/form-data">
                                <div class="mb-6">
                                    <label for="email" class="block mb-2 text-sm font-medium text-gray-900">Listing Name</label>
                                    <input class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Name" name="name" required>
                                </div>
                                <div class="mb-6">

                                    <label for="description" class="block mb-2 text-sm font-medium">Description</label>
                                    <textarea id="description" name="description" rows="4" class="block p-2.5 w-full text-sm rounded-lg border focus:ring-blue-500 focus:border-blue-50 border-gray-300" placeholder="Sescription"></textarea>
                                </div>
                                <div class="mb-6">
                                    <label for="pricing" class="block mb-2 text-sm font-medium text-gray-900">Pricing Per Hour</label>
                                    <input id="pricing" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="₹0" name="price" required>
                                </div>
                                <div class="mb-6">
                                    <label for="pricing" class="block mb-2 text-sm font-medium text-gray-900">Upload Image</label>
                                    <input type="file" name="fileToUpload" required>
                                </div>
                                <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <?php

            require './partials/addListingForm.php'
            ?>
        </div>
    </div>
</body>

</html>