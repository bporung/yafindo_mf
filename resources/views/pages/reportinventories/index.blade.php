<x-app-layout>
    <x-slot name="header">Report Inventory</x-slot>
    <x-slot name="contentTitle">Report Inventory Data</x-slot>
    <x-slot name="title">Report Inventory</x-slot>


    <div class="my-3 text-right">
        <a href="{{route('reportinventories.create')}}" class="py-2 font-semibold rounded text-white bg-blue-400 px-3">
            <span class="flex-none">Create New</span>
        </a>
    </div>
    <div class="w-full">
        @livewire('reportinventories.data-list')
    </div>
</x-app-layout>
