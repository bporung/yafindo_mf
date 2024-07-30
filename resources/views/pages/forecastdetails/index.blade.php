<x-app-layout>
    <x-slot name="header">Brand</x-slot>
    <x-slot name="contentTitle">Brand Data</x-slot>
    <x-slot name="title">Brand</x-slot>


    <div class="my-3 text-right">
        <a href="{{route('brands.create')}}" class="py-2 font-semibold rounded text-white bg-blue-400 px-3">
            <span class="flex-none">Create New</span>
        </a>
    </div>
    <div class="w-full">
        @livewire('brands.data-list')
    </div>
</x-app-layout>
