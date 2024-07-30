<x-app-layout>
    <x-slot name="header">Forecast</x-slot>
    <x-slot name="contentTitle">Forecast Data</x-slot>
    <x-slot name="title">Forecast</x-slot>


    <div class="my-3 text-right">
        <a href="{{route('forecasts.create')}}" class="py-2 font-semibold rounded text-white bg-blue-400 px-3">
            <span class="flex-none">Create New</span>
        </a>
    </div>
    <div class="w-full">
        @livewire('forecasts.data-list')
    </div>
</x-app-layout>
