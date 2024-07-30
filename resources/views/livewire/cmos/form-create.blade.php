<div>
    <form  wire:submit.prevent="submitForm">
        
        <div class="text-sm my-3">
            <label for="customer" class="font-semibold">Customer :</label>
            <div class="flex gap-2">
                <div class="w-full">
                <select name="customer" wire:model="customer"  class="w-full rounded border-gray-300 @error('customer') border-red-500 @enderror">
                    <option value="">-- choose option</option>
                    @foreach($selectCustomers as $cust)
                    <option value="{{$cust->id}}">{{$cust->code.' - '.$cust->name}}</option>
                    @endforeach
                </select>
                @error('customer') <span class="text-red-500">{{ $message }}</span> @enderror
                </div>
            </div>
        </div>

        <h3 class="text-md font-semibold mt-2 py-2 border-t-2 border-gray-400">Sell Out (Comparison)</h3>
        <div class="grid gap-4 grid-cols-3">
            <div class="text-sm my-3">
                <label for="period_months" class="font-semibold">Period Month(s):</label>
                <input type="number" name="period_months" wire:model="period_months" required placeholder="3 (for last 3 months)" class="w-full rounded border-gray-300 @error('period_months') border-red-500 @enderror">
                @error('period_months') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>
        </div>


        <h3 class="text-md font-semibold mt-2 py-2 border-t-2 border-gray-400">Current Month</h3>
        <div class="grid gap-4 grid-cols-3">
            <div class="text-sm my-3">
                <label for="cut_off_date" class="font-semibold">Cut Off Date:</label>
                <input type="date" name="cut_off_date" wire:model="cut_off_date" required placeholder="JD0012" class="w-full rounded border-gray-300 @error('cut_off_date') border-red-500 @enderror">
                @error('cut_off_date') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>
            <div class="text-sm my-3">
                <label for="remaining_days" class="font-semibold">Remaining Working Day(s):</label>
                <input type="number" name="remaining_days" wire:model="remaining_days" required placeholder="15 (in days)" class="w-full rounded border-gray-300 @error('remaining_days') border-red-500 @enderror">
                @error('remaining_days') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>
        </div>



        <div class="text-sm my-3 text-right">
            <x-button-save class="ms-4">
                {{ __('Save') }}
            </x-button-save>
        </div>

        </form>
</div>
