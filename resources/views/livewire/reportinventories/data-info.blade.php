<div>
    @can('manage reportinventorylevel')
    @if(!$data->isPublished)
    <div class="w-full flex justify-end text-right">
        <button wire:click="deleteData" wire:confirm.prompt="Are you sure?\n\nType OK to confirm|OK"  wire:loading.attr="disabled" type="button" class="bg-red-500 px-3 py-1 rounded text-white font-semibold flex items-center justify-center gap-1">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 fill-white" viewBox="0 0 448 512"><path d="M135.2 17.7L128 32 32 32C14.3 32 0 46.3 0 64S14.3 96 32 96l384 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l-96 0-7.2-14.3C307.4 6.8 296.3 0 284.2 0L163.8 0c-12.1 0-23.2 6.8-28.6 17.7zM416 128L32 128 53.2 467c1.6 25.3 22.6 45 47.9 45l245.8 0c25.3 0 46.3-19.7 47.9-45L416 128z"/></svg>
            Delete
        </button>
    </div>
    @endif
    @endcan
    <table>
        <tr>
            <td class="w-24 py-1"><label for="name" class="font-semibold">Customer</label></td>
            <td><span>{{ $data->customer ? $data->customer->code.' - '.$data->customer->name : '-' }}</span></td>
        </tr>
        <tr>
            <td class="w-24 py-1"><label for="name" class="font-semibold">Created At</label></td>
            <td><span>{{ $data->created_at ? $data->created_at->format('d-m-Y H:i:s') : '-' }}</span></td>
        </tr>
        <tr>
            <td class="w-24 py-1"><label for="name" class="font-semibold">File Name</label></td>
            <td><span>{{ $data->file_name }}</span></td>
        </tr>
        <tr>
            <td class="w-24 py-1"><label for="name" class="font-semibold">is Published</label></td>
            <td>
                <span>
                @if($data->isPublished)
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 fill-green-500" viewBox="0 0 512 512"><path d="M288 109.3V352c0 17.7-14.3 32-32 32s-32-14.3-32-32V109.3l-73.4 73.4c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3l128-128c12.5-12.5 32.8-12.5 45.3 0l128 128c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L288 109.3zM64 352H192c0 35.3 28.7 64 64 64s64-28.7 64-64H448c35.3 0 64 28.7 64 64v32c0 35.3-28.7 64-64 64H64c-35.3 0-64-28.7-64-64V416c0-35.3 28.7-64 64-64zM432 456a24 24 0 1 0 0-48 24 24 0 1 0 0 48z"/></svg>
                @else
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 fill-gray-400" viewBox="0 0 512 512"><path d="M288 109.3V352c0 17.7-14.3 32-32 32s-32-14.3-32-32V109.3l-73.4 73.4c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3l128-128c12.5-12.5 32.8-12.5 45.3 0l128 128c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L288 109.3zM64 352H192c0 35.3 28.7 64 64 64s64-28.7 64-64H448c35.3 0 64 28.7 64 64v32c0 35.3-28.7 64-64 64H64c-35.3 0-64-28.7-64-64V416c0-35.3 28.7-64 64-64zM432 456a24 24 0 1 0 0-48 24 24 0 1 0 0 48z"/></svg>
                @endif
                </span>
            </td>
        </tr>
    </table>

    @if($data->isPublished == '0')
    <div class="text-right">
    <button class="px-3 py-2 bg-green-500 rounded font-semibold" wire:click="publishReport" wire:confirm.prompt="Are you sure?\n\nType PUBLISH to confirm|PUBLISH">
        <span class="flex">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 fill-gray-500" viewBox="0 0 512 512"><path d="M288 109.3V352c0 17.7-14.3 32-32 32s-32-14.3-32-32V109.3l-73.4 73.4c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3l128-128c12.5-12.5 32.8-12.5 45.3 0l128 128c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L288 109.3zM64 352H192c0 35.3 28.7 64 64 64s64-28.7 64-64H448c35.3 0 64 28.7 64 64v32c0 35.3-28.7 64-64 64H64c-35.3 0-64-28.7-64-64V416c0-35.3 28.7-64 64-64zM432 456a24 24 0 1 0 0-48 24 24 0 1 0 0 48z"/></svg> 
            Publish
        </span>
    </button>
    </div>
    @endif

    <h4 class="py-3 my-3 border-y font-semibold">Report Details</h4>
    <div class="shadow-md  my-6  overflow-x-auto">
        <table class="min-w-full w-auto">
            <thead>
                <tr class="bg-gray-600 text-white uppercase font-light text-sm">
                    <th class="py-2 px-3 text-left">Date</th>
                    <th class="py-2 px-3 text-left">Product</th>
                    <th class="py-2 px-3 text-left">Customer Product (File)</th>
                    <th class="py-2 px-3 text-left">Qty (File)</th>
                    <th class="py-2 px-3 text-left">UOM (File)</th>
                    <th class="py-2 px-3 text-left">Conversion UOM</th>
                    <th class="py-2 px-3 text-left">Conversion Qty</th>
                </tr>
            </thead>
            <tbody class="text-black text-xs font-light">
                @foreach ($data->details as $user)
                    <tr class="border border-gray-200 hover:bg-gray-100">
                        <td class="py-2 px-3 text-left whitespace-nowrap">{{ $user->date }}</td>
                        <td class="py-2 px-3 text-left">{{ $user->product ? $user->product->code.' - '.$user->product->name : '-' }}</td>
                        <td class="py-2 px-3 text-left">{{ $user->customer_product_id }}</td>
                        <td class="py-2 px-3 text-left">{{ $user->qty }}</td>
                        <td class="py-2 px-3 text-left">{{ strtoupper($user->uom) }}</td>
                        <td class="py-2 px-3 text-left">{{ $user->conversion_uom && $user->c_uom ? $user->c_uom->code : '?' }}</td>
                        <td class="py-2 px-3 text-left">{{ $user->conversion_qty ? $user->conversion_qty : '?' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>
