<div>
    <form  wire:submit.prevent="submitForm">
        <div class="text-sm my-3">
            <label for="name" class="font-semibold">Name :</label>
            <input type="text" name="name" wire:model="name" required placeholder="MILANO SOYA" class="w-full rounded border-gray-300 @error('name') border-red-500 @enderror">
            @error('name') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <div class="text-sm my-3">
            <label for="description" class="font-semibold">Description:</label>
            <input type="text" name="description" wire:model="description" required placeholder="Shipment Description" class="w-full rounded border-gray-300 @error('description') border-red-500 @enderror">
            @error('description') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>
        
        <div class="text-sm my-3">
            <label for="max_volume" class="font-semibold">Max_Volume:</label>
            <input type="text" name="max_volume" wire:model="max_volume" required placeholder="100.55" class="w-full rounded border-gray-300 @error('max_volume') border-red-500 @enderror">
            @error('max_volume') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>
        <div class="text-sm my-3">
            <label for="max_weight" class="font-semibold">Max_Weight:</label>
            <input type="text" name="max_weight" wire:model="max_weight" required placeholder="100.55" class="w-full rounded border-gray-300 @error('max_weight') border-red-500 @enderror">
            @error('max_weight') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>
        

        <div class="text-sm my-3 text-right">
            <x-button-save class="ms-4">
                {{ __('Save') }}
            </x-button-save>
        </div>
        </form>
</div>
