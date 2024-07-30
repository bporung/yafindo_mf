<x-app-layout>
    <x-slot name="header">UOM</x-slot>
    <x-slot name="contentTitle">UOM Data</x-slot>
    <x-slot name="title">UOM</x-slot>


    <div class="my-3 text-right">
        <a href="{{route('uoms.create')}}" class="py-2 font-semibold rounded text-white bg-blue-400 px-3">
            <span class="flex-none">Create New</span>
        </a>
    </div>
    <div class="w-full">
        @livewire('uoms.data-list')
    </div>
</x-app-layout>
