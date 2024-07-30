<div>
<div class="p-4 border rounded">
    <div class="text-sm my-3">
        <label for="customer" class="font-semibold">Customer :</label>
        <div class="flex gap-2">
            <div class="w-full">
            <select name="customer" wire:model="customer"  required class="w-full rounded border-gray-300 @error('customer') border-red-500 @enderror">
                <option value="">--all customer</option>
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
    <table class="min-w-full text-xs w-auto">
        <thead>
            <tr class="bg-gray-600 text-white uppercase font-light text-xs">
                <th class="py-2 px-1 text-left">Day</th>
                <th class="py-2 px-1 text-left">Date</th>
                @foreach($resCustomers as $res)
                <th class="py-2 px-3 text-center">{{$res->code}}<br>{{$res->nickname}}</th>
                @endforeach
            </tr>
        </thead>
        <tbody class="text-black text-xs font-light">
            
            @foreach ($periods as $prKey => $pr)
                <tr class="border border-gray-200 hover:bg-gray-100">
                    <td class="py-2 px-3 text-left">{{ $pr['day_name'] }}</td>
                    <td class="py-2 px-3 text-left">{{ $prKey }}</td>
                    
                    @foreach($resCustomers as $r)
                        @php 
                        $y = 0;
                                if(isset($datas[$prKey][$r->id])){
                                    $y = 1;
                                }
                        @endphp
                    <td class="py-2 px-3 text-center justify-center items-center">
                        @if($y == 1)
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="h-5 w-5 mx-auto fill-green-500"><path d="M342.6 86.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L160 178.7l-57.4-57.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l80 80c12.5 12.5 32.8 12.5 45.3 0l160-160zm96 128c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L160 402.7 54.6 297.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l128 128c12.5 12.5 32.8 12.5 45.3 0l256-256z"/></svg>
                        @else 
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="h-5 w-5 mx-auto fill-red-500"><path d="M64 32C28.7 32 0 60.7 0 96V416c0 35.3 28.7 64 64 64H384c35.3 0 64-28.7 64-64V96c0-35.3-28.7-64-64-64H64zm79 143c9.4-9.4 24.6-9.4 33.9 0l47 47 47-47c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9l-47 47 47 47c9.4 9.4 9.4 24.6 0 33.9s-24.6 9.4-33.9 0l-47-47-47 47c-9.4 9.4-24.6 9.4-33.9 0s-9.4-24.6 0-33.9l47-47-47-47c-9.4-9.4-9.4-24.6 0-33.9z"/></svg>
                        @endif
                    </td>
                    @endforeach
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

</div>
