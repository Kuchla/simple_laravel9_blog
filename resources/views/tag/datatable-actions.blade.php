<div class="flex space-x-1 justify-around">
    <x-modal :value="$id">
        <x-slot name="trigger">
            <button class="p-1 text-teal-600 hover:bg-teal-600 hover:text-white rounded"
                wire:click="show({{ $id }})">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"></path>
                    <path fill-rule="evenodd"
                        d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z"
                        clip-rule="evenodd"></path>
                </svg>
            </button>
        </x-slot>
        <h3 class="text-lg leading-6 font-medium text-gray-900">
            Show {{ $id }}
        </h3>
        <div class="mt-2">
            @include('tag.form-inputs', ['disabledInputs' => 'disabled'])
        </div>
    </x-modal>

    <x-modal :value="$id">
        <x-slot name="trigger">
            <button class="p-1 text-blue-600 hover:bg-blue-600 hover:text-white rounded"
                wire:click.prevent="edit({{ $id }})">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z">
                    </path>
                </svg>
            </button>
        </x-slot>
        <h3 class="text-lg leading-6 font-medium text-gray-900">
            Edit {{ $id }}
        </h3>
        <div class="mt-2">
            <div class="mb-4">
                <form x-on:saved.window="open = false">
                    @include('tag.form-inputs')

                    <div class="flex items-center justify-center mt-4">
                        <x-primary-button class="ml-3" wire:click.prevent="update({{ $id }})">
                            {{ __('Update') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </x-modal>

    @include('datatables::delete', ['value' => $id])
</div>
