<div>
    @can('manage cmo')
        @if($data->status == '1')
        <div class="w-full flex justify-end text-right mb-2">
            <button wire:click="deleteData" wire:confirm.prompt="Are you sure?\n\nType OK to confirm|OK"  wire:loading.attr="disabled" type="button" class="bg-red-500 px-3 py-1 rounded text-white font-semibold flex items-center justify-center gap-1">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 fill-white" viewBox="0 0 448 512"><path d="M135.2 17.7L128 32 32 32C14.3 32 0 46.3 0 64S14.3 96 32 96l384 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l-96 0-7.2-14.3C307.4 6.8 296.3 0 284.2 0L163.8 0c-12.1 0-23.2 6.8-28.6 17.7zM416 128L32 128 53.2 467c1.6 25.3 22.6 45 47.9 45l245.8 0c25.3 0 46.3-19.7 47.9-45L416 128z"/></svg>
                Cancel CMO
            </button>
        </div>
        @endif
    @endcan



    @if($data->approved_by)
    <div class="w-full text-right flex items-end justify-end space-x-2">
        @if(!$data->file_path)
        <button wire:click="test" class="px-2 py-2 rounded bg-green-500 text-white">Generate Report</button>
        @endif
        @if($data->file_path)
            <a href="{{$data->file_path}}" class="flex items-center justify-center w-32  px-2 py-2 rounded bg-green-500 text-white">
            <svg xmlns="http://www.w3.org/2000/svg" class="flex-none h-3 w-3 mr-2 fill-gray-500" viewBox="0 0 512 512"><path d="M288 109.3V352c0 17.7-14.3 32-32 32s-32-14.3-32-32V109.3l-73.4 73.4c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3l128-128c12.5-12.5 32.8-12.5 45.3 0l128 128c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L288 109.3zM64 352H192c0 35.3 28.7 64 64 64s64-28.7 64-64H448c35.3 0 64 28.7 64 64v32c0 35.3-28.7 64-64 64H64c-35.3 0-64-28.7-64-64V416c0-35.3 28.7-64 64-64zM432 456a24 24 0 1 0 0-48 24 24 0 1 0 0 48z"/></svg>    
            <span class="flex-none">Download</span></a>
        @endif
    </div>
    @endif
    <table>
        <tr>
            <td class="w-48 py-1"><label for="name" class="font-semibold">Customer</label></td>
            <td><span>{{ $data->customer ? $data->customer->code.' - '.$data->customer->name : '-' }}</span></td>
        </tr>
        <tr>
            <td class="w-48 py-1"><label for="name" class="font-semibold">Created At</label></td>
            <td><span>{{ $data->created_at ? $data->created_at->format('d-m-Y H:i:s') : '-' }}</span></td>
        </tr>
        <tr>
            <td class="w-48 py-1"><label for="name" class="font-semibold">Forecast (Cut Off Date)</label></td>
            <td><span>{{ $data->forecast ? $data->forecast->cut_off_date->format('d-M-Y') : '-' }}</span></td>
        </tr>
        <tr>
            <td class="w-48 py-1"><label for="name" class="font-semibold">Period</label></td>
            <td><span>{{ \Carbon\Carbon::parse($data->period)->format('M-Y') }}</span></td>
        </tr>
       
        <tr>
            <td class="w-48 py-1"><label for="name" class="font-semibold">Status</label></td>
            <td><span>{{ $data->cmostatus->name}}</span></td>
        </tr>
        <tr>
            <td class="w-48 py-1"><label for="name" class="font-semibold">PPN Status</label></td>
            <td>
                @if($data->status == '1')
                    @can('manage cmo')
                        @if($data->ppnstatus == '1')
                        <button type="button" class="flex" wire:confirm.prompt="Are you sure?\n\nType EXCLUDE to confirm|EXCLUDE" wire:loading.attr="disabled" wire:click="setPPNStatus('exclude')">
                            <svg xmlns="http://www.w3.org/2000/svg" class="fill-green-600 h-6 w-8" viewBox="0 0 576 512"><path d="M192 64C86 64 0 150 0 256S86 448 192 448H384c106 0 192-86 192-192s-86-192-192-192H192zm192 96a96 96 0 1 1 0 192 96 96 0 1 1 0-192z"/></svg>
                            is Include
                        </button>
                        @else
                        <button type="button" class="flex" wire:confirm.prompt="Are you sure?\n\nType INCLUDE to confirm|INCLUDE"  wire:loading.attr="disabled" wire:click="setPPNStatus('include')">
                            <svg xmlns="http://www.w3.org/2000/svg" class="fill-yellow h-6 w-8" viewBox="0 0 576 512"><path d="M384 128c70.7 0 128 57.3 128 128s-57.3 128-128 128H192c-70.7 0-128-57.3-128-128s57.3-128 128-128H384zM576 256c0-106-86-192-192-192H192C86 64 0 150 0 256S86 448 192 448H384c106 0 192-86 192-192zM192 352a96 96 0 1 0 0-192 96 96 0 1 0 0 192z"/></svg>
                            is Exclude
                        </button>
                        @endif
                    @endcan
                @endif
                <span>{{ $data->ppnstatus == '1' ? 'Include' : 'Exclude'}}</span>
            </td>
        </tr>
        
        @if($data->approved_at)
        <tr>
            <td class="w-48 py-1"><label for="name" class="font-semibold">Approved By</label></td>
            <td><span>{{ $data->approved ? $data->approved->name : ''}} at {{ \Carbon\Carbon::parse($data->approved_at)->format('d-M-Y h:i:s') }}</span></td>
        </tr>
        @endif
        
        @if($data->deliveryupdated_at)
        <tr>
            <td class="w-48 py-1"><label for="name" class="font-semibold">Delivery Updated By</label></td>
            <td><span>{{ $data->deliveryupdated ? $data->deliveryupdated->name : ''}} at {{ \Carbon\Carbon::parse($data->deliveryupdated_at)->format('d-M-Y h:i:s') }}</span></td>
        </tr>
        <tr>
            <td class="w-48 py-1"><label for="name" class="font-semibold">No. Delivery Order</label></td>
            <td><span>{{ $data->no_deliveryorder }}</span></td>
        </tr>
        @endif
        
        @if($data->received_at)
        <tr>
            <td class="w-48 py-1"><label for="name" class="font-semibold">Received By</label></td>
            <td><span>{{ $data->received ? $data->received->name : ''}} at {{ \Carbon\Carbon::parse($data->received_at)->format('d-M-Y h:i:s') }}</span></td>
        </tr>
        @endif
    </table>

    
    @can('approve cmo')
    @if($data->status == '1' && $data->updated_at == $data->last_calculated_at)
    <div class="text-right">
    <button class="px-3 py-2 bg-green-500 rounded font-semibold" wire:click="finalizeReport('approve')" wire:confirm.prompt="Are you sure?\n\nType FINALIZE to confirm|FINALIZE">
        <span class="flex">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 fill-gray-500" viewBox="0 0 512 512"><path d="M288 109.3V352c0 17.7-14.3 32-32 32s-32-14.3-32-32V109.3l-73.4 73.4c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3l128-128c12.5-12.5 32.8-12.5 45.3 0l128 128c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L288 109.3zM64 352H192c0 35.3 28.7 64 64 64s64-28.7 64-64H448c35.3 0 64 28.7 64 64v32c0 35.3-28.7 64-64 64H64c-35.3 0-64-28.7-64-64V416c0-35.3 28.7-64 64-64zM432 456a24 24 0 1 0 0-48 24 24 0 1 0 0 48z"/></svg> 
            Set To 'Approved' (Delivery Plan)
        </span>
    </button>
    </div>
    @endif
    @endcan

    @can('deliveryupdate cmo')
    @if($data->status == '2')
    <div class="text-right">
    <button class="px-3 py-2 bg-green-500 rounded font-semibold" wire:click="finalizeReport('on-delivery')" wire:confirm.prompt="Are you sure?\n\nType FINALIZE to confirm|FINALIZE">
        <span class="flex">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 fill-gray-500" viewBox="0 0 512 512"><path d="M288 109.3V352c0 17.7-14.3 32-32 32s-32-14.3-32-32V109.3l-73.4 73.4c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3l128-128c12.5-12.5 32.8-12.5 45.3 0l128 128c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L288 109.3zM64 352H192c0 35.3 28.7 64 64 64s64-28.7 64-64H448c35.3 0 64 28.7 64 64v32c0 35.3-28.7 64-64 64H64c-35.3 0-64-28.7-64-64V416c0-35.3 28.7-64 64-64zM432 456a24 24 0 1 0 0-48 24 24 0 1 0 0 48z"/></svg> 
            Set To 'On Delivery'
        </span>
    </button>
    <div class="text-right w-[48rem] ml-auto">
        <div class="text-sm my-3">
            <label for="no_deliveryorder" class="font-semibold">No. DO:</label>
            <input type="text" name="no_deliveryorder" wire:model="no_deliveryorder" required placeholder="No Delivery Order" class="w-full rounded border-gray-300 @error('no_deliveryorder') border-red-500 @enderror">
            @error('no_deliveryorder') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>
    </div>
    </div>
    @endif
    @endcan

    @can('receive cmo')
    @if($data->status == '3')
    <div class="text-right">
    <button class="px-3 py-2 bg-green-500 rounded font-semibold" wire:click="finalizeReport('received')" wire:confirm.prompt="Are you sure?\n\nType FINALIZE to confirm|FINALIZE">
        <span class="flex">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 fill-gray-500" viewBox="0 0 512 512"><path d="M288 109.3V352c0 17.7-14.3 32-32 32s-32-14.3-32-32V109.3l-73.4 73.4c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3l128-128c12.5-12.5 32.8-12.5 45.3 0l128 128c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L288 109.3zM64 352H192c0 35.3 28.7 64 64 64s64-28.7 64-64H448c35.3 0 64 28.7 64 64v32c0 35.3-28.7 64-64 64H64c-35.3 0-64-28.7-64-64V416c0-35.3 28.7-64 64-64zM432 456a24 24 0 1 0 0-48 24 24 0 1 0 0 48z"/></svg> 
            Set To 'Received'
        </span>
    </button>
    </div>
    @endif
    @endcan



    <h4 class="py-3 my-3 border-y font-semibold">Details</h4>
    @if($data->status == '1')
    <div class="text-right mt-5 mb-5">
        
    @if($data->status == '1' && $data->updated_at != $data->last_calculated_at)
    <span class="italic text-xs">Recalculate Before Continue...</span>
    @endif
    <button class="px-3 py-2 bg-yellow-500 rounded font-semibold" wire:click="calculate" wire:confirm.prompt="Are you sure?\n\nType OK to calculate|OK">
        <span class="flex">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 fill-black" viewBox="0 0 512 512"><path d="M288 109.3V352c0 17.7-14.3 32-32 32s-32-14.3-32-32V109.3l-73.4 73.4c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3l128-128c12.5-12.5 32.8-12.5 45.3 0l128 128c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L288 109.3zM64 352H192c0 35.3 28.7 64 64 64s64-28.7 64-64H448c35.3 0 64 28.7 64 64v32c0 35.3-28.7 64-64 64H64c-35.3 0-64-28.7-64-64V416c0-35.3 28.7-64 64-64zM432 456a24 24 0 1 0 0-48 24 24 0 1 0 0 48z"/></svg> 
            Re-Calculate
        </span>
    </button>
    </div>
    @endif
    <div class="shadow-md  my-6  overflow-x-auto">
        <table class="min-w-full w-auto">
            <thead>
                <tr class="bg-gray-600 text-white uppercase font-light text-xs">
                    <th class="py-2 px-3 text-left">Product</th>
                    <th class="py-2 px-3 text-right">Volume</th>
                    <th class="py-2 px-3 text-right">Weight</th>
                    <th class="py-2 px-3 text-left">Shipment</th>
                    <th class="py-2 px-3 text-right">Qty</th>
                    <th class="py-2 px-3 text-right">Total Volume</th>
                    <th class="py-2 px-3 text-right">Total Weight</th>
                    <th class="py-2 px-3 text-right">Nominal</th>
                </tr>
            </thead>
            <tbody class="text-black text-xs font-light">
                @php 
                    $total_nom = 0;
                @endphp
                @foreach ($data->details as $user)
                
                @php 
                    $total_nom += $user->nominal;
                @endphp
                    <tr class="border border-gray-200 hover:bg-gray-100">
                        <td class="py-2 px-3 text-left">{{ $user->product ? $user->product->code : '' }}<br><span class="whitespace-nowrap">{{ $user->product ? $user->product->nickname : '' }}</span></td>
                        
                        <td class="py-2 px-3 bg-gray-100 text-right whitespace-nowrap">{{ $user->volume }}</td>
                        <td class="py-2 px-3 text-right whitespace-nowrap">{{ $user->weight }}</td>
                        <td class="py-2 px-3 text-left whitespace-nowrap">{{ $user->shipmentdetail_id.'-'.$user->shipmentdetail->name }}</td>

                        <td class="py-2 px-3 bg-gray-100 text-right whitespace-nowrap">{{ $user->qty }}</td>
                        <td class="py-2 px-3 text-right whitespace-nowrap">{{ number_format($user->total_volume,5) }}</td>
                        <td class="py-2 px-3 bg-gray-100 text-right whitespace-nowrap">{{ number_format($user->total_weight,5) }}</td>
                        <td class="py-2 px-3 text-right whitespace-nowrap">{{ number_format($user->nominal,2) }}</td>
                    </tr>
                @endforeach
                    <tr class="border border-gray-200 hover:bg-gray-100">
                        <td colspan="7" class="py-2 px-3 text-right font-semibold">TOTAL</td>
                        <td class="py-2 px-3 text-right whitespace-nowrap">{{ number_format($total_nom,2) }}</td>
                    </tr>
            </tbody>
        </table>
    </div>



    <h4 class="py-3 my-3 border-y font-semibold">Shipment</h4>
    <div class="shadow-md  my-6  overflow-x-auto">
        <table class="min-w-full w-auto">
            <thead>
                <tr class="bg-gray-600 text-white uppercase font-light text-xs">
                    <th class="py-2 px-3 text-left">Shipment</th>
                    <th class="py-2 px-3 text-left">Type</th>
                    <th class="py-2 px-3 text-left">Volume/Weight</th>
                    <th class="py-2 px-3 text-left">Total</th>
                    <th class="py-2 px-3 text-right">Shipment Price</th>
                    <th class="py-2 px-3 text-right">Nominal</th>
                </tr>
            </thead>
            <tbody class="text-black text-xs font-light">
                @foreach ($data->shipments as $user)
                    <tr class="border border-gray-200 hover:bg-gray-100">
                        <td class="py-2 px-3 text-left">{{ $user->shipmentdetail ? $user->shipmentdetail->name : '' }}</td>
                        <td class="py-2 px-3 text-left">{{ $user->shipment_type == '1' ? 'Kubikasi' : 'Tonase' }}</td>
                        <td class="py-2 px-3 text-left">{{ $user->shipment_type == '1' ? $user->total_volume.' m³' : $user->total_weight.' ton'}}</td>
                        <td class="py-2 px-3 text-left">{{ $user->shipment_type == '1' ? $user->shipment_volume : $user->shipment_weight}}</td>
                        <td class="py-2 px-3 text-right">{{ number_format($user->price,2)}}</td>
                        <td class="py-2 px-3 text-right">{{ number_format($user->nominal,2)}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>
