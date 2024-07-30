<div>
    <form  wire:submit.prevent="submitForm">
        
        <div class="text-sm my-3">
            <label for="brand" class="font-semibold">Brand :</label>
            <select name="brand" placeholder="user@me.com" wire:model="brand" required class="w-full rounded border-gray-300 @error('brand') border-red-500 @enderror">
                <option value="">-- choose option</option>
                @foreach($selectBrands as $brand)
                <option value="{{$brand->id}}">{{$brand->code.' - '.$brand->name}}</option>
                @endforeach
            </select>
            @error('brand') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>
        
        <div class="text-sm my-3">
            <label for="category" class="font-semibold">Category :</label>
            <select name="category" placeholder="user@me.com" wire:model="category" required class="w-full rounded border-gray-300 @error('category') border-red-500 @enderror">
                <option value="">-- choose option</option>
                @foreach($selectCategories as $cat)
                <option value="{{$cat->id}}">{{$cat->code.' - '.$cat->name}}</option>
                @endforeach
            </select>
            @error('category') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <div class="text-sm my-3">
            <label for="code" class="font-semibold">Code (unique):</label>
            <input type="text" name="code" wire:model="code" required placeholder="100001" class="w-full rounded border-gray-300 @error('code') border-red-500 @enderror">
            @error('code') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <div class="text-sm my-3">
            <label for="name" class="font-semibold">Name :</label>
            <input type="text" name="name" wire:model="name" required placeholder="YMPD MILANO SOYA BEAN MILK (24X320ML)" class="w-full rounded border-gray-300 @error('name') border-red-500 @enderror">
            @error('name') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>
        <div class="text-sm my-3">
            <label for="nickname" class="font-semibold">Nickname:</label>
            <input type="text" name="nickname" wire:model="nickname" required placeholder="SOY-320" class="w-full rounded border-gray-300 @error('nickname') border-red-500 @enderror">
            @error('nickname') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <div class="text-sm my-3">
            <label for="varian" class="font-semibold">Varian :</label>
            <input type="text" name="varian" wire:model="varian" required placeholder="ORIGINAL" class="w-full rounded border-gray-300 @error('varian') border-red-500 @enderror">
            @error('varian') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <div class="text-sm my-3">
            <label for="description" class="font-semibold">Description :</label>
            <input type="text" name="description" wire:model="description" required placeholder="" class="w-full rounded border-gray-300 @error('description') border-red-500 @enderror">
            @error('description') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>


        <h4 class="font-semibold border-b mt-5">Dimension / Cubication</h4>
        <div class="text-sm my-3 grid grid-cols-2 sm:grid-cols-6 gap-4 items-end">
            <div class="w-full">
                <label for="width" class="font-semibold">Width :</label>
                <input type="text" name="width" wire:model="width" required placeholder="2.2 (in meter)" class="w-full rounded border-gray-300 @error('width') border-red-500 @enderror">
                @error('width') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>
            <div class="w-full">
                <label for="height" class="font-semibold">Height :</label>
                <input type="text" name="height" wire:model="height" required placeholder="2.3 (in meter)" class="w-full rounded border-gray-300 @error('height') border-red-500 @enderror">
                @error('height') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>
            <div class="w-full">
                <label for="depth" class="font-semibold">Depth :</label>
                <input type="text" name="depth" wire:model="depth" required placeholder="2.5 (in meter)" class="w-full rounded border-gray-300 @error('depth') border-red-500 @enderror">
                @error('depth') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>
            <div class="w-full">
                <label for="weight" class="font-semibold">Weight :</label>
                <input type="text" name="weight" wire:model="weight" required placeholder="2.4 (in kg)" class="w-full rounded border-gray-300 @error('weight') border-red-500 @enderror">
                @error('weight') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>
        </div>

        
        <h4 class="font-semibold border-b mt-5">UOM</h4>
        <div class="text-sm my-3 grid grid-cols-2 sm:grid-cols-5 gap-4 items-end">
            <div class="w-full">
                <label for="first_uom" class="font-semibold">First_UOM :</label>
                <select name="first_uom" wire:model="first_uom" required class="w-full rounded border-gray-300 @error('first_uom') border-red-500 @enderror">
                    <option value="">-- choose option</option>
                    @foreach($selectUoms as $uom)
                    <option value="{{$uom->id}}">{{$uom->code}}</option>
                    @endforeach
                </select>
                @error('first_uom') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>
            <div class="w-full">
                <label for="second_uom" class="font-semibold">Second_UOM :</label>
                <select name="second_uom" wire:model="second_uom" required class="w-full rounded border-gray-300 @error('second_uom') border-red-500 @enderror">
                    <option value="">-- choose option</option>
                    @foreach($selectUoms as $uom)
                    <option value="{{$uom->id}}">{{$uom->code}}</option>
                    @endforeach
                </select>
                @error('second_uom') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>
            <div class="w-full">
                <label for="third_uom" class="font-semibold">Third_UOM :</label>
                <select name="third_uom" wire:model="third_uom" required class="w-full rounded border-gray-300 @error('third_uom') border-red-500 @enderror">
                    <option value="">-- choose option</option>
                    @foreach($selectUoms as $uom)
                    <option value="{{$uom->id}}">{{$uom->code}}</option>
                    @endforeach
                </select>
                @error('third_uom') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>
            <div class="w-full">
                <label for="fourth_uom" class="font-semibold">Fourth_UOM :</label>
                <select name="fourth_uom" wire:model="fourth_uom" required class="w-full rounded border-gray-300 @error('fourth_uom') border-red-500 @enderror">
                    <option value="">-- choose option</option>
                    @foreach($selectUoms as $uom)
                    <option value="{{$uom->id}}">{{$uom->code}}</option>
                    @endforeach
                </select>
                @error('fourth_uom') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>
        </div>

        
        <h4 class="font-semibold border-b mt-5">UOM Convertion</h4>
        <div class="text-sm my-3 grid grid-cols-2 sm:grid-cols-5 gap-4 items-end">
            <div class="w-full">
                <label for="convert_first_to_fourth" class="font-semibold">First to Fourth :</label>
                <input type="text" name="convert_first_to_fourth" wire:model="convert_first_to_fourth" required placeholder="24" class="w-full rounded border-gray-300 @error('convert_first_to_fourth') border-red-500 @enderror">
                @error('convert_first_to_fourth') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>
            <div class="w-full">
                <label for="convert_second_to_fourth" class="font-semibold">Second to Fourth :</label>
                <input type="text" name="convert_second_to_fourth" wire:model="convert_second_to_fourth" required placeholder="12" class="w-full rounded border-gray-300 @error('convert_second_to_fourth') border-red-500 @enderror">
                @error('convert_second_to_fourth') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>
            <div class="w-full">
                <label for="convert_third_to_fourth" class="font-semibold">Third to Fourth :</label>
                <input type="text" name="convert_third_to_fourth" wire:model="convert_third_to_fourth" required placeholder="6" class="w-full rounded border-gray-300 @error('convert_third_to_fourth') border-red-500 @enderror">
                @error('convert_third_to_fourth') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>
        </div>



        <div class="text-sm my-3 text-right">
            <x-button-save class="ms-4">
                {{ __('Save') }}
            </x-button-save>
        </div>
        </form>
</div>
