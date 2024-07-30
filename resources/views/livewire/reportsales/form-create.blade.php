<div>
    <form  wire:submit.prevent="submitForm">
        
        <div class="text-sm my-3">
            <label for="customer" class="font-semibold">Customer :</label>
            <div class="flex gap-2">
                <div class="w-full">
                <select name="customer" wire:model="customer" @if($lockCustomer) disabled @endif required class="w-full rounded border-gray-300 @error('customer') border-red-500 @enderror">
                    <option value="">-- choose option</option>
                    @foreach($selectCustomers as $cust)
                    <option value="{{$cust->id}}">{{$cust->code.' - '.$cust->name}}</option>
                    @endforeach
                </select>
                @error('customer') <span class="text-red-500">{{ $message }}</span> @enderror
                </div>
            <button class="w-24 {{$lockCustomer ? 'bg-gray-500' : 'bg-gray-200'}} rounded" type="button" wire:click="runLockCustomer">
                @if($lockCustomer)
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-4 fill-gray-200 mx-auto" viewBox="0 0 448 512"><path d="M144 144v48H304V144c0-44.2-35.8-80-80-80s-80 35.8-80 80zM80 192V144C80 64.5 144.5 0 224 0s144 64.5 144 144v48h16c35.3 0 64 28.7 64 64V448c0 35.3-28.7 64-64 64H64c-35.3 0-64-28.7-64-64V256c0-35.3 28.7-64 64-64H80z"/></svg>
                @else
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-4 fill-gray-400 mx-auto" viewBox="0 0 576 512"><path d="M352 144c0-44.2 35.8-80 80-80s80 35.8 80 80v48c0 17.7 14.3 32 32 32s32-14.3 32-32V144C576 64.5 511.5 0 432 0S288 64.5 288 144v48H64c-35.3 0-64 28.7-64 64V448c0 35.3 28.7 64 64 64H384c35.3 0 64-28.7 64-64V256c0-35.3-28.7-64-64-64H352V144z"/></svg>
                @endif
            </button>
            </div>
        </div>

        @if($lockCustomer)
        <div class="text-sm my-3">
            <p class="font-light">The file's format must be 'csv' and the delimiter must be ';'.</p>
            <p>Format : tanggal;no_invoice;kode produk;nama produk;qty;uom;amount;kode salesman;nama salesman;kode toko;nama toko.<a class="px-2 text-blue-400" href="/storage/sample-file/sample file - report sales.zip">Download Sample File</a></p>
            <label for="filereport" class="font-semibold">File Report :</label>
            <input type="file"  accept=".csv" placeholder="CSV File Report..." id="filereport" wire:model="filereport" class="w-full rounded border-gray-300 @error('filereport') border-red-500 @enderror">
            @error('filereport') <span class="text-red-500">{{ $message }}</span> @enderror
            <div wire:loading wire:target="filereport">
                <span class="text-blue-500">Previewing...</span>
            </div>

            @if (!empty($results))
                <h4 class="font-semibold py-3 my-3 border-y">Preview Result</h4>
                <table class="table-auto w-full mt-3">
                    <thead>
                        <tr>
                            @foreach ($results[0] as $header)
                                <th class="px-4 py-2">{{ $header['value'] }}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @foreach (array_slice($results, 1) as $row)
                            <tr>
                                @foreach ($row as $cell)
                                    <td class="border px-4 py-2">
                                        <div class="flex space-x-2">
                                        <span>{{ $cell['value'] }}</span>
                                        @if($cell['isValid'])
                                        <span><svg xmlns="http://www.w3.org/2000/svg" class="fill-green-500 h-4 w-4" viewBox="0 0 448 512"><path d="M438.6 105.4c12.5 12.5 12.5 32.8 0 45.3l-256 256c-12.5 12.5-32.8 12.5-45.3 0l-128-128c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0L160 338.7 393.4 105.4c12.5-12.5 32.8-12.5 45.3 0z"/></svg></span>
                                        @else
                                        <span><svg xmlns="http://www.w3.org/2000/svg" class="fill-red-500 h-4 w-4" viewBox="0 0 512 512"><path d="M256 48a208 208 0 1 1 0 416 208 208 0 1 1 0-416zm0 464A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM175 175c-9.4 9.4-9.4 24.6 0 33.9l47 47-47 47c-9.4 9.4-9.4 24.6 0 33.9s24.6 9.4 33.9 0l47-47 47 47c9.4 9.4 24.6 9.4 33.9 0s9.4-24.6 0-33.9l-47-47 47-47c9.4-9.4 9.4-24.6 0-33.9s-24.6-9.4-33.9 0l-47 47-47-47c-9.4-9.4-24.6-9.4-33.9 0z"/></svg></span>
                                        @endif
                                        </div>
                                    </td>
                                @endforeach
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>

        <div class="text-sm my-3 text-right">
            <x-button-save class="ms-4">
                {{ __('Save') }}
            </x-button-save>
        </div>
        @endif
        </form>
</div>
