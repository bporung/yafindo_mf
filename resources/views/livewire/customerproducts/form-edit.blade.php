<div>
    <form  wire:submit.prevent="submitForm">
        <div class="text-sm my-3">
            <label for="name" class="font-semibold">Product Name :</label>
            <input type="text" name="name" value="{{$product['name']}}" disabled placeholder="Product Name" class="w-full rounded border-gray-300 @error('name') border-red-500 @enderror">
        </div>
        <div class="text-sm my-3">
            <label for="name" class="font-semibold">Product Category :</label>
            <input type="text" name="name" value="{{$product['category']}}" disabled placeholder="Product Category" class="w-full rounded border-gray-300 @error('name') border-red-500 @enderror">
        </div>
        <div class="text-sm my-3">
            <label for="name" class="font-semibold">Product Brand :</label>
            <input type="text" name="name" value="{{$product['brand']}}" disabled placeholder="Product Brand" class="w-full rounded border-gray-300 @error('name') border-red-500 @enderror">
        </div>
        <div class="text-sm my-3">
            <label for="name" class="font-semibold">Product Code :</label>
            <input type="text" name="name" value="{{$product['code']}}" disabled placeholder="Product Code" class="w-full rounded border-gray-300 @error('name') border-red-500 @enderror">
        </div>

        <h4 class="font-semibold border-y mt-5 py-3">Product Customer Form</h4>
        <div class="text-sm my-3">
            <label for="code" class="font-semibold">Code (unique):</label>
            <input type="text" name="code" wire:model="code" required placeholder="C00001" class="w-full rounded border-gray-300 @error('code') border-red-500 @enderror">
            @error('code') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>
        
        @can('manage all')
        <div class="text-sm my-3">
            <label for="target" class="font-semibold">Target :</label>
            <input type="text" name="target" wire:model="target" required placeholder="200 (in default/first uom)" class="w-full rounded border-gray-300 @error('target') border-red-500 @enderror">
            @error('target') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <div class="text-sm my-3">
            <label for="lead_time" class="font-semibold">Lead Time:</label>
            <input type="number" name="lead_time" wire:model="lead_time" required placeholder="4 (in days)" class="w-full rounded border-gray-300 @error('lead_time') border-red-500 @enderror">
            @error('lead_time') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>
        <div class="text-sm my-3">
            <label for="buffer_time" class="font-semibold">Buffer Time:</label>
            <input type="number" name="buffer_time" wire:model="buffer_time" required placeholder="6 (in days)" class="w-full rounded border-gray-300 @error('buffer_time') border-red-500 @enderror">
            @error('buffer_time') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>
        
        <div class="text-sm my-3">
            <label for="shipment" class="font-semibold">Shipment :</label>
            <select name="shipment" placeholder="user@me.com" wire:model="shipment" required class="w-full rounded border-gray-300 @error('shipment') border-red-500 @enderror">
                <option value="">-- choose option</option>
                @foreach($selectShipments as $shipment)
                <option value="{{$shipment->id}}">{{$shipment->id.' - '.$shipment->name}}</option>
                @endforeach
            </select>
            @error('shipment') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        
        <div class="text-sm my-3">
            <label for="margin" class="font-semibold">Margin :</label>
            <input type="text" name="margin" wire:model="margin" required placeholder="9 (in percent)" class="w-full rounded border-gray-300 @error('margin') border-red-500 @enderror">
            @error('margin') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        
        <div class="text-sm my-3">
            <label for="margin_2" class="font-semibold">Margin 2 :</label>
            <input type="text" name="margin_2" wire:model="margin_2" required placeholder="1 (in percent)" class="w-full rounded border-gray-300 @error('margin_2') border-red-500 @enderror">
            @error('margin_2') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>
        @endcan
        
        <div class="text-sm my-3 text-right">
            <x-button-save class="ms-4">
                {{ __('Save') }}
            </x-button-save>
        </div>
        </form>
</div>
