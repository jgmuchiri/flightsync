<div>

    <div class="container mx-auto px-4 grid grid-cols-3 gap-4">
        @for($i=1; $i<5; $i++)
            <div class="-mx-1 lg:-mx-4">
                <div class="my-1 px-1 w-full lg:my-4 lg:px-4">

                    <article class="overflow-hidden rounded-lg shadow-lg border">
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
                                <div>
                                    <a class="ml-2 text-sm hover:underline" href="#">
                                        <span class="text-primary-400">John Doe </span> |  11/1/19
                                    </a>
                                    <p class="ml-2 text-sm text-gray-400">
                                        Topic they commented on
                                    </p>
                                </div>
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
</div>
