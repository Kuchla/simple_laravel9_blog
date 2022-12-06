<div>
    @if (session()->has('message'))
        <div class="my-2" x-data="{ showMessage: true }" x-show="showMessage" x-init="setTimeout(() => showMessage = false, 30000)">
            <div class="border text-gray-600 px-4 py-3 rounded relative {{ session('message')['type'] == 'success' ? 'border-green-400 bg-green-200' : 'border-red-400 bg-red-200' }}"
                role="alert">
                <span class="block sm:inline">{{ session('message')['text'] }}</span>
            </div>
        </div>
    @endif
</div>
