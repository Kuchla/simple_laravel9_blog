<div class="overflow-y-auto h-64">
    <x-input-label for="title" :value="__('Title')" />
    <x-text-input :disabled="$this->disabledInputs" id="title" class="block mt-1 w-full" type="text" required autofocus
        wire:model.lazy="post.title" />
    <x-input-error :messages="$errors->get('post.title')" class="mt-2" />

    <x-input-label for="description" :value="__('Description')" class="mt-2" />
    <textarea id="description" rows="2" wire:model.lazy="post.description" @disabled($this->disabledInputs)
        class="mt-1 w-full resize-none rounded rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"></textarea>
    <x-input-error :messages="$errors->get('post.description')" class="mt-2" />

    <x-input-label for="text" :value="__('Text')" class="mt-2" />
    <div wire:ignore id="ckdiv-{{ @$ckeditor_class }}">
        <textarea id="text" rows="3" wire:model.lazy="post.text" @disabled($this->disabledInputs)
            class="{{ @$ckeditor_class }} mt-1 w-full resize-none rounded rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"></textarea>
    </div>
    <x-input-error :messages="$errors->get('post.text')" class="mt-2" />

    <x-input-label for="category_id" :value="__('Category')" class="mt-2" />
    <select wire:model="post.category_id" @disabled($this->disabledInputs) id="category_id"
        class="mt-1 w-full resize-none rounded rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
        aria-label="Default select example">
        <option selected>Select a option</option>
        @foreach ($this->category as $category)
            <option value="{{ $category->id }}" wire:key={{ $category->id }}>{{ $category->name }}</option>
        @endforeach
    </select>
    <x-input-error :messages="$errors->get('post.category_id')" class="mt-2" />

    <x-input-label for="image" :value="__('Image')" class="mt-2" />
    <div class="flex items-center justify-center w-full">
        <label for="dropzone-file"
            class="flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-bray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
            <div class="flex flex-col items-center justify-center pt-5 pb-6">
                <svg aria-hidden="true" class="w-10 h-10 mb-3 text-gray-400" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12">
                    </path>
                </svg>

                @switch($this->formAction)
                    @case('show')
                        <img class="h-32 w-40" src="{{ asset(@$this->post->image->path) }}">
                    @break

                    @case('edit')
                        <img class="h-32 w-40"
                            src="{{ $this->image ? $this->image->temporaryUrl() : asset(@$this->post->image->path) }}">
                    @break

                    @default
                        @if ($this->image)
                            <img class="h-32 w-40" src="{{ $this->image->temporaryUrl() }}">
                        @endif
                @endswitch
                <input id="dropzone-file" type="file" class="hidden" @disabled($this->disabledInputs) wire:model="image"
                    accept="image/jpg, image/jpeg, image/png" />

                <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span class="font-semibold">Click to
                        choose</span></p>
                <p class="text-xs text-gray-500 dark:text-gray-400">PNG JPEG or JPG</p>
            </div>
        </label>
    </div>
    <x-input-error :messages="$errors->get('image')" class="mt-2" />

    <div class="block mt-4">
        <label for="active" class="inline-flex items-center">
            <input id="active" type="checkbox" wire:model="post.active" @disabled($this->disabledInputs)
                class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
            <span class="ml-2 text-sm text-gray-600">{{ __('Active') }}</span>
        </label>
    </div>
</div>
@push('scripts')
    @once
        <script>
            window.addEventListener('create_ckeditor', event => {
                value = event.detail.value;

                ClassicEditor
                    .create(document.querySelector(value))
                    .then(editor => {
                        editor.model.document.on('change:data', () => {
                            @this.set('post.text', editor.getData());
                        })
                    })
                    .catch(error => {
                        console.error(error);
                    });
                document.querySelector('.ck-reset').remove();
            });
        </script>
    @endonce
@endpush
