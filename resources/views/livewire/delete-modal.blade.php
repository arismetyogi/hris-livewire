<div class="p-6 text-center">
    <h2 class="text-lg font-bold text-gray-800">Are you sure to delete this {{ $model }}?</h2>
    <p class="mt-2 text-sm text-gray-600">This action cannot be undone.</p>

    <div class="mt-4 flex justify-center space-x-4">
        <x-danger-button
            wire:click="delete"
            class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">
            delete
        </x-danger-button>
        <x-secondary-button
            wire:click="$dispatch('closeModal')"
            class="px-4 py-2 bg-gray-300 text-gray-700 rounded hover:bg-gray-400">
            cancel
        </x-secondary-button>
    </div>
</div>
