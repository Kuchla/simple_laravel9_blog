<x-slot name="header">
    {{ __('Home') }}
</x-slot>

<div class="container mx-auto flex flex-wrap py-6 justify-center">
    <!-- Posts Section -->
    <section class="w-full md:w-3/4 flex flex-col items-center px-3">
        <div class="grid grid-cols-1 xl:grid-cols-3 md:grid-cols-2 sm:grid-cols-2 mb-1">
            @foreach ($posts as $post)
                <article class="m-2 p-2 bg-gray-100 rounded shadow">
                    <!-- Article Image -->

                    <div class="flex flex-col p-2">
                        <a href="{{ route('show-post', $post->id) }}" class="hover:opacity-75">
                            <img class="aspect-square min-w-full rounded mb-4" src="{{ asset($post->image->path) }}">
                        </a>

                        <a href="{{ route('show-post', $post->id) }}"
                            class="text-rose-600 text-sm px-1 font-bold uppercase border-l-4 border-rose-600">{{ $post->category->name }}</a>

                        <a href="{{ route('show-post', $post->id) }}"
                            class="text-3xl font-bold hover:text-gray-700 py-1">{{ $post->title }}</a>

                        <p class="text-sm pb-4 truncate">
                            By <a href="{{ route('show-post', $post->id) }}"
                                class="font-semibold hover:text-gray-800">{{ $post->user->name }}</a>,
                            Published on
                            {{ $post->created_at }}
                        </p>

                        <a href="{{ route('show-post', $post->id) }}" class="pb-2">{{ $post->description }}</a>

                        <a href="{{ route('show-post', $post->id) }}"
                            class="uppercase text-gray-800 hover:text-black">Continue Reading <i
                                class="fas fa-arrow-right"></i></a>
                    </div>
                </article>
            @endforeach
        </div>

        {{ $posts->links('pagination::custom-tailwind') }}
    </section>

    <!-- Sidebar Section -->
    <aside class="w-full md:w-1/4 flex flex-col items-center">

        <div class="w-full bg-gray-100 shadow flex flex-col my-2 p-6 rounded">
            <p class="text-xl font-semibold pb-5">About Me</p>
            <p class="pb-2">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas mattis est eu odio
                sagittis tristique. Vestibulum ut finibus leo. In hac habitasse platea dictumst.</p>
            <a href="#"
                class="w-full bg-rose-600 text-white font-bold text-sm uppercase rounded hover:bg-rose-500 flex items-center justify-center px-2 py-3 mt-4">
                Get to know me
            </a>
        </div>

        <div class="w-full bg-gray-100 shadow flex flex-col my-2 p-6 rounded">
            <p class="text-xl font-semibold pb-5">Instagram</p>
            <div class="grid grid-cols-3 gap-3">
                <img class="hover:opacity-75" src="https://source.unsplash.com/collection/1346951/150x150?sig=1">
                <img class="hover:opacity-75" src="https://source.unsplash.com/collection/1346951/150x150?sig=2">
                <img class="hover:opacity-75" src="https://source.unsplash.com/collection/1346951/150x150?sig=3">
                <img class="hover:opacity-75" src="https://source.unsplash.com/collection/1346951/150x150?sig=4">
                <img class="hover:opacity-75" src="https://source.unsplash.com/collection/1346951/150x150?sig=5">
                <img class="hover:opacity-75" src="https://source.unsplash.com/collection/1346951/150x150?sig=6">
                <img class="hover:opacity-75" src="https://source.unsplash.com/collection/1346951/150x150?sig=7">
                <img class="hover:opacity-75" src="https://source.unsplash.com/collection/1346951/150x150?sig=8">
                <img class="hover:opacity-75" src="https://source.unsplash.com/collection/1346951/150x150?sig=9">
            </div>
            <a href="#"
                class="w-full bg-rose-600 text-white font-bold text-sm uppercase rounded hover:bg-rose-500 flex items-center justify-center px-2 py-3 mt-6">
                <i class="fab fa-instagram mr-2"></i> Follow @kuchla.com
            </a>
        </div>

    </aside>
</div>
