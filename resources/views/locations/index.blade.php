<x-app-layout>
    <x-slot name="header">
        <div class="grid grid-cols-1 md:grid-cols-2">
            <div class="">
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                    Locations
                </h2>
            </div>
            <div class="flex justify-start md:justify-end">
                <x-primary-button type="button" x-data="" x-on:click.prevent="$dispatch('open-modal', 'create-new')">Add
                    New</x-primary-button>
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


            <div class="bg-white dark:bg-gray-800 mt-3 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="bg-white dark:bg-slate-800 rounded-md overflow-hidden">
                    <table class="w-full">
                        <thead class="bg-red-700">
                            <tr class="text-white">
                                <th class="px-8 py-4 text-start">Location Name</th>
                                <th class="px-8 py-4 text-start">Item Count</th>
                                <th class="px-8 py-4 text-start">Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($locations as $location)
                            <tr class="text-slate-700 dark:text-slate-100">
                                <td class="px-8 py-2 text-start">{{$location->location_name}}</td>
                                <td class="px-8 py-2 text-start">{{$location->items_count}} item</td>
                                <td class="px-8 py-2 text-start">
                                    <a href="{{route('locations.show', $location->uuid)}}">detail</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="p-6">
                        {{ $locations }}
                    </div>

                </div>
            </div>
        </div>
    </div>

    <x-modal name="create-new" :show="false" focusable>
        <div class="p-8">
            <h3 class="text-slate-900 dark:text-slate-200">Create New Location</h3>
            <form action="{{route('locations.store')}}" method="post">
                @csrf
                <div class="mt-4">
                    <x-input-label for="location" :value="__('Location Name')" />
                    <x-text-input id="location" class="block mt-1 w-full" type="text" name="location"
                        :value="old('location')" required autofocus autocomplete="Location" />
                    <x-input-error :messages="$errors->get('location')" class="mt-2" />
                </div>
                <div class="mt-4">
                    <x-input-label for="size" :value="__('Location Size')" />
                    @php
                    $ukuran = [
                    'small' => 'Small',
                    'medium' => 'Medium',
                    'large' => 'Large',
                    ]
                    @endphp
                        <div class="flex justify-between">
                            @foreach ($ukuran as $item => $label)
                            <label for="{{$label}}">
                                <input type="radio" name="size" id="{{$label}}" required value="{{$item}}"
                                    @checked(old('size', $item->size ?? '' ) == $item)>
                                <span class="ms-2 text-sm text-slate-800 dark:text-slate-200"">{{$label}}</span>
                            </label>
                            @endforeach
                        </div>
                    <x-input-error :messages=" $errors->get('size')" class="mt-2" />

                </div>

                    <div class="mt-4">
                        <x-input-label for="notes" :value="__('Notes')" />
                        <x-text-area name="notes" class="mt-1 block w-full">{{old('notes')}}</x-text-area>
                        <x-input-error :messages="$errors->get('notes')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-primary-button type="submit">Save</x-primary-button>
                    </div>

            </form>
        </div>
    </x-modal>

</x-app-layout>
