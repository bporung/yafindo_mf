<x-app-layout>
    <x-slot name="header">Category</x-slot>
    <x-slot name="contentTitle">Category Data</x-slot>
    <x-slot name="title">Category</x-slot>


    <div class="my-3 text-right">
        <a href="{{route('categories.create')}}" class="py-2 font-semibold rounded text-white bg-blue-400 px-3">
            <span class="flex-none">Create New</span>
        </a>
    </div>
    <div class="w-full">
        @livewire('categories.data-list')
    </div>
</x-app-layout>
