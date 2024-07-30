<x-app-layout>
    <x-slot name="header">Zone</x-slot>
    <x-slot name="contentTitle">Zone Data</x-slot>
    <x-slot name="title">Zone</x-slot>


    <div class="my-3 text-right">
        <a href="{{route('zones.create')}}" class="py-2 font-semibold rounded text-white bg-blue-400 px-3">
            <span class="flex-none">Create New</span>
        </a>
    </div>
    <div class="w-full">
        @livewire('zones.data-list')
    </div>
</x-app-layout>
