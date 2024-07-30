<div>
    @can('manage zone')
    <div class="w-full flex justify-end text-right">
        <button wire:click="deleteData" wire:confirm.prompt="Are you sure?\n\nType OK to confirm|OK"  wire:loading.attr="disabled" type="button" class="bg-red-500 px-3 py-1 rounded text-white font-semibold flex items-center justify-center gap-1">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 fill-white" viewBox="0 0 448 512"><path d="M135.2 17.7L128 32 32 32C14.3 32 0 46.3 0 64S14.3 96 32 96l384 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l-96 0-7.2-14.3C307.4 6.8 296.3 0 284.2 0L163.8 0c-12.1 0-23.2 6.8-28.6 17.7zM416 128L32 128 53.2 467c1.6 25.3 22.6 45 47.9 45l245.8 0c25.3 0 46.3-19.7 47.9-45L416 128z"/></svg>
            Delete
        </button>
    </div>
    @endcan
    <table>
        <tr>
            <td class="w-24 py-1"><label for="name" class="font-semibold">Name</label></td>
            <td><span>{{$data->name}}</span></td>
        </tr>
        <tr>
            <td class="w-24 py-1"><label for="name" class="font-semibold">Code</label></td>
            <td><span>{{$data->code}}</span></td>
        </tr>
    </table>

    <h4 class="font-semibold border-y mt-5 py-3">Price (Product)</h4>
    <div class="shadow-md  my-6  overflow-x-auto">
    <table class="min-w-full w-auto">
        <thead>
            <tr class="bg-gray-600 text-white uppercase font-light text-sm">
                <th class="py-2 px-3 text-left">Code(Master)</th>
                <th class="py-2 px-3 text-left">Product</th>
                <th class="py-2 px-3 text-right">Price(Inc)</th>
                <th class="py-2 px-3 text-right">Price(Exc)</th>
                <th class="py-2 px-3 text-left">UOM</th>
                <th class="py-2 px-3 text-center"></th>
            </tr>
        </thead>
        <tbody class="text-black text-xs font-light">
            @foreach ($data->zoneprices as $pr)
                <tr class="border border-gray-200 hover:bg-gray-100">
                    <td class="py-2 px-3 bg-gray-200 text-left whitespace-nowrap">{{ $pr->product ? $pr->product->code : '-' }}</td>
                    <td class="py-2 px-3 text-left">{{ $pr->product ? $pr->product->nickname : '-'}}<br>{{ $pr->product ? $pr->product->name : '-'}}</td>
                    <td class="py-2 px-3 bg-gray-200 text-right">{{ $pr->price_inc == 0 ? 'Not Defined' : number_format($pr->price_inc,2)}}</td>   
                    <td class="py-2 px-3 text-right">{{ $pr->price_exc == 0 ? 'Not Defined' : number_format($pr->price_exc,2)}}</td>   
                    <td class="py-2 px-3 bg-gray-200 text-left">{{ $pr->product && $pr->product->first_uom ? $pr->product->first_uom->code : '-'}}</td>
                    <td class="py-2 px-3 text-center flex space-x-3">
                        <a href="{{route('zones.products.edit',['zone_id'=>$pr->zone_id,'id'=>$pr->id])}}"><svg xmlns="http://www.w3.org/2000/svg" class="fill-black h-5 w-5" viewBox="0 0 512 512"><path d="M471.6 21.7c-21.9-21.9-57.3-21.9-79.2 0L362.3 51.7l97.9 97.9 30.1-30.1c21.9-21.9 21.9-57.3 0-79.2L471.6 21.7zm-299.2 220c-6.1 6.1-10.8 13.6-13.5 21.9l-29.6 88.8c-2.9 8.6-.6 18.1 5.8 24.6s15.9 8.7 24.6 5.8l88.8-29.6c8.2-2.7 15.7-7.4 21.9-13.5L437.7 172.3 339.7 74.3 172.4 241.7zM96 64C43 64 0 107 0 160V416c0 53 43 96 96 96H352c53 0 96-43 96-96V320c0-17.7-14.3-32-32-32s-32 14.3-32 32v96c0 17.7-14.3 32-32 32H96c-17.7 0-32-14.3-32-32V160c0-17.7 14.3-32 32-32h96c17.7 0 32-14.3 32-32s-14.3-32-32-32H96z"/></svg></a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
