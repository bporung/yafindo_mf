<x-app-layout>
    <x-slot name="header">Report Delivery Plan</x-slot>
    <x-slot name="contentTitle">Report Delivery Plan Data</x-slot>
    <x-slot name="title">Report Delivery Plan</x-slot>


    <div class="my-3 text-right">
        <a href="{{route('reportdeliveryplans.create')}}" class="py-2 font-semibold rounded text-white bg-blue-400 px-3">
            <span class="flex-none">Create New</span>
        </a>
    </div>
    <div class="w-full">
        @livewire('reportdeliveryplans.data-list')
    </div>
</x-app-layout>
