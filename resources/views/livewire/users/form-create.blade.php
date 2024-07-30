<div>
    <form  wire:submit.prevent="submitForm">
        <div class="text-sm my-3">
            <label for="name" class="font-semibold">Name :</label>
            <input type="text" name="name" wire:model="name" required placeholder="John Doe" class="w-full rounded border-gray-300 @error('name') border-red-500 @enderror">
            @error('name') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <div class="text-sm my-3">
            <label for="email" class="font-semibold">Email :</label>
            <input type="email" name="email" wire:model="email" required placeholder="user@me.com" class="w-full rounded border-gray-300 @error('email') border-red-500 @enderror">
            @error('email') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>
        
        <div class="text-sm my-3">
            <label for="role" class="font-semibold">Role :</label>
            <select name="role" placeholder="user@me.com" wire:model="role" required class="w-full rounded border-gray-300 @error('role') border-red-500 @enderror">
                <option value=""></option>
                @foreach($selectRoles as $selectRole)
                <option value="{{$selectRole->name}}">{{$selectRole->name}}</option>
                @endforeach
            </select>
            @error('role') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <div class="text-sm my-3">
            <label for="password" class="font-semibold">Password :</label>
            <input type="text" name="password" wire:model="password" required placeholder="Password" class="w-full rounded border-gray-300 @error('password') border-red-500 @enderror">
            @error('password') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>


        <div class="text-sm my-3 text-right">
            <x-button-save class="ms-4">
                {{ __('Save') }}
            </x-button-save>
        </div>
        </form>
</div>
