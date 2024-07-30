<x-app-layout>
    <x-slot name="header">Shipment</x-slot>
    <x-slot name="contentTitle">Shipment Data</x-slot>
    <x-slot name="title">Shipment</x-slot>


    <div class="my-3 text-right">
        <a href="{{route('shipments.create')}}" class="py-2 font-semibold rounded text-white bg-blue-400 px-3">
            <span class="flex-none">Create New</span>
        </a>
    </div>
    <div class="w-full">
        @livewire('shipments.data-list')
    </div>
</x-app-layout>
