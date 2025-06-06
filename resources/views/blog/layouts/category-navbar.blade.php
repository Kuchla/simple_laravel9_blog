<nav class="w-full py-1 mb-4 border-t border-b bg-gray-100" x-data="{ open: false }">
    <div class="block sm:hidden">
        <a href="#"
            class="block md:hidden text-base font-bold uppercase text-center flex justify-center items-center"
            @click="open = !open">
            Topics <i :class="open ? 'fa-chevron-down' : 'fa-chevron-up'" class="fas ml-2"></i>
        </a>
    </div>

    <div :class="open ? 'block' : 'hidden'" class="w-full flex-grow sm:flex sm:items-center sm:w-auto">
        <div
            class="w-full container mx-auto flex flex-col sm:flex-row items-center justify-center text-sm font-bold uppercase mt-0 px-6 py-2">
            <a href="{{ route('home-by-category', ['category' => 0, 'tag' => isset($tagIdSelected) ? $tagIdSelected : 0]) }}"
                class="hover:bg-gray-400 rounded py-2 px-4 mx-2 {{ !$categoryIdSelected <= 0 ?: 'bg-gray-400' }}">All
            </a>

            @foreach ($categories as $category)
                <a href="{{ route('home-by-category', ['category' => $category->id, 'tag' => isset($tagIdSelected) ? $tagIdSelected : 0]) }}"
                    class="hover:bg-gray-400 rounded py-2 px-4 mx-2 {{ $category->id != $categoryIdSelected ?: 'bg-gray-400' }}">{{ $category->name }}</a>
            @endforeach
        </div>
    </div>
</nav>
