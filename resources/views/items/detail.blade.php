<x-app-layout>
    <x-slot name="header">
        <div class="grid grid-cols-1 md:grid-cols-2">
            <div class="">
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                    Item
                </h2>
            </div>
            <div class="flex justify-start md:justify-end">
                <form action="{{route('items.destroy', $item->uuid)}}" method="post">
                    @csrf
                    @method('delete')
                    <x-primary-button type="button" x-data=""
                        x-on:click.prevent="$dispatch('open-modal', 'create-new')">Edit</x-primary-button>
                    <x-danger-button type="submit" onclick="return confirm('are you sure?')">Delete</x-danger-button>
                </form>
            </div>
        </div>
    </x-slot>

    <div class="py-12">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 mt-3 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-xl text-slate-900 dark:text-slate-100">{{$item->location_name}}</h3>
                <p class="mt-2 text-slate-900 dark:text-slate-100">{{$item->size}}</p>
                <p class="mt-2 text-slate-900 dark:text-slate-100">{{$item->notes}}</p>
            </div>
        </div>

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
            <div x-data="{show : true}" x-show="show"
                class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                <strong class="font-bold">yeay!</strong>
                <span class="block sm:inline">{{session('success')}}</span>

                <button class="absolute top-0 bottom-0 right-0 px-4 py-3" type="button" @click="show = false">
                    <svg class="fill-current h-6 w-6 text-green-500" role="button" xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 20 20">
                        <title>Close</title>
                        <path
                            d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z" />
                    </svg>
                </button>
            </div>
            @endif


            <div class="bg-white dark:bg-gray-800 mt-3 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="bg-white dark:bg-slate-800 rounded-md overflow-hidden">
                    
                </div>
            </div>
        </div>
    </div>

    <x-modal name="create-new" :show="false" focusable>
        <div class="p-8">
            <h3 class="text-slate-900 dark:text-slate-200">Edit Item</h3>
            
        </div>
    </x-modal>

</x-app-layout>
