<x-filament-panels::page>

    <div class="container mx-auto px-4">
        <label for="default-search"
               class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
        <div class="relative">
            <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                     xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                </svg>
            </div>
            <input type="search" id="default-search"
                   class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                   placeholder="Search News..." required>
            <button type="submit"
                    class="text-white absolute end-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                Search
            </button>
        </div>
    </div>

    <section class="container mx-auto py-10 px-4">

        <div
            class="grid grid-flow-row gap-2 text-neutral-600 sm:grid-cols-1 md:grid-cols-2">
        @foreach($posts as $key => $post)
            @if($key <= 3)
                <div class="bg-white w-full flex items-center px-2 rounded-xl shadow border">
                    <div class="flex items-center space-x-4">
                        <img
                            src="{{$post->featured_image}}"
                            alt="My profile" class="w-64 h-32 rounded-sm">
                    </div>
                    <div class="flex-grow p-3">
                        <div class="font-semibold text-gray-700">
                            {{$post->title}}
                        </div>
                        <div class="text-sm text-gray-500">
                            {{$post->description}}
                        </div>
                        <div class="text-xs mt-2 text-gray-700 dark:text-gray-400">
                            {{$post->published_at->format('d M Y H:i')}} |
                            {{$post->source_name}}
                        </div>
                    </div>
                </div>
            @endif
        @endforeach
        </div>

        <div
            class="grid grid-flow-row gap-8 text-neutral-600 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">

            @foreach($posts as $key=> $post)
                @if($key > 3 )
                    <div
                        class="my-8 rounded shadow-lg shadow-gray-200 dark:shadow-gray-900 bg-white dark:bg-gray-800 duration-300 hover:-translate-y-1">
                        <a href="{{$post->source_url}}" class="cursor-pointer">
                            <figure>
                                <img
                                    src="{{$post->featured_image}}"
                                    class="rounded-t h-72 w-full object-cover"/>

                                <figcaption class="p-4">
                                    <p
                                        class="text-lg mb-4 font-bold leading-relaxed text-gray-800 dark:text-gray-300">
                                        {{$post->title}}
                                    </p>

                                    <div
                                        class="leading-5 text-xs text-gray-500 dark:text-gray-400">
                                        {{$post->description}}
                                    </div>
                                    <div class="text-xs mt-2 text-gray-700 dark:text-gray-400">
                                        {{$post->published_at->format('d M Y H:i')}} |
                                        {{$post->source_name}}
                                    </div>
                                </figcaption>
                            </figure>
                        </a>
                    </div>
                @endif
            @endforeach
        </div>
    </section>

    <section class="container mx-auto py-10 px-4 mt-6">
        {{$posts->links()}}
    </section>
</x-filament-panels::page>
