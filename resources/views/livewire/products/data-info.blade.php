<div>
@can('manage product')
    <div class="w-full flex justify-end text-right">
        <button wire:click="deleteData" wire:confirm.prompt="Are you sure?\n\nType OK to confirm|OK"  wire:loading.attr="disabled" type="button" class="bg-red-500 px-3 py-1 rounded text-white font-semibold flex items-center justify-center gap-1">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 fill-white" viewBox="0 0 448 512"><path d="M135.2 17.7L128 32 32 32C14.3 32 0 46.3 0 64S14.3 96 32 96l384 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l-96 0-7.2-14.3C307.4 6.8 296.3 0 284.2 0L163.8 0c-12.1 0-23.2 6.8-28.6 17.7zM416 128L32 128 53.2 467c1.6 25.3 22.6 45 47.9 45l245.8 0c25.3 0 46.3-19.7 47.9-45L416 128z"/></svg>
            Delete
        </button>
    </div>
    @endcan
    <table>
        <tr>
            <td class="w-24 py-1"><label for="name" class="font-semibold">Code</label></td>
            <td><span>{{$data->code}}</span></td>
        </tr>
        <tr>
            <td class="w-24 py-1"><label for="name" class="font-semibold">Brand</label></td>
            <td><span>{{$data->brand ? $data->brand->code.' - '.$data->brand->name : '-'}}</span></td>
        </tr>
        <tr>
            <td class="w-24 py-1"><label for="name" class="font-semibold">Category</label></td>
            <td><span>{{$data->category ? $data->category->code.' - '.$data->category->name : '-'}}</span></td>
        </tr>
        <tr>
            <td class="w-24 py-1"><label for="name" class="font-semibold">Name</label></td>
            <td><span>{{$data->name}}</span></td>
        </tr>
        
        <tr>
            <td class="w-24 py-1"><label for="name" class="font-semibold">Nickname</label></td>
            <td><span>{{$data->nickname}}</span></td>
        </tr>
        <tr>
            <td class="w-24 py-1"><label for="name" class="font-semibold">Varian</label></td>
            <td><span>{{$data->varian}}</span></td>
        </tr>
        <tr>
            <td class="w-24 py-1"><label for="name" class="font-semibold">Description</label></td>
            <td><span>{{$data->description}}</span></td>
        </tr>
    </table>

    
    <table>
        <tr>
            <td class="w-24 py-1"><label for="name" class="font-semibold">Width</label></td>
            <td><span>{{$data->width}} m</span></td>
        </tr>
        <tr>
            <td class="w-24 py-1"><label for="name" class="font-semibold">Height</label></td>
            <td><span>{{$data->height}} m</span></td>
        </tr>
        <tr>
            <td class="w-24 py-1"><label for="name" class="font-semibold">Depth</label></td>
            <td><span>{{$data->depth}} m</span></td>
        </tr>
        <tr>
            <td class="w-24 py-1"><label for="name" class="font-semibold">Volume</label></td>
            <td><span>{{$data->width * $data->height * $data->depth}} cubic units (m&#179;)</span></td>
        </tr>
        <tr>
            <td class="w-24 py-1"><label for="name" class="font-semibold">Weight</label></td>
            <td><span>{{$data->weight}} kg</span></td>
        </tr>
    </table>


    <h4 class="font-semibold border-b mt-5">Conversion Table</h4>

    <table class="table-auto">
        <tbody>
        <tr>
            <td class="w-24 p-2 border border-slate-600"><label class="font-semibold"></label></td>
            <td class="w-24 p-2 border border-slate-600"><label class="font-semibold"></label></td>
            <td class="w-24 p-2 border border-slate-600"><label class="font-semibold">{{$data->fourth_uom ? $data->fourth_uom->name : '-'}} (Fourth Uom)</label></td>
        </tr>
        <tr>
            <td class="w-24 p-2 border border-slate-600"><label class="font-semibold">(First Uom/Default)</label></td>
            <td class="w-24 p-2 border border-slate-600"><label class="font-semibold">{{$data->first_uom ? $data->first_uom->name : '-'}}</label></td>
            <td class="w-24 p-2 border border-slate-600"><span>{{$data->convert_first_to_fourth}}</span></td>
        </tr>
        <tr>
        <td class="w-24 p-2 border border-slate-600"><label class="font-semibold">(Second Uom)</label></td>
            <td class="w-24 p-2 border border-slate-600"><label class="font-semibold">{{$data->secondary_uom ? $data->secondary_uom->name : '-'}}</label></td>
            <td class="w-24 p-2 border border-slate-600"><span>{{$data->convert_second_to_fourth}}</span></td>
        </tr>
        <tr>
        <td class="w-24 p-2 border border-slate-600"><label class="font-semibold">(Third Uom)</label></td>
            <td class="w-24 p-2 border border-slate-600"><label class="font-semibold">{{$data->third_uom ? $data->third_uom->name : '-'}}</label></td>
            <td class="w-24 p-2 border border-slate-600"><span>{{$data->convert_third_to_fourth}}</span></td>
        </tr>
    </tbody>
    </table>
    
</div>
