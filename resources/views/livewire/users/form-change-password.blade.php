<div>
    <form  wire:submit.prevent="submitForm">

        <div class="text-sm my-3">
            <label for="password" class="font-semibold">Password :</label>
            <input type="password" name="password" wire:model="password" placeholder="Password" class="w-full rounded border-gray-300 @error('password') border-red-500 @enderror">
            @error('password') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>
        <div class="text-sm my-3">
            <label for="password" class="font-semibold">Confirm Password :</label>
            <input type="password" name="password_confirmation" wire:model="password_confirmation" placeholder="Password" class="w-full rounded border-gray-300 @error('password') border-red-500 @enderror">
            @error('password_confirmation') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>


        <div class="text-sm my-3 text-right">
            <x-button-save class="ms-4">
                {{ __('Save') }}
            </x-button-save>
        </div>
        </form>
</div>
