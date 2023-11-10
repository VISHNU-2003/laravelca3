<div>
    <label class="flex relative inline-flex items-center cursor-pointer my-2 mx-4" x-data="{
                toggle: () => {
                    if (localStorage.theme === 'dark') {
                        localStorage.theme = 'light';
                        document.documentElement.classList.remove('dark');
                    } else {
                        localStorage.theme = 'dark';
                        document.documentElement.classList.add('dark');
                    }
                },
            }">
        <input type="checkbox" class="sr-only peer" wire:model.defer="status" wire:click="clicked(localStorage.theme)" @click="toggle" @if($status) checked @endif>
        <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-dark-300 dark:peer-focus:ring-dark-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:dark:bg-gray-300 after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-gray-400"></div>
    </label>
</div>