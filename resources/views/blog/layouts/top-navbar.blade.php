<nav class="w-full py-8 bg-stone-900 shadow">
    <div class="w-full container mx-auto flex flex-wrap items-center justify-between">
        <div class="flex items-center font-bold text-sm text-white uppercase">
            <a class="hover:text-gray-200 hover:underline px-4" href="{{ route('admin.dashboard') }}">
                @if (Auth::check())
                    Dashboard
                @endif
            </a>
        </div>

        <div class="bg-stone-900 flex items-center text-lg no-underline text-white">
            <div class="flex flex-col items-center py-1">
                <a class="font-serif font-bold text-white uppercase hover:text-gray-300 text-3xl"
                    href="{{ route('home') }}">
                    <i class="fa fa-record-vinyl fa-xl pr-2"></i>
                    {{ __('Kuchla') }}
                </a>
            </div>
        </div>

        <div class="flex items-center text-lg no-underline text-white p-2">
            <a class="pl-6" href="#">
                <i class="fab fa-instagram"></i>
            </a>
            <a class="pl-6" href="#">
                <i class="fa-solid fa-magnifying-glass"></i>
            </a>
        </div>
    </div>
</nav>
