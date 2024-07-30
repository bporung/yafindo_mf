<div>
<div class="p-4 border rounded">
    <div class="text-sm my-3">
        <label for="customer" class="font-semibold">Customer :</label>
        <div class="flex gap-2">
            <div class="w-full">
            <select name="customer" wire:model="customer"  required class="w-full rounded border-gray-300 @error('customer') border-red-500 @enderror">
                <option value="">-- choose option</option>
                @foreach($selectCustomers as $cust)
                <option value="{{$cust->id}}">{{$cust->code.' - '.$cust->name}}</option>
                @endforeach
            </select>
            @error('customer') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>
        </div>
    </div>
    <div class="w-1/2 grid grid-cols-2 gap-4">
        <div class="flex flex-wrap">
            <label for="start_date" class="font-semibold">Start Date :</label>
            <input type="date" wire:model="start_date" class="w-full rounded border-gray-300">
        </div>
        <div class="flex flex-wrap">
            <label for="start_date" class="font-semibold">End Date :</label>
            <input type="date" wire:model="end_date" class="w-full rounded border-gray-300">
        </div>
    </div>
    <div class="flex justify-end">
        <button type="button" wire:click="runSearch()" class="flex space-x-1 items-center py-2 px-3 border bg-gray-300">
        <svg xmlns="http://www.w3.org/2000/svg" class="fill-black h-4 w-4" viewBox="0 0 512 512"><path d="M416 208c0 45.9-14.9 88.3-40 122.7L502.6 457.4c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L330.7 376c-34.4 25.2-76.8 40-122.7 40C93.1 416 0 322.9 0 208S93.1 0 208 0S416 93.1 416 208zM208 352a144 144 0 1 0 0-288 144 144 0 1 0 0 288z"/></svg>
            Search
        </button>
    </div>
</div>

<div class="shadow-md  my-6  overflow-x-auto">
    <table class="min-w-full w-auto">
        <thead>
            <tr class="bg-gray-600 text-white uppercase font-light text-sm">
                <th class="py-2 px-3 text-left">Product Code</th>
                <th class="py-2 px-3 text-left">Product Name</th>
                <th class="py-2 px-3 text-right">Qty</th>
                <th class="py-2 px-3 text-left">UOM</th>
                <th class="py-2 px-3 text-left"></th>
            </tr>
        </thead>
        <tbody class="text-black text-xs font-light">
            @foreach ($datas as $user)
                <tr class="border border-gray-200 hover:bg-gray-100">
                    <td class="py-2 px-3 text-left">{{ $user->product_code }}</td>
                    <td class="py-2 px-3 text-left">{{ $user->product_nickname }}<br>{{ $user->product_name }}</td>
                    <td class="py-2 bg-gray-100 px-3 text-right">{{ number_format($user->sum_qty,2) }}</td>
                    <td class="py-2 px-3 text-left">{{ $user->uom }}</td>
                    <td class="py-2 px-3 text-left">
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

</div>
