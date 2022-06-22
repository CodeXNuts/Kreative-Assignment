<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Category') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="mx-2 my-2">
                        <form action="{{ route('category.create') }}" method="POST">
                            @csrf
                            <h1>Create a new category</h1>

                            <x-auth-validation-errors class="mb-4" :errors="$errors" />
                            <div class="mt-2">
                                @livewire('category.show-category-dropdown')
                            </div>

                            <div class="mt-2">
                                <x-label for="name" :value="__('Category name')" />
                                <x-input id="name" class="block mt-1 w-full" placeholder="Enter category name" type="text" name="name" :value="old('name')" required autofocus />
                            </div>

                            <div class="mt-2">
                                <x-label for="slug" :value="__('Category slug')" />
                                <x-input id="slug" class="block mt-1 w-full" placeholder="Provide an unique slug for the category" type="text" name="slug" :value="old('slug')" required autofocus />
                            </div>

                            <x-button class="mt-4 bg-blue-500 text-white hover:bg-blue-700">
                                {{ __('Create') }}
                            </x-button>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
