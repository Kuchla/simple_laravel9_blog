<x-input-label for="name" :value="__('Name')" />
<x-text-input id="name" class="block mt-1 w-full" type="text" required autofocus wire:model.lazy="tag.name"
    :disabled="@$disabledInputs" />
<x-input-error :messages="$errors->get('tag.name')" class="mt-2" />

<div class="block mt-4">
    <label for="active" class="inline-flex items-center">
        <input id="active" type="checkbox" wire:model="tag.active"
            class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
            {{ @$disabledInputs }}>
        <span class="ml-2 text-sm text-gray-600">{{ __('Active') }}</span>
    </label>
</div>
