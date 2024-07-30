<x-app-layout>
    <x-slot name="header">Customer</x-slot>
    <x-slot name="contentTitle">Customer Data</x-slot>
    <x-slot name="title">Customer</x-slot>


    @can("manage customer")
    <div class="my-3 text-right">
        <a href="{{route('customers.create')}}" class="py-2 font-semibold rounded text-white bg-blue-400 px-3">
            <span class="flex-none">Create New</span>
        </a>
    </div>
    @endcan
    <div class="w-full">
        @livewire('customers.data-list')
    </div>
</x-app-layout>
