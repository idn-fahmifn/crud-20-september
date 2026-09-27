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
        </div>

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 mt-3 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-xl text-slate-900 dark:text-slate-100">{{$item->item_name}}</h3>
                <p class="mt-2 text-slate-900 dark:text-slate-100">{{$item->brand}}</p>
                <p class="mt-2 text-slate-900 dark:text-slate-100">Total Stock : {{$item->stock}}</p>
                <p class="mt-2 text-slate-900 dark:text-slate-100">
                    Location : {{ $item->location_id === null ? 'change location' : $item->location->location_name }}
                </p>
            </div>
        </div>


    </div>

    <x-modal name="create-new" :show="false" focusable>
        <div class="p-8">
            <h3 class="text-slate-900 dark:text-slate-200">Edit Item</h3>
            <form action="{{route('items.update', $item->uuid)}}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mt-4">
                    <x-input-label for="item" :value="__('Item Name')" />
                    <x-text-input id="item" class="block mt-1 w-full" type="text" name="item"
                        :value="old('item', $item->item_name)" required autofocus autocomplete="item" />
                    <x-input-error :messages="$errors->get('item')" class="mt-2" />
                </div>

                <div class="mt-4">
                    <x-input-label for="brand" :value="__('Brand Name')" />
                    <x-text-input id="brand" class="block mt-1 w-full" type="text" name="brand"
                        :value="old('brand', $item->brand)" required autofocus autocomplete="brand" />
                    <x-input-error :messages="$errors->get('brand')" class="mt-2" />
                </div>

                <div class="mt-4">
                    <x-input-label for="location" :value="__('Location')" />
                    <select name="location" id="location" required
                        class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                        <option value="" disabled>choose location</option>
                        @forelse ($locations as $location)
                        <option value="{{$location->id}}" @selected(old('location', $item->location_id) == $item->location_id ) >{{$location->location_name}}</option>
                        @empty
                        <option value="" disabled>location not found</option>
                        @endforelse
                    </select>
                    <x-input-error :messages="$errors->get('location')" class="mt-2" />
                </div>

                <div class="mt-4">
                    <x-input-label for="stock" :value="__('Item Stock')" />
                    <x-text-input id="stock" class="block mt-1 w-full" type="number" name="stock"
                        :value="old('stock', $item->stock)" required autofocus autocomplete="stock" />
                    <x-input-error :messages="$errors->get('stock')" class="mt-2" />
                </div>

                <div class="mt-4">
                    <x-input-label for="images" :value="__('Item Image')" />
                    <x-text-input id="images" accept="image/*" class="block mt-1 w-full py-6 px-2 border border-dashed"
                        type="file" name="images" :value="old('images')" autofocus autocomplete="images" />
                    <x-input-error :messages="$errors->get('images')" class="mt-2" />
                </div>

                <div class="mt-4">
                    <x-input-label for="desc" :value="__('Item Description')" />
                    <x-text-area name="desc" class="mt-1 block w-full">{{old('desc', $item->desc)}}</x-text-area>
                    <x-input-error :messages="$errors->get('desc')" class="mt-2" />
                </div>

                <div class="mt-4">
                    <x-primary-button type="submit">Save</x-primary-button>
                </div>

            </form>
        </div>
    </x-modal>

</x-app-layout>
