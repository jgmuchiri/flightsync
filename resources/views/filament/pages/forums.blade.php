<x-filament-panels::page>

    <div class="container mx-auto px-4">
        <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
        <div class="relative">
            <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                </svg>
            </div>
            <input type="search" id="default-search" class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search Forums..." required>
            <button type="submit" class="text-white absolute end-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Search</button>
        </div>
    </div>


    <div class="container mx-auto px-4">
        @for($i=1; $i<5; $i++)
            <div class="flex flex-wrap -mx-1 lg:-mx-4">
                <div class="my-1 px-1 w-full lg:my-4 lg:px-4">

                    <article class="overflow-hidden rounded-lg shadow-lg">
                        <header class="flex items-center justify-between leading-tight p-2 md:p-4">
                            <div class="">
                                <a class="no-underline hover:underline text-black text-lg" href="#">
                                    Forum Title
                                </a>
                                <p class="text-gray-300">
                                    Form description
                                </p>
                            </div>

                            <p class="text-grey-darker text-sm">
                                1030 Posts
                            </p>
                        </header>

                        <footer class="flex items-center justify-between leading-none p-2 md:p-4">
                            <div class="flex items-center no-underline text-black">
                                <img alt="Placeholder" class="block rounded-full" src="https://picsum.photos/32/32/?random">
                                <a class="ml-2 text-sm hover:underline" href="#">
                                    John Doe
                                </a>
                                <p class="ml-2 text-sm">
                                    Topic they commented on
                                </p>
                                <p class="text-grey-darker text-sm ml-4">
                                    11/1/19
                                </p>
                            </div>
                            <a class="no-underline text-grey-darker hover:text-red-dark" href="#">
                                <span class="hidden">Like</span>
                                <i class="fa fa-heart"></i>
                            </a>
                        </footer>

                    </article>

                </div>
            </div>

        @endfor
    </div>

</x-filament-panels::page>
