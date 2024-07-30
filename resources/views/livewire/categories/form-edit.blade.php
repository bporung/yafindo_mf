<div>
    <form  wire:submit.prevent="submitForm">
        <div class="text-sm my-3">
            <label for="name" class="font-semibold">Name :</label>
            <input type="text" name="name" wire:model="name" required placeholder="BEVERAGE" class="w-full rounded border-gray-300 @error('name') border-red-500 @enderror">
            @error('name') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <div class="text-sm my-3">
            <label for="code" class="font-semibold">Code (unique):</label>
            <input type="text" name="code" wire:model="code" required placeholder="G200001" class="w-full rounded border-gray-300 @error('code') border-red-500 @enderror">
            @error('code') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>
        

        <div class="text-sm my-3 text-right">
            <x-button-save class="ms-4">
                {{ __('Save') }}
            </x-button-save>
        </div>
        </form>
</div>
