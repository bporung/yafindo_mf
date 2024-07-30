<x-app-layout>
    <x-slot name="header">Product</x-slot>
    <x-slot name="contentTitle">Product Data</x-slot>
    <x-slot name="title">Product</x-slot>


    <div class="my-3 text-right">
        <a href="{{route('products.create')}}" class="py-2 font-semibold rounded text-white bg-blue-400 px-3">
            <span class="flex-none">Create New</span>
        </a>
    </div>
    <div class="w-full">
        @livewire('products.data-list')
    </div>
</x-app-layout>
