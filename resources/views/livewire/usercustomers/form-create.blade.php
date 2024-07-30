<div>
    <form  wire:submit.prevent="submitForm">
        <div class="text-sm my-3">
            <label for="customer" class="font-semibold">Customer :</label>
            <div class="flex gap-2">
                <div class="w-full">
                <select name="customer" wire:model="customer" required class="w-full rounded border-gray-300 @error('customer') border-red-500 @enderror">
                    <option value="">-- choose option</option>
                    @foreach($selectCustomers as $cust)
                    <option value="{{$cust->id}}">{{$cust->code.' - '.$cust->name}}</option>
                    @endforeach
                </select>
                @error('customer') <span class="text-red-500">{{ $message }}</span> @enderror
                </div>
            </div>
        </div>

        <div class="text-sm my-3 text-right">
            <x-button-save class="ms-4">
                {{ __('Save') }}
            </x-button-save>
        </div>
        </form>
</div>
