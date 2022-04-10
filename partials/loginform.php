<div class="mt-40 w-1/4">
    <h3 class="text-3xl font-semibold text-center mb-6">Login</h3>
    <form action="/rec/login.php" method="POST" class="bg-white shadow-md rounded p-8 rounded-md mb-4 flex flex-col">
        <div class="mb-4">
            <label class="block text-grey-darker text-sm font-bold mb-2" for="username">
                Username
            </label>
            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker" id="username" name="username" type="text" placeholder="Username">
        </div>
        <div class="mb-6">
            <label class="block text-grey-darker text-sm font-bold mb-2" for="password">
                Password
            </label>
            <input class="shadow appearance-none border border-red rounded w-full py-2 px-3 text-grey-darker mb-3" id="password" type="password" name="password" placeholder="******************">
        </div>
        <div class="flex items-center justify-between">
            <button type="submit" class="bg-blue-700 w-full hover:bg-blue-900 text-white font-bold py-2 px-4 rounded" type="button">
                Login
            </button>
        </div>
    </form>
</div>