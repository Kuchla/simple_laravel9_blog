<footer class="w-full border-t bg-gray-100 pb-12">
    <div class="relative w-full flex items-center invisible md:visible md:pb-12" x-data="getCarouselData()">
        <button
            class="z-10 absolute bg-rose-600 hover:bg-rose-500 text-white text-2xl font-bold hover:shadow rounded-full w-16 h-16 ml-12"
            x-on:click="decrement()">
            &#8592;
        </button>
        <template x-for="[id, value] in Object.entries(images).slice(currentIndex, currentIndex + 6)"
            :key="id">
            <a class="w-1/6 hover:opacity-75" x-bind:href="'{{ url('post/') }}/' + id">
                <img class="w-full aspect-square" x-bind:src="'{{ config('app.url') }}' + value">
            </a>
        </template>
        <button
            class="absolute right-0 bg-rose-600 hover:bg-rose-500 text-white text-2xl font-bold hover:shadow rounded-full w-16 h-16 mr-12"
            x-on:click="increment()">
            &#8594;
        </button>
    </div>
    <div class="w-full container mx-auto flex flex-col items-center">
        <div class="flex flex-col md:flex-row text-center md:text-left md:justify-between py-6">
            <a href="#" class="uppercase px-3">About Me</a>
            <a href="#" class="uppercase px-3">Contact Me</a>
        </div>
        <div href="#" class="uppercase px-3">©Copyright 2023 Kuchla - All rights reserved</div>
    </div>
</footer>

<script>
    function getCarouselData() {
        return {
            currentIndex: 0,
            images: @js($randomImages),
            increment() {
                this.currentIndex = this.currentIndex === Object.keys(this.images).length - 6 ?
                    0 :
                    this.currentIndex + 1;
            },
            decrement() {
                this.currentIndex = this.currentIndex === 0 ?
                    Object.keys(this.images).length - 6 :
                    this.currentIndex - 1;
            },
        }
    }
</script>
