<div>
<div class="flex">
    <input type="text" placeholder="Search..." wire:model="search" class="w-full rounded border-gray-300">
    <button type="button" wire:click="runSearch()" class="flex space-x-1 items-center py-2 px-3 border bg-gray-300">
    <svg xmlns="http://www.w3.org/2000/svg" class="fill-black h-4 w-4" viewBox="0 0 512 512"><path d="M416 208c0 45.9-14.9 88.3-40 122.7L502.6 457.4c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L330.7 376c-34.4 25.2-76.8 40-122.7 40C93.1 416 0 322.9 0 208S93.1 0 208 0S416 93.1 416 208zM208 352a144 144 0 1 0 0-288 144 144 0 1 0 0 288z"/></svg>
        Search
    </button>
</div>
<div class="shadow-md  my-6  overflow-x-auto">
    <table class="min-w-full w-auto">
        <thead>
            <tr class="bg-gray-600 text-white uppercase font-light text-sm">
                <th class="py-2 px-3 text-left">Created</th>
                <th class="py-2 px-3 text-left">Customer</th>
                <th class="py-2 px-3 text-left">File Name</th>
                <th class="py-2 px-3 text-left">isPublished</th>
                <th class="py-2 px-3 text-center"></th>
            </tr>
        </thead>
        <tbody class="text-black text-xs font-light">
            @foreach ($datas as $user)
                <tr class="border border-gray-200 hover:bg-gray-100">
                    <td class="py-2 px-3 text-left whitespace-nowrap">{{ $user->created_at ? $user->created_at->format('d-m-Y H:i:s') : '-' }}</td>
                    <td class="py-2 px-3 text-left">{{ $user->customer ? $user->customer->code.' - '.$user->customer->name : '-' }}</td>
                    <td class="py-2 px-3 text-left">{{ $user->file_name }}</td>
                    <td class="py-2 px-3 text-left">
                        <span>
                        @if($user->isPublished)
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 fill-green-500" viewBox="0 0 512 512"><path d="M288 109.3V352c0 17.7-14.3 32-32 32s-32-14.3-32-32V109.3l-73.4 73.4c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3l128-128c12.5-12.5 32.8-12.5 45.3 0l128 128c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L288 109.3zM64 352H192c0 35.3 28.7 64 64 64s64-28.7 64-64H448c35.3 0 64 28.7 64 64v32c0 35.3-28.7 64-64 64H64c-35.3 0-64-28.7-64-64V416c0-35.3 28.7-64 64-64zM432 456a24 24 0 1 0 0-48 24 24 0 1 0 0 48z"/></svg>
                        @else
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 fill-gray-400" viewBox="0 0 512 512"><path d="M288 109.3V352c0 17.7-14.3 32-32 32s-32-14.3-32-32V109.3l-73.4 73.4c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3l128-128c12.5-12.5 32.8-12.5 45.3 0l128 128c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L288 109.3zM64 352H192c0 35.3 28.7 64 64 64s64-28.7 64-64H448c35.3 0 64 28.7 64 64v32c0 35.3-28.7 64-64 64H64c-35.3 0-64-28.7-64-64V416c0-35.3 28.7-64 64-64zM432 456a24 24 0 1 0 0-48 24 24 0 1 0 0 48z"/></svg>
                        @endif
                        </span>
                    </td>
                    <td class="py-2 px-3 text-center flex space-x-3">
                        <a href="{{route('reportsales.show',['id'=>$user->id])}}"><svg xmlns="http://www.w3.org/2000/svg" class="fill-black h-5 w-5" viewBox="0 0 576 512"><path d="M288 80c-65.2 0-118.8 29.6-159.9 67.7C89.6 183.5 63 226 49.4 256c13.6 30 40.2 72.5 78.6 108.3C169.2 402.4 222.8 432 288 432s118.8-29.6 159.9-67.7C486.4 328.5 513 286 526.6 256c-13.6-30-40.2-72.5-78.6-108.3C406.8 109.6 353.2 80 288 80zM95.4 112.6C142.5 68.8 207.2 32 288 32s145.5 36.8 192.6 80.6c46.8 43.5 78.1 95.4 93 131.1c3.3 7.9 3.3 16.7 0 24.6c-14.9 35.7-46.2 87.7-93 131.1C433.5 443.2 368.8 480 288 480s-145.5-36.8-192.6-80.6C48.6 356 17.3 304 2.5 268.3c-3.3-7.9-3.3-16.7 0-24.6C17.3 208 48.6 156 95.4 112.6zM288 336c44.2 0 80-35.8 80-80s-35.8-80-80-80c-.7 0-1.3 0-2 0c1.3 5.1 2 10.5 2 16c0 35.3-28.7 64-64 64c-5.5 0-10.9-.7-16-2c0 .7 0 1.3 0 2c0 44.2 35.8 80 80 80zm0-208a128 128 0 1 1 0 256 128 128 0 1 1 0-256z"/></svg></a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div>
    {{ $datas->links() }}
</div>
</div>
