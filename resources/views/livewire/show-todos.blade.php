<div>
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <div class="flex flex-col p-4 space-y-4 sm:flex-row sm:justify-between sm:space-y-0 sm:space-x-4">
            <div class="grid grid-cols-2 sm:grid-cols-2 gap-4">
                <!-- input select -->
                <select wire:model.live="show" id="show" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-3 px-3 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option value="actived">Actived</option>
                    <option value="completed">Completed</option>
                    <option value="deleted">Deleted</option>
                    <option value="all">All</option>
                </select>
                <!-- input search -->
                <div class="relative flex-grow focus-within:z-10">
                    <div class="absolute inset-y-0 left-0 pl-2 md:pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" stroke="currentColor" fill="none">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                    <input wire:model.live.debounce.250ms="search" class="h-full block p-3 pl-8 md:pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-full bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search todo" type="text">
                    <div class="absolute inset-y-0 right-0 pr-2 flex items-center">
                        <button wire:click="$set('search', null)" class="text-gray-400 hover:text-red-500/80 focus:outline-none">
                            <svg class="h-5 w-5 stroke-current" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
            <div>
                <!-- button add new -->
                <button type="button" wire:click="create()" class="w-full text-blue-600 hover:text-white dark:text-white bg-white border border-blue-600 dark:border-white dark:hover:border-blue-700 hover:bg-blue-500 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 md:px-9 py-3 text-center inline-flex items-center dark:bg-transparent dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    Add new
                    <svg class="w-3.5 h-3.5 ml-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9" />
                    </svg>
                </button>
            </div>
        </div>

        @if($message)
        <x-message :message="$message" />
        @endif

        @if($isOpen)
        @include('livewire.show-todos-modal')
        @endif

        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="pl-5 py-3 w-10">
                        <span class="sr-only">Status</span>
                    </th>
                    <th scope="col" class="px-3 py-3">
                        Title
                    </th>
                    @if(count($todos) > 0)
                    <th scope="col" class="px-3 py-3 hidden md:table-cell">
                        Description
                    </th>
                    <th scope="col" class="pl-5 py-3 w-16">
                        <span class="sr-only">Action</span>
                    </th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @forelse($todos as $todo)
                <tr class="bg-white border-y dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-100 hover:dark:bg-gray-900/50 h-20 hover:shadow-inner cursor-pointer">
                    <th scope="row" wire:click="edit({{ $todo->id }})" class="pl-3 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        @if($todo->deleted_at)
                        <svg class="w-3 h-3 text-red-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        @elseif($todo->completed)
                        <svg class="w-3 h-3 text-green-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 16 12">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5.917 5.724 10.5 15 1.5" />
                        </svg>
                        @else
                        <svg class="w-3 h-3 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                        </svg>
                        @endif
                    </th>
                    <td scope="row" wire:click="edit({{ $todo->id }})" class="">
                        <span class="font-medium text-gray-900 dark:text-white">{{ $todo->title }}</span>
                    </td>
                    <td scope="row" wire:click="edit({{ $todo->id }})" class="hidden md:table-cell">
                        <span class="line-clamp-2">{{ $todo->description }}</span>
                    </td>
                    <td scope="row" class="">
                        <div class="grid grid-cols-2 gap-2">
                            @if(!$todo->trashed())
                            <svg wire:click="complete({{ $todo->id }})" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 p-1 bg-gray-200 dark:bg-gray-900 rounded">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                            </svg>
                            @else
                            <div></div>
                            @endif
                            <svg wire:click="delete({{ $todo->id }})" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 p-1 bg-gray-200 dark:bg-gray-900 rounded">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                            </svg>

                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="3" class="px-6 py-7 text-sm leading-5 whitespace-no-wrap text-center">
                        No todos found
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>