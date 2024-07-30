<div>
    <form  wire:submit.prevent="submitForm">
        <h4 class="font-semibold border-y mt-5 py-3">Adjustment Form</h4>

        <div class="text-sm my-3">
            <label for="adj_left_current" class="font-semibold">Adj Est Sales Current Month:</label>
            <input type="number" name="adj_left_current" wire:model="adj_left_current" required placeholder="4 (in days)" class="w-full rounded border-gray-300 @error('adj_left_current') border-red-500 @enderror">
            @error('adj_left_current') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>
        <div class="text-sm my-3">
            <label for="adj_plan_sell_out_special" class="font-semibold">Adj Next Month:</label>
            <input type="number" name="adj_plan_sell_out_special" wire:model="adj_plan_sell_out_special" required placeholder="6 (in days)" class="w-full rounded border-gray-300 @error('adj_plan_sell_out_special') border-red-500 @enderror">
            @error('adj_plan_sell_out_special') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>
        <div class="text-sm my-3">
            <label for="adj_cmo_left" class="font-semibold">Adj Sisa CMO:</label>
            <input type="number" name="adj_cmo_left" wire:model="adj_cmo_left" required placeholder="6 (in days)" class="w-full rounded border-gray-300 @error('adj_cmo_left') border-red-500 @enderror">
            @error('adj_cmo_left') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>
        <div class="text-sm my-3">
            <label for="adj_cmo" class="font-semibold">Adj Kubikasi & Tonase:</label>
            <input type="number" name="adj_cmo" wire:model="adj_cmo" required placeholder="6 (in days)" class="w-full rounded border-gray-300 @error('adj_cmo') border-red-500 @enderror">
            @error('adj_cmo') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <div class="text-sm my-3 text-right">
            <x-button-save class="ms-4">
                {{ __('Save') }}
            </x-button-save>
        </div>
        </form>
</div>
