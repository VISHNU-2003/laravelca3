@props(['message'])

<div class="fixed bottom-4 left-1/2 -translate-x-1/2 w-full max-w-md px-2" x-data="{ show: true }" x-show="show" x-init="setTimeout(() => {show = false; $wire.set('message', '')}, 3000)" x-transition:enter="transition ease-in duration-300" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 scale-90" x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition ease-in duration-300" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-90">
    <div class="flex w-full bg-gray-200 border border-gray-300 dark:border-gray-700 dark:bg-gray-900 shadow-md rounded-lg overflow-hidden mx-auto">
        <div class="w-2 bg-blue-600">
        </div>
        <div class="w-full flex justify-between items-start px-2 py-2">
            <div class="flex flex-col ml-2">
                <label class="text-gray-500">{{ config('app.name', 'Laravel') }}</label>
                <p class="text-gray-800 dark:text-white">{{ $message }}</p>
            </div>
            <button @click="show = false" x-on:click="$wire.set('message', '')" type="button">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    </div>
</div>