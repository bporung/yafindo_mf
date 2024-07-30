<div>
    <form  wire:submit.prevent="submitForm">
        <div class="text-sm my-3">
            <label for="price_inc" class="font-semibold">Price (inc) :</label>
            <input type="text" name="price_inc" wire:model="price_inc" required placeholder="Price include Ppn" class="w-full rounded border-gray-300 @error('price_inc') border-red-500 @enderror">
            @error('price_inc') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>
        <div class="text-sm my-3">
            <label for="price_exc" class="font-semibold">Price (exc) :</label>
            <input type="text" name="price_exc" wire:model="price_exc" required placeholder="Price exclude Ppn" class="w-full rounded border-gray-300 @error('price_exc') border-red-500 @enderror">
            @error('price_exc') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>
        

        <div class="text-sm my-3 text-right">
            <x-button-save class="ms-4">
                {{ __('Save') }}
            </x-button-save>
        </div>
        </form>
</div>
