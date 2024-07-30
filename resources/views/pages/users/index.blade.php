<x-app-layout>
    <x-slot name="header">User</x-slot>
    <x-slot name="contentTitle">User Data</x-slot>
    <x-slot name="title">User</x-slot>


    <div class="my-3 text-right">
        <a href="{{route('users.create')}}" class="py-2 font-semibold rounded text-white bg-blue-400 px-3">
            <span class="flex-none">Create New</span>
        </a>
    </div>
    <div class="w-full">
        @livewire('users.data-list')
    </div>
</x-app-layout>
