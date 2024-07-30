<div>
@can('manage forecast')
@if($data->status == '0')
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
            <td class="w-48 py-1"><label for="name" class="font-semibold">Customer</label></td>
            <td><span>{{ $data->customer ? $data->customer->code.' - '.$data->customer->name : '-' }}</span></td>
        </tr>
        <tr>
            <td class="w-48 py-1"><label for="name" class="font-semibold">Created At</label></td>
            <td><span>{{ $data->created_at ? $data->created_at->format('d-m-Y H:i:s') : '-' }}</span></td>
        </tr>
        <tr>
            <td class="w-48 py-1"><label for="name" class="font-semibold">Cut Off Date</label></td>
            <td><span>{{ $data->cut_off_date ? $data->cut_off_date->format('d-m-Y') : '-' }}</span></td>
        </tr>
        <tr>
            <td class="w-48 py-1"><label for="name" class="font-semibold">Period</label></td>
            <td><span>Last {{ $data->period_months}} month(s)</span></td>
        </tr>
        <tr>
            <td class="w-48 py-1"><label for="name" class="font-semibold">Remaining Day(s)</label></td>
            <td><span>{{ $data->remaining_days}} day(s)</span></td>
        </tr>

        @php 
            $current_period = $data->cut_off_date->format('M-Y');
            $cmo_period = $data->cut_off_date->addMonth()->format('M-Y');
        @endphp
        <tr>
            <td class="w-48 py-1"><label for="name" class="font-semibold">Period (CMO)</label></td>
            <td><span>{{ $cmo_period }}</span></td>
        </tr>
        <tr>
            <td class="w-48 py-1"><label for="name" class="font-semibold">Period Create</label></td>
            <td><span>{{ $current_period }}</span></td>
        </tr>
        <tr>
            <td class="w-48 py-1"><label for="name" class="font-semibold">Status</label></td>
            <td>
                <span>
                @if($data->status)
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 fill-green-500" viewBox="0 0 512 512"><path d="M288 109.3V352c0 17.7-14.3 32-32 32s-32-14.3-32-32V109.3l-73.4 73.4c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3l128-128c12.5-12.5 32.8-12.5 45.3 0l128 128c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L288 109.3zM64 352H192c0 35.3 28.7 64 64 64s64-28.7 64-64H448c35.3 0 64 28.7 64 64v32c0 35.3-28.7 64-64 64H64c-35.3 0-64-28.7-64-64V416c0-35.3 28.7-64 64-64zM432 456a24 24 0 1 0 0-48 24 24 0 1 0 0 48z"/></svg>
                @else
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 fill-gray-400" viewBox="0 0 512 512"><path d="M288 109.3V352c0 17.7-14.3 32-32 32s-32-14.3-32-32V109.3l-73.4 73.4c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3l128-128c12.5-12.5 32.8-12.5 45.3 0l128 128c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L288 109.3zM64 352H192c0 35.3 28.7 64 64 64s64-28.7 64-64H448c35.3 0 64 28.7 64 64v32c0 35.3-28.7 64-64 64H64c-35.3 0-64-28.7-64-64V416c0-35.3 28.7-64 64-64zM432 456a24 24 0 1 0 0-48 24 24 0 1 0 0 48z"/></svg>
                @endif
                </span>
            </td>
        </tr>
    </table>

    
    @php 
        $isComplete = 0;
    @endphp
    @foreach ($data->shipments as $ship)
        @php 
            if($ship->shipment_type == '1'){
                    $volume_shipment_ratio = $ship->shipment_volume;
                    $volume_percentage = 0;
                    $fractionalPart = $volume_shipment_ratio - floor($volume_shipment_ratio);
                    $volume_percentage = number_format($fractionalPart, 2) * 100;

                    if($volume_percentage < $ship->shipment_quota_requirement){
                        $isComplete = 0;
                        break;
                    }else{
                        $isComplete = 1;
                    }
            }
            if($ship->shipment_type == '2'){
                    $weight_shipment_ratio = $ship->shipment_weight;
                    $weight_percentage = 0;
                    $fractionalPart = $weight_shipment_ratio - floor($weight_shipment_ratio);
                    $weight_percentage = number_format($fractionalPart, 2) * 100;
                    if($weight_percentage < $ship->shipment_quota_requirement){
                        $isComplete = 0;
                        break;
                    }else{
                        $isComplete = 1;
                    }
                
            }
        @endphp
    @endforeach
    
    @if($isComplete == '1')
        @if($data->status == '0')
        <div class="text-right">
        <button class="px-3 py-2 bg-green-500 rounded font-semibold" wire:click="finalizeReport" wire:confirm.prompt="Are you sure?\n\nType FINALIZE to confirm|FINALIZE">
            <span class="flex">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 fill-gray-500" viewBox="0 0 512 512"><path d="M288 109.3V352c0 17.7-14.3 32-32 32s-32-14.3-32-32V109.3l-73.4 73.4c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3l128-128c12.5-12.5 32.8-12.5 45.3 0l128 128c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L288 109.3zM64 352H192c0 35.3 28.7 64 64 64s64-28.7 64-64H448c35.3 0 64 28.7 64 64v32c0 35.3-28.7 64-64 64H64c-35.3 0-64-28.7-64-64V416c0-35.3 28.7-64 64-64zM432 456a24 24 0 1 0 0-48 24 24 0 1 0 0 48z"/></svg> 
                Finalize
            </span>
        </button>
        </div>
        <div class="text-right mt-5">
        <div class="flex flex-wrap px-3 py-2 bg-green-500 rounded font-semibold text-white">
            <span class="flex">
                Shipment OK
            </span>
        </div>
        </div>
        @endif

    @else

        <div class="text-right mt-5">
        <div class="flex flex-wrap px-3 py-2 bg-red-500 rounded font-semibold text-white">
            <span class="flex">
                Shipment Need Adjustment
            </span>
        </div>
        </div>

    @endif


    <h4 class="py-3 my-3 border-y font-semibold">Forecast Details</h4>
    <div class="shadow-md  my-6  overflow-x-auto">
        <table class="min-w-full w-auto">
            <thead>
                <tr class="bg-gray-600 text-white uppercase font-light text-xs">
                    <th rowspan=2 class="py-2 px-3 text-left">Product</th>
                    <th rowspan=2 class="py-2 px-3 text-center">Shipment</th>
                    <th rowspan=2 class="py-2 px-3 text-center">Target</th>
                    <th colspan=2 class="py-2 px-3 text-center border-b border-white">Sell Out Last {{ $data->period_months}} month(s)</th>
                    <th colspan=4 class="py-2 px-3 text-center border-b border-white">Sell Out {{$current_period}}</th>
                    <th rowspan=2 class="py-2 px-3 text-center">Rencana Jual({{$cmo_period}})</th>
                    <th rowspan=2 class="py-2 px-3 text-center">Adj Khusus({{$cmo_period}})</th>
                    <th rowspan=2 class="py-2 px-3 text-center">Rencana Jual Akhir({{$cmo_period}})</th>
                    <th colspan=3 class="py-2 px-3 text-center border-b border-white">Safety Stock</th>
                    <th rowspan=2 class="py-2 px-3 text-center">Stok Sisa</th>
                    <th rowspan=2 class="py-2 px-3 text-center">Barang Dlm Perjalanan</th>
                    <th rowspan=2 class="py-2 px-3 text-center">Rencana Kirim</th>
                    <th colspan=2 class="py-2 px-3 text-center border-b border-white">Sisa CMO</th>
                    <th rowspan=2 class="py-2 px-3 text-center">DOI {{$current_period}}</th>
                    <th rowspan=2 class="py-2 px-3 text-center">Adj Shipment</th>
                    <th rowspan=2 class="py-2 px-3 text-center">Hasil CMO</th>
                    <th rowspan=2 class="py-2 px-3 text-center">DOI {{$cmo_period}}</th>
                    <th rowspan=2 class="py-2 px-3 text-center"></th>
                </tr>
                <tr class="bg-gray-600 text-white uppercase font-light text-xs">
                    <th class="py-2 px-3 text-center">Sales</th>
                    <th class="py-2 px-3 text-center">Rata-Rata Sales(/hari)</th>

                    <th class="py-2 px-3  text-center">Actual Sales</th>
                    <th class="py-2 px-3  text-center">Est Sisa</th>
                    <th class="py-2 px-3  text-center">Adj</th>
                    <th class="py-2 px-3  text-center">Est Sales</th>

                    <th class="py-2 px-3  text-center">Lead Time</th>
                    <th class="py-2 px-3  text-center">Buffer</th>
                    <th class="py-2 px-3  text-center">Total</th>

                    <th class="py-2 px-3  text-center">Qty</th>
                    <th class="py-2 px-3  text-center">Adj</th>
                </tr>
            </thead>
            <tbody class="text-black text-xs font-light">
                @foreach ($data->details as $user)
                    <tr class="border border-gray-200 hover:bg-gray-100">
                        <td class="py-2 px-3 text-left">
                            {{ $user->product ? $user->product->code : '' }}<br>
                            <span class="whitespace-nowrap">{{ $user->product ? $user->product->name : '' }}</span>
                        </td>
                        <td class="py-2 px-3 bg-gray-300 text-center whitespace-nowrap">{{ $user->shipmentdetail_id.' - '.$user->shipmentdetail->name }}</td>
                        <td class="py-2 px-3 bg-gray-100 text-right whitespace-nowrap">{{ number_format($user->target,2) }}</td>
                        <td class="py-2 px-3 text-right whitespace-nowrap">{{ number_format($user->average_sell_out,2) }}</td>
                        <td class="py-2 px-3 bg-gray-100 text-right whitespace-nowrap">{{ number_format($user->average_sell_out_per_day,2) }}</td>
                        <td class="py-2 px-3 text-right whitespace-nowrap">{{ number_format($user->actual_current,2) }}</td>
                        <td class="py-2 px-3 bg-gray-100 text-right whitespace-nowrap">{{ number_format($user->est_left_current,2) }}</td>
                        <td class="py-2 px-3 bg-yellow-200 text-right whitespace-nowrap">{{ number_format($user->adj_left_current,2) }}</td>
                        <td class="py-2 px-3 bg-gray-100 text-right whitespace-nowrap">{{ number_format($user->est_sell_out_current,2) }}</td>
                        <td class="py-2 px-3 text-right whitespace-nowrap">{{ number_format($user->plan_sell_out_next_month,2) }}</td>
                        <td class="py-2 px-3 bg-yellow-200 text-right whitespace-nowrap">{{ number_format($user->adj_plan_sell_out_special,2) }}</td>
                        <td class="py-2 px-3 bg-gray-100 text-right whitespace-nowrap">{{ number_format($user->final_plan_sell_out_special,2) }}</td>
                        <td class="py-2 px-3 text-right whitespace-nowrap">{{ number_format($user->lead_time,2) }}</td>
                        <td class="py-2 px-3 bg-gray-100 text-right whitespace-nowrap">{{ number_format($user->buffer_time,2) }}</td>
                        <td class="py-2 px-3 text-right whitespace-nowrap">{{ number_format($user->safety_stock,2) }}</td>
                        <td class="py-2 px-3 bg-gray-100 text-right whitespace-nowrap">{{ number_format($user->stock,2) }}</td>
                        <td class="py-2 px-3 text-right whitespace-nowrap">{{ number_format($user->cmo_sent,2) }}</td>
                        <td class="py-2 px-3 bg-gray-100 text-right whitespace-nowrap">{{ number_format($user->cmo_plan,2) }}</td>
                        <td class="py-2 px-3 text-right whitespace-nowrap">{{ number_format($user->cmo_left,2) }}</td>
                        <td class="py-2 px-3 bg-yellow-200 text-right whitespace-nowrap">{{ number_format($user->adj_cmo_left,2) }}</td>
                        <td class="py-2 px-3 bg-gray-100 text-right whitespace-nowrap">{{ number_format($user->doi_current_month,2) }}</td>
                        <td class="py-2 px-3 bg-yellow-200 text-right whitespace-nowrap">{{ number_format($user->adj_cmo,2) }}</td>
                        <td class="py-2 px-3 bg-gray-100 text-right whitespace-nowrap">{{ number_format($user->cmo,2) }}</td>
                        <td class="py-2 px-3 text-right whitespace-nowrap">{{ number_format($user->doi_next_month,2) }}</td>
                        <td class="py-2 px-3  text-right flex space-x-3">
                            @if($data->status == '0')
                            <a href="{{route('forecasts.details.edit',['forecast_id'=>$user->forecast_id,'id'=>$user->id])}}"><svg xmlns="http://www.w3.org/2000/svg" class="fill-black h-5 w-5" viewBox="0 0 512 512"><path d="M471.6 21.7c-21.9-21.9-57.3-21.9-79.2 0L362.3 51.7l97.9 97.9 30.1-30.1c21.9-21.9 21.9-57.3 0-79.2L471.6 21.7zm-299.2 220c-6.1 6.1-10.8 13.6-13.5 21.9l-29.6 88.8c-2.9 8.6-.6 18.1 5.8 24.6s15.9 8.7 24.6 5.8l88.8-29.6c8.2-2.7 15.7-7.4 21.9-13.5L437.7 172.3 339.7 74.3 172.4 241.7zM96 64C43 64 0 107 0 160V416c0 53 43 96 96 96H352c53 0 96-43 96-96V320c0-17.7-14.3-32-32-32s-32 14.3-32 32v96c0 17.7-14.3 32-32 32H96c-17.7 0-32-14.3-32-32V160c0-17.7 14.3-32 32-32h96c17.7 0 32-14.3 32-32s-14.3-32-32-32H96z"/></svg></a>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>


    <h4 class="py-3 my-3 border-y font-semibold">Forecast Shipments</h4>
    <div class="shadow-md  my-6  overflow-x-auto">
        <table class="min-w-full w-auto">
            <thead>
                <tr class="bg-gray-600 text-white uppercase font-light text-xs">
                    <th class="py-2 px-3 text-left"></th>
                    <th class="py-2 px-3 text-left">Shipment</th>
                    <th class="py-2 px-3 text-left">Total (CMO)</th>
                    <th class="py-2 px-3 text-left">Single Quota</th>
                    <th class="py-2 px-3 text-left">Ratio</th>
                    <th class="py-2 px-3 text-left">Total Shipment</th>
                    <th class="py-2 px-3 text-left">Last Shipment</th>
                    <th class="py-2 px-3 text-left">Req. Quota</th>
                    <th class="py-2 px-3  text-left"></th>
                    <th class="py-2 px-3  text-left"></th>
                </tr>
            </thead>
            <tbody class="text-black text-xs font-light">
                @foreach ($data->shipments as $ship)
                    <tr class="border border-gray-200 hover:bg-gray-100">
                        <td class="py-2 px-3 text-left whitespace-nowrap">Volume</td>
                        <td class="py-2 px-3 text-left whitespace-nowrap">{{ $ship->shipmentdetail ? $ship->shipmentdetail->id .' - '.$ship->shipmentdetail->name : '' }}</td>
                        <td class="py-2 px-3 text-left whitespace-nowrap">{{ $ship->total_volume }} m&#179;</td>
                        <td class="py-2 px-3 text-left whitespace-nowrap">{{ $ship->shipment_volume_quota }} m&#179;</td>
                        @php 
                                $volume_shipment_ratio = $ship->shipment_volume;
                                $volume_percentage = 0;
                                $fractionalPart = $volume_shipment_ratio - floor($volume_shipment_ratio);
                                $volume_percentage = number_format($fractionalPart, 2) * 100;
                        @endphp
                        <td class="py-2 px-3 text-left whitespace-nowrap">{{ $ship->shipment_volume }}</td>
                        <td class="py-2 px-3 text-left whitespace-nowrap">{{ ceil($ship->shipment_volume) }}</td>
                        <td class="py-2 px-3 text-left whitespace-nowrap">{{ $volume_percentage }} %</td>
                        <td class="py-2 px-3 text-left whitespace-nowrap">{{ $ship->shipment_quota_requirement }}%</td>
                        @if($ship->shipment_type == '1')
                        <td class="py-2 px-3 text-left {{$ship->shipment_type == '1' && $volume_percentage < $ship->shipment_quota_requirement ? 'bg-red-500' : 'bg-green-500'}}">{{$volume_percentage < $ship->shipment_quota_requirement ? 'Need Adjustment' : 'OK'}}</td>
                        <td class="py-2 px-3 text-left {{$ship->shipment_type == '1' && $volume_percentage < $ship->shipment_quota_requirement ? 'bg-red-500' : 'bg-green-500'}}">{{$ship->shipment_type == '1' ? 'Used' : ''}}</td>
                        @else
                                <td></td>
                                <td></td>
                        @endif
                    </tr>
                    <tr class="border border-gray-200 hover:bg-gray-100">
                        <td class="py-2 px-3 text-left whitespace-nowrap">Weight</td>
                        <td class="py-2 px-3 text-left whitespace-nowrap">{{ $ship->shipmentdetail ? $ship->shipmentdetail->id .' - '.$ship->shipmentdetail->name : '' }}</td>
                        
                        <td class="py-2 px-3 text-left whitespace-nowrap">{{ $ship->total_weight }} ton</td>
                        <td class="py-2 px-3 text-left whitespace-nowrap">{{ $ship->shipment_weight_quota }} ton</td>
                        @php 
                                $weight_shipment_ratio = $ship->shipment_weight;
                                $weight_percentage = 0;
                                $fractionalPart = $weight_shipment_ratio - floor($weight_shipment_ratio);
                                $weight_percentage = number_format($fractionalPart, 2) * 100;
                        @endphp
                        <td class="py-2 px-3 text-left whitespace-nowrap">{{ $ship->shipment_weight }}</td>
                        <td class="py-2 px-3 text-left whitespace-nowrap">{{ ceil($ship->shipment_weight) }}</td>
                        <td class="py-2 px-3 text-left whitespace-nowrap">{{ $weight_percentage }} %</td>
                        <td class="py-2 px-3 text-left whitespace-nowrap">{{ $ship->shipment_quota_requirement }}%</td>
                        @if($ship->shipment_type == '2')
                        <td class="py-2 px-3 text-left {{$ship->shipment_type == '2' && $weight_percentage < $ship->shipment_quota_requirement ? 'bg-red-500' : 'bg-green-500'}}">{{$weight_percentage < $ship->shipment_quota_requirement ? 'Need Adjustment' : 'OK'}}</td>
                        <td class="py-2 px-3 text-left {{$ship->shipment_type == '2' && $weight_percentage < $ship->shipment_quota_requirement ? 'bg-red-500' : 'bg-green-500'}}">{{$ship->shipment_type == '2' ? 'Used' : ''}}</td>
                        @else
                                <td></td>
                                <td></td>
                        @endif
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    
</div>
