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