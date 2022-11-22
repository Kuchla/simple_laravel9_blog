<x-modal :value="0">
    <x-slot name="trigger">
        <button
            class="flex items-center px-3 text-xs font-medium tracking-wider text-green-500 uppercase bg-white border border-green-400 space-x-2 rounded-md leading-4 hover:bg-green-200 focus:outline-none"><span>Create</span>
            <iconify-icon inline icon="material-symbols:add-box-outline"></iconify-icon>
            <svg class="h-5 w-5 stroke-current m-2" fill="none" xmlns="http://www.w3.org/2000/svg" width="1.5em"
                height="1.5em" preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24">
                <path fill="currentColor"
                    d="M11 17h2v-4h4v-2h-4V7h-2v4H7v2h4Zm-6 4q-.825 0-1.413-.587Q3 19.825 3 19V5q0-.825.587-1.413Q4.175 3 5 3h14q.825 0 1.413.587Q21 4.175 21 5v14q0 .825-.587 1.413Q19.825 21 19 21Zm0-2h14V5H5v14ZM5 5v14V5Z" />
            </svg>
        </button>
    </x-slot>

    <h3 class="text-lg leading-6 font-medium text-gray-900">
        Create
    </h3>
    <div class="mt-2">
        <div class="mb-4">
            <form x-on:saved.window="open = false">
                @include('category.form-inputs')

                <div class="flex items-center justify-center mt-4">
                    <x-primary-button class="ml-3" wire:click.prevent="save()">
                        {{ __('Save') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-modal>
