<header class="text-gray-600 body-font w-full shadow-md">
    <div class="container mx-auto flex flex-wrap p-5 flex-col md:flex-row items-center">
        <a class="flex title-font font-medium items-center text-gray-900 mb-4 md:mb-0" href="/rec">

            <span class="ml-3 text-xl">Rental Service</span>
        </a>
        <nav class="md:mr-auto md:ml-4 md:py-1 md:pl-4 md:border-gray-400 flex flex-wrap items-center text-base justify-center">
        </nav>
        <?php
        session_start();
        if (isset($_SESSION["loggedInUser"])) {
            echo "<a href='./dashboard.php'>
            <button class='inline-flex items-center bg-gray-100 border-0 mr-2 py-1 px-3 focus:outline-none hover:bg-gray-200 rounded text-base mt-4 md:mt-0'>
                Dashboard
            </button>
        </a>";
        } else {
            echo "<a href='./login.php'>
            <button class='inline-flex items-center bg-gray-100 border-0 mr-2 py-1 px-3 focus:outline-none hover:bg-gray-200 rounded text-base mt-4 md:mt-0'>
                Login
            </button>
        </a>
        <a href='./signup.php'>
            <button class='inline-flex items-center bg-gray-100 border-0 py-1 px-3 focus:outline-none hover:bg-gray-200 rounded text-base mt-4 md:mt-0'>
                Signup
            </button>
        </a>";
        }
        ?>
    </div>
</header>