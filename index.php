<?php
require './config.php';
$listingSql = null;
if (isset($_GET['user'])) {
    $listingSql = "SELECT * FROM listings WHERE userId = {$_GET['user']}";
} else {
    $listingSql = "SELECT * FROM listings";
}
$result = $conn->query($listingSql);
$userSql = "SELECT * FROM users";
$userResult = $conn->query($userSql);
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
    <title>Car Rental</title>
</head>

<body class="bg-gray-100">
    <?php
    require './partials/header.php'
    ?>

    <section class="text-gray-600 body-font" style="min-height: calc(100vh - 184px);">
        <div class="container px-5 py-12 mx-auto">
            <div class="flex flex-wrap w-full mb-16">
                <div class="lg:w-1/2 w-full mb-6 lg:mb-0">
                    <h1 class="sm:text-3xl text-2xl font-medium title-font mb-2 text-gray-900">All Listings</h1>
                    <div class="h-1 w-20 bg-blue-500 rounded"></div>
                </div>
                <div class="lg:w-1/2 w-full mb-6 lg:mb-0 flex justify-end">
                    <div class="lg:w-1/2">
                        <label for="users" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">Filter By User</label>
                        <select id="users" class=" text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
                            <option value="">All Users</option>
                            <?php
                            foreach ($userResult->fetch_all() as $user) {
                                $isSelected = false;
                                if (isset($_GET['user'])) {
                                    $isSelected = $user[0] == $_GET['user'] ? 'selected' : '';
                                }
                                if (isset($_GET['user'])) {
                                    echo "value={$_GET['user']}";
                                }
                                echo "<option $isSelected value=" . $user[0] . ">" . $user[1] . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="flex flex-wrap -m-4">
                <?php
                foreach ($result->fetch_all() as $listing) {
                    $image = $listing[4];
                    $title = $listing[2];
                    $description = $listing[3];
                    $price = $listing[5];
                    $id = $listing[0];
                    echo "<div class='listing xl:w-1/4 md:w-1/2 p-4 cursor-pointer' data-id='$id'>
                    <div class='border border-gray-300 p-6 rounded-lg' data-modal-toggle='authentication-modal'>
                        <img class=h-40 rounded w-full object-cover object-center mb-6' src='$image' alt='content'>
                        <br/>
                        <hr /><br />
                        <h2 class='text-lg text-gray-900 font-medium title-font mb-4'>$title</h2>
                        <p class='leading-relaxed text-base'>$description</p>
                    </div>
                </div>";
                }
                ?>
            </div>
        </div>
        <div id="authentication-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 w-full md:inset-0 h-modal md:h-full">
            <div class="relative p-4 w-full max-w-md h-full md:h-auto">
                <!-- Modal content -->
                <div class="relative bg-white rounded-lg shadow">
                    <div class="flex justify-end p-2">
                        <button type="button" class=" bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white" data-modal-toggle="authentication-modal">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                            </svg>
                        </button>
                    </div>
                    <form class="px-6 pb-4 space-y-6 lg:px-8 sm:pb-6 xl:pb-8" action="./bookListing.php" method="POST">
                        <h3 class="text-xl font-medium text-gray-900 ">Book This Listing</h3>
                        <div>
                            <label for="listingId" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Listing ID</label>
                            <input name="listingId" id="listingId" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                        </div>
                        <div>
                            <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Your email</label>
                            <input name="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="name@company.com" required>
                        </div>
                        <div>
                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Your Name</label>
                            <input type="name" name="name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required placeholder="name">
                        </div>
                        <div>
                            <label for="date" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Your Name</label>
                            <input type="date" name="date" id="date" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                        </div>
                        <button type="submit" class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Book Now</button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <?php
    require './partials/footer.php'
    ?>
    <script>
        const users = document.getElementById('users');
        users.onchange = (e) => {
            if (e.target.value !== '') {
                window.location.assign(`${window.location.pathname}?user=${e.target.value}`);
            } else {
                window.location.assign(`${window.location.pathname}`);
            }
        }
        const listings = document.querySelectorAll('.listing');
        Array.from(listings).forEach(listing => {
            listing.addEventListener('click', (e) => {
                document.querySelector('#listingId').value = listing.dataset.id;
            })
        })
    </script>
</body>

</html>