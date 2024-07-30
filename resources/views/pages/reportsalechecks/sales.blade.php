<x-app-layout>
    <x-slot name="header">Report Sales Check</x-slot>
    <x-slot name="contentTitle">Report Sales Data</x-slot>
    <x-slot name="title">Report Sales Check</x-slot>


    <div class="w-full">
        @livewire('reportsalechecks.data-list')
    </div>
</x-app-layout>
