<div>
@can('manage brand')
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
</div>
