<div>
    <form  wire:submit.prevent="submitForm">
        <div class="text-sm my-3">
            <label for="name" class="font-semibold">Name :</label>
            <input type="text" name="name" wire:model="name" required placeholder="CDDL-Bekasi-Tangerang" class="w-full rounded border-gray-300 @error('name') border-red-500 @enderror">
            @error('name') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>
        <div class="text-sm my-3">
            <label for="origin" class="font-semibold">Origin :</label>
            <input type="text" name="origin" wire:model="origin" required placeholder="Bekasi" class="w-full rounded border-gray-300 @error('origin') border-red-500 @enderror">
            @error('origin') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>
        <div class="text-sm my-3">
            <label for="destination" class="font-semibold">Destination :</label>
            <input type="text" name="destination" wire:model="destination" required placeholder="Tangerang" class="w-full rounded border-gray-300 @error('destination') border-red-500 @enderror">
            @error('destination') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>
        <div class="text-sm my-3">
            <label for="price" class="font-semibold">Price :</label>
            <input type="number" name="price" wire:model="price" required placeholder="5000000" class="w-full rounded border-gray-300 @error('price') border-red-500 @enderror">
            @error('price') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>
        

        <div class="text-sm my-3 text-right">
            <x-button-save class="ms-4">
                {{ __('Save') }}
            </x-button-save>
        </div>
        </form>
</div>
