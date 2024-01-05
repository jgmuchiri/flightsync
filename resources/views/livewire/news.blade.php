<div>


    <section class="container mx-auto py-10 px-4">

        <div
            class="grid grid-flow-row gap-2 text-neutral-600 sm:grid-cols-1 md:grid-cols-2">
            @foreach($posts as $key => $post)
                @if($key <= 3)
                    <a href="{{$post->url}}" class="bg-white w-full flex items-center px-2 rounded-md shadow">
                        <div class="flex items-center space-x-4">
                            <img
                                src="{{$post->featured_image}}"
                                alt="My profile" class="w-64 h-28 rounded-md">
                        </div>
                        <div class="flex-grow p-3">
                            <div class="font-semibold text-primary-600">
                                {{$post->title}}
                            </div>
                            <div class="text-sm text-gray-400">
                                {{$post->description}}
                            </div>
                            <div class="text-xs mt-2 text-gray-800 dark:text-primary-400">
                                {{$post->published_at->format('d M Y H:i')}} |
                                {{$post->author}}
                            </div>
                        </div>
                    </a>
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
</div>
