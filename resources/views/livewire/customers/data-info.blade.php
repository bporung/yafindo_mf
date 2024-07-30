<div>
    @can('manage customer')
    <div class="w-full flex justify-end text-right">
        <button wire:click="deleteData" wire:confirm.prompt="Are you sure?\n\nType OK to confirm|OK"  wire:loading.attr="disabled" type="button" class="bg-red-500 px-3 py-1 rounded text-white font-semibold flex items-center justify-center gap-1">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 fill-white" viewBox="0 0 448 512"><path d="M135.2 17.7L128 32 32 32C14.3 32 0 46.3 0 64S14.3 96 32 96l384 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l-96 0-7.2-14.3C307.4 6.8 296.3 0 284.2 0L163.8 0c-12.1 0-23.2 6.8-28.6 17.7zM416 128L32 128 53.2 467c1.6 25.3 22.6 45 47.9 45l245.8 0c25.3 0 46.3-19.7 47.9-45L416 128z"/></svg>
            Delete
        </button>
    </div>
    @endcan
    <table>
        <tr>
            <td class="w-32 py-1"><label for="name" class="font-semibold">Name</label></td>
            <td><span>{{$data->name}}</span></td>
        </tr>
        <tr>
            <td class="w-32 py-1"><label for="name" class="font-semibold">Nickname</label></td>
            <td><span>{{$data->nickname}}</span></td>
        </tr>
        <tr>
            <td class="w-32 py-1"><label for="name" class="font-semibold">Code</label></td>
            <td><span>{{$data->code}}</span></td>
        </tr>
        <tr>
            <td class="w-32 py-1"><label for="name" class="font-semibold">Description</label></td>
            <td><span>{{$data->description}}</span></td>
        </tr>
        <tr>
            <td class="w-32 py-1"><label for="name" class="font-semibold">Address</label></td>
            <td><span>{{$data->address}}</span></td>
        </tr>
        <tr>
            <td class="w-32 py-1"><label for="name" class="font-semibold">Lead Time</label></td>
            <td><span>{{$data->lead_time}}</span></td>
        </tr>
        <tr>
            <td class="w-32 py-1"><label for="name" class="font-semibold">Buffer Time</label></td>
            <td><span>{{$data->buffer_time}}</span></td>
        </tr>
        <tr>
            <td class="w-32 py-1"><label for="name" class="font-semibold">Default Shipment</label></td>
            <td><span>{{ $data->shipmentdetail ? $data->shipmentdetail->id.'-'.$data->shipmentdetail->name : '' }}</span></td>
        </tr>
        <tr>
            <td class="w-32 py-1"><label for="name" class="font-semibold">Zone</label></td>
            <td><span>{{ $data->sell_zone ? $data->sell_zone->id.'-'.$data->sell_zone->name : '' }}</span></td>
        </tr>
        <tr>
            <td class="w-32 py-1"><label for="name" class="font-semibold">Active Status</label></td>
            <td><span>{{$data->isActive ? 'Active' : 'InActive'}}</span></td>
        </tr>
    </table>

    <h4 class="font-semibold border-y mt-5 py-3">Products (Customer)</h4>
    <div class="shadow-md  my-6  overflow-x-auto">
    <table class="min-w-full w-auto">
        <thead>
            <tr class="bg-gray-600 text-white uppercase font-light text-sm">
                <th class="py-2 px-3 text-left">Code(Master)</th>
                <th class="py-2 px-3 text-left">Product</th>
                <th class="py-2 px-3 text-left">Code(Customer)</th>
                <th class="py-2 px-3 text-left">UOM</th>
                <th colspan="4" class="py-2 px-3 text-center">Stock(Customer)</th>
                <th class="py-2 px-3 text-left">Last Update Stock</th>
                <th class="py-2 px-3 text-left">Target<br>(Customer)</th>
                <th class="py-2 px-3 text-left">LeadTime/BufferTime</th>
                @can('read margin')
                <th class="py-2 px-3 text-left">Margin</th>
                @endcan
                <th class="py-2 px-3 text-left">Shipment</th>
                <th class="py-2 px-3 text-center">Status</th>
                <th class="py-2 px-3 text-center"></th>
            </tr>
        </thead>
        <tbody class="text-black text-xs font-light">
            @foreach ($data->customerproducts as $pr)
                <tr class="border border-gray-200 hover:bg-gray-100">
                    <td class="py-2 px-3 text-left whitespace-nowrap">{{ $pr->product ? $pr->product->code : '-' }}</td>
                    <td class="py-2 px-3 bg-gray-200 text-left">{{ $pr->product ? $pr->product->nickname : '-'}}</td>
                    <td class="py-2 px-3 text-left {{ $pr->code ? '' : 'text-red-500' }}">
                            <p class="flex items-center gap-2">
                            @if($pr->code)
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="h-3 w-3 fill-green-500"><path d="M342.6 86.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L160 178.7l-57.4-57.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l80 80c12.5 12.5 32.8 12.5 45.3 0l160-160zm96 128c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L160 402.7 54.6 297.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l128 128c12.5 12.5 32.8 12.5 45.3 0l256-256z"/></svg>
                            @endif
                            <span>{{ $pr->code ? $pr->code : 'not defined' }}</span>
                            </p>
                    </td>
                    <td class="py-2 px-3 bg-gray-200 text-left">{{ $pr->product && $pr->product->first_uom ? $pr->product->first_uom->code : '-'}}</td>
                    <td class="py-2 px-3 text-right font-semibold">{{ number_format($pr->stock,2) }}<br>({{ $pr->product && $pr->product->first_uom ? $pr->product->first_uom->code : '-'}})</td>

                    @php 
                        $fourth_stock = $pr->product && $pr->product->convert_first_to_fourth > 0 ? $pr->product->convert_first_to_fourth * $pr->stock : '?';
                        $third_stock =  $pr->product && $pr->product->convert_third_to_fourth > 0 ? $fourth_stock /  $pr->product->convert_third_to_fourth : '?' ;
                        $second_stock = $pr->product && $pr->product->convert_second_to_fourth > 0 ? $fourth_stock /  $pr->product->convert_second_to_fourth : '?';
                    @endphp

                    <td class="py-2 px-3  bg-gray-200 text-right">{{ number_format($second_stock,2) }}<br>({{ $pr->product && $pr->product->secondary_uom ? $pr->product->secondary_uom->code : '-'}})</td>
                    <td class="py-2 px-3 text-right">{{ number_format($third_stock,2) }}<br>({{ $pr->product && $pr->product->third_uom ? $pr->product->third_uom->code : '-'}})</td>
                    <td class="py-2 px-3 bg-gray-200 text-right">{{ number_format($fourth_stock,2) }}<br>({{ $pr->product && $pr->product->fourth_uom ? $pr->product->fourth_uom->code : '-'}})</td>
                    <td class="py-2 px-3 text-left">{{ $pr->last_updated_stock_at ? $pr->last_updated_stock_at->format('d-m-Y') : '' }}<br>{{ $pr->last_updated_stock_at ? \Carbon\Carbon::parse($pr->last_updated_stock_at)->diffForHumans() : '' }}</td>
                    <td class="py-2 px-3 bg-gray-200 text-left">{{ $pr->target }}</td>
                    <td class="py-2 px-3 text-left">{{ $pr->lead_time }} (days) / {{ $pr->buffer_time }} (days)</td>
                    @can('read margin')
                    <td class="py-2 px-3 bg-gray-200 text-left">{{ $pr->margin }}% / {{ $pr->margin_2 }}%</td>
                    @endcan
                    <td class="py-2 px-3 text-left">{{ $pr->shipmentdetail ? $pr->shipmentdetail->id.'-'.$pr->shipmentdetail->name : '' }}</td>
                    <td class="py-2 px-3 text-center">
                        @if($pr->isActive)
                        <button type="button" wire:confirm.prompt="Are you sure?\n\nType INACTIVE to confirm|INACTIVE" wire:loading.attr="disabled" wire:click="setProductStatus({{$pr->id}},'inactive')">
                            <svg xmlns="http://www.w3.org/2000/svg" class="fill-green-600 h-6 w-8" viewBox="0 0 576 512"><path d="M192 64C86 64 0 150 0 256S86 448 192 448H384c106 0 192-86 192-192s-86-192-192-192H192zm192 96a96 96 0 1 1 0 192 96 96 0 1 1 0-192z"/></svg>
                        </button>
                        @else
                        <button type="button" wire:confirm.prompt="Are you sure?\n\nType ACTIVE to confirm|ACTIVE"  wire:loading.attr="disabled" wire:click="setProductStatus({{$pr->id}},'active')">
                            <svg xmlns="http://www.w3.org/2000/svg" class="fill-black h-6 w-8" viewBox="0 0 576 512"><path d="M384 128c70.7 0 128 57.3 128 128s-57.3 128-128 128H192c-70.7 0-128-57.3-128-128s57.3-128 128-128H384zM576 256c0-106-86-192-192-192H192C86 64 0 150 0 256S86 448 192 448H384c106 0 192-86 192-192zM192 352a96 96 0 1 0 0-192 96 96 0 1 0 0 192z"/></svg>
                        </button>
                        @endif
                    </td>
                    <td class="py-2 px-3 text-center flex space-x-3">
                        
                        @canany(['manage customer','manage self customerproduct'])
                        <a href="{{route('customers.products.edit',['customer_id'=>$pr->customer_id,'id'=>$pr->id])}}"><svg xmlns="http://www.w3.org/2000/svg" class="fill-black h-5 w-5" viewBox="0 0 512 512"><path d="M471.6 21.7c-21.9-21.9-57.3-21.9-79.2 0L362.3 51.7l97.9 97.9 30.1-30.1c21.9-21.9 21.9-57.3 0-79.2L471.6 21.7zm-299.2 220c-6.1 6.1-10.8 13.6-13.5 21.9l-29.6 88.8c-2.9 8.6-.6 18.1 5.8 24.6s15.9 8.7 24.6 5.8l88.8-29.6c8.2-2.7 15.7-7.4 21.9-13.5L437.7 172.3 339.7 74.3 172.4 241.7zM96 64C43 64 0 107 0 160V416c0 53 43 96 96 96H352c53 0 96-43 96-96V320c0-17.7-14.3-32-32-32s-32 14.3-32 32v96c0 17.7-14.3 32-32 32H96c-17.7 0-32-14.3-32-32V160c0-17.7 14.3-32 32-32h96c17.7 0 32-14.3 32-32s-14.3-32-32-32H96z"/></svg></a>
                        @endcanany
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

</div>
