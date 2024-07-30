<div>
    <form  wire:submit.prevent="submitForm">
        <div class="text-sm my-3">
            <label for="name" class="font-semibold">Name :</label>
            <input type="text" name="name" wire:model="name" required placeholder="John Doe" class="w-full rounded border-gray-300 @error('name') border-red-500 @enderror">
            @error('name') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <div class="text-sm my-3">
            <label for="code" class="font-semibold">Code (unique):</label>
            <input type="text" name="code" wire:model="code" required placeholder="JD0012" class="w-full rounded border-gray-300 @error('code') border-red-500 @enderror">
            @error('code') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <div class="text-sm my-3">
            <label for="nickname" class="font-semibold">Nickname:</label>
            <input type="text" name="nickname" wire:model="nickname" required placeholder="JDoe" class="w-full rounded border-gray-300 @error('nickname') border-red-500 @enderror">
            @error('nickname') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <div class="text-sm my-3">
            <label for="description" class="font-semibold">Description :</label>
            <input type="text" name="description" wire:model="description" placeholder="Description For Customer" class="w-full rounded border-gray-300 @error('description') border-red-500 @enderror">
            @error('description') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>
        <div class="text-sm my-3">
            <label for="address" class="font-semibold">Address :</label>
            <input type="text" name="address" wire:model="address" placeholder="Customer Address" class="w-full rounded border-gray-300 @error('address') border-red-500 @enderror">
            @error('address') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>
        
        <div class="text-sm my-3">
            <label for="lead_time" class="font-semibold">Lead Time (default):</label>
            <input type="number" name="lead_time" wire:model="lead_time" required placeholder="4 (in days)" class="w-full rounded border-gray-300 @error('lead_time') border-red-500 @enderror">
            @error('lead_time') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>
        <div class="text-sm my-3">
            <label for="buffer_time" class="font-semibold">Buffer Time (default):</label>
            <input type="number" name="buffer_time" wire:model="buffer_time" required placeholder="6 (in days)" class="w-full rounded border-gray-300 @error('buffer_time') border-red-500 @enderror">
            @error('buffer_time') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <div class="text-sm my-3">
            <label for="sell_zone" class="font-semibold">Zone (sell):</label>
            <select name="sell_zone" wire:model="sell_zone" required class="w-full rounded border-gray-300 @error('sell_zone') border-red-500 @enderror">
                <option value="">-- choose option</option>
                @foreach($selectZones as $zone)
                @php if($zone->type == '2'){continue;} @endphp
                <option value="{{$zone->id}}">{{$zone->id.' - '.$zone->name}}</option>
                @endforeach
            </select>
            @error('sell_zone') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <div class="text-sm my-3">
            <label for="shipment" class="font-semibold">Shipment (Default) :</label>
            <select name="shipment" placeholder="user@me.com" wire:model="shipment" required class="w-full rounded border-gray-300 @error('shipment') border-red-500 @enderror">
                <option value="">-- choose option</option>
                @foreach($selectShipments as $shipment)
                <option value="{{$shipment->id}}">{{$shipment->id.' - '.$shipment->name}}</option>
                @endforeach
            </select>
            @error('shipment') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <div class="text-sm my-3 text-right">
            <x-button-save class="ms-4">
                {{ __('Save') }}
            </x-button-save>
        </div>
        </form>
</div>
