    <x-slot name="header">
        {{ __($post->title) }}
    </x-slot>

    <div class="container mx-auto flex flex-wrap py-6">

        <!-- Post Section -->
        <section class="w-full md:w-2/3 flex flex-col px-3">

            <article class="shadow my-4 bg-gray-100 rounded">
                <div class="flex flex-col px-6 pt-6 pb-2">
                    <a href="{{ route('show-post', $post->id) }}"
                        class="text-rose-600 text-sm px-1 font-bold uppercase border-l-4 border-rose-600 mb-4">{{ $post->category->name }}</a>

                    <a href="#"
                        class="text-3xl font-serif font-bold hover:text-gray-700 pb-4">{{ $post->title }}</a>
                    <hr>

                    <h1 class="text-2xl pb-3 mb-2">{{ $post->description }}</h1>

                    <p href="#" class="text-sm">
                        By <a href="#" class="font-semibold hover:text-gray-800">{{ $post->user->name }}</a>,
                        Published on
                        {{ $post->created_at }}
                    </p>
                    <img src="{{ asset($post->image->path) }}" class="w-4/6 aspect-square rounded">
                    <p class="py-3">{{ $post->text }}</p>
                </div>
            </article>

            <div class="w-full flex pt-3">
                @if ($post->previous())
                    <a href="{{ route('show-post', $post->previous()->id) }}"
                        class="w-1/2 bg-gray-100 shadow hover:shadow-md text-left p-6">
                        <p class="text-lg text-rose-800 font-bold flex items-center"><i
                                class="fas fa-arrow-left pr-1"></i>
                            Previous</p>
                        <p class="pt-2 truncate">{{ $post->previous()->title ?? '' }}</p>
                    </a>
                @else
                    <div class="w-1/2 bg-gray-100 shadow hover:shadow-md text-left p-6"></div>
                @endif
                @if ($post->next())
                    <a href="{{ route('show-post', $post->next()->id) }}"
                        class="w-1/2 bg-gray-100 shadow hover:shadow-md text-right p-6">
                        <p class="text-lg text-rose-800 font-bold flex items-center justify-end">Next <i
                                class="fas fa-arrow-right pl-1"></i></p>
                        <p class="pt-2 truncate">{{ $post->next()->title }}</p>
                    </a>
                @else
                    <div class="w-1/2 bg-gray-100 shadow hover:shadow-md text-right p-6"></div>
                @endif
            </div>

            <div class="flex flex-col md:flex-row shadow bg-gray-100 mt-6 mb-10 p-6">
                <div class="flex basis-1/6 justify-center pb-4 mr-2">
                    <img src="{{ asset($post->user->image->path) }}" class="rounded-full shadow h-32 max-w-none">
                </div>
                <div class="">
                    <p class="flex justify-center md:justify-start font-semibold text-2xl">{{ $post->user->name }}</p>
                    <p class="pt-2">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur vel neque non
                        libero suscipit suscipit eu eu urna.</p>
                    <div
                        class="flex justify-center md:justify-start text-2xl no-underline text-rose-800 pt-4">
                        <a class="" href="#">
                            <i class="fab fa-facebook"></i>
                        </a>
                        <a class="pl-4" href="#">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a class="pl-4" href="#">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a class="pl-4" href="#">
                            <i class="fab fa-linkedin"></i>
                        </a>
                    </div>
                </div>
            </div>

        </section>

        <!-- Sidebar Section -->
        <aside class="w-full md:w-1/3 flex flex-col items-center px-3">

            <div class="w-full bg-gray-100 shadow flex flex-col my-4 p-6">
                <p class="text-xl font-semibold pb-5">About Us</p>
                <p class="pb-2">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas mattis est eu odio
                    sagittis tristique. Vestibulum ut finibus leo. In hac habitasse platea dictumst.</p>
                <a href="#"
                    class="w-full bg-rose-600 text-white font-bold text-sm uppercase rounded hover:bg-rose-500 flex items-center justify-center px-2 py-3 mt-4">
                    Get to know us
                </a>
            </div>

            <div class="w-full bg-gray-100 shadow flex flex-col my-4 p-6">
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
                    class="w-full bg-rose-800 text-white font-bold text-sm uppercase rounded hover:bg-rose-700 flex items-center justify-center px-2 py-3 mt-6">
                    <i class="fab fa-instagram mr-2"></i> Follow @dgrzyb
                </a>
            </div>

        </aside>

    </div>
