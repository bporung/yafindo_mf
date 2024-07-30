<div class="relative p-2">
    <button class="absolute top-2 right-2 block sm:hidden p-2" onclick="toggleSidebar()">
        <svg xmlns="http://www.w3.org/2000/svg" class="fill-white h-5 w-5" viewBox="0 0 512 512">
            <path d="M256 48a208 208 0 1 1 0 416 208 208 0 1 1 0-416zm0 464A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM175 175c-9.4 9.4-9.4 24.6 0 33.9l47 47-47 47c-9.4 9.4-9.4 24.6 0 33.9s24.6 9.4 33.9 0l47-47 47 47c9.4 9.4 24.6 9.4 33.9 0s9.4-24.6 0-33.9l-47-47 47-47c9.4-9.4 9.4-24.6 0-33.9s-24.6-9.4-33.9 0l-47 47-47-47c-9.4-9.4-24.6-9.4-33.9 0z"/>
        </svg>
    </button>

    <div class="text-white text-sm">
        <div class="flex items-center my-3">
            <span class="flex-none mr-1 p-1 border rounded">
                <svg xmlns="http://www.w3.org/2000/svg" class="fill-white h-5 w-5" viewBox="0 0 640 512">
                    <path d="M192 64C86 64 0 150 0 256S86 448 192 448H448c106 0 192-86 192-192s-86-192-192-192H192zM496 168a40 40 0 1 1 0 80 40 40 0 1 1 0-80zM392 304a40 40 0 1 1 80 0 40 40 0 1 1 -80 0zM168 200c0-13.3 10.7-24 24-24s24 10.7 24 24v32h32c13.3 0 24 10.7 24 24s-10.7 24-24 24H216v32c0 13.3-10.7 24-24 24s-24-10.7-24-24V280H136c-13.3 0-24-10.7-24-24s10.7-24 24-24h32V200z"/>
                </svg>
            </span>
            <div class="flex-none">
                <div class="p-0 m-0 font-semibold text-xl">{{ config('app.name', 'Controller') }}</div>
                <div class="p-0 m-0 text-sm text-gray-500">Panel</div>
            </div>
        </div>

        
        <div class="my-2">
            <div>
                <label class="text-gray-500 font-bold uppercase text-xs">My Account</label>
            </div>
            <div class="py-1 px-2">
                <a>
                    @php
                        $hour = date('G');

                        // Initialize the greeting variable
                        $greeting = '';

                        // Determine the appropriate greeting based on the time
                        if ($hour >= 5 && $hour < 12) {
                            $greeting = 'Good morning';
                        } elseif ($hour >= 12 && $hour < 18) {
                            $greeting = 'Good afternoon';
                        } elseif ($hour >= 18 && $hour < 24) {
                            $greeting = 'Good evening';
                        } else {
                            $greeting = 'Good night';
                        }
                    @endphp
                    <div class="flex items-center text-gray-200 fill-gray-200">
                        <span class="mr-1"><svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 448 512"><path d="M304 128a80 80 0 1 0 -160 0 80 80 0 1 0 160 0zM96 128a128 128 0 1 1 256 0A128 128 0 1 1 96 128zM49.3 464H398.7c-8.9-63.3-63.3-112-129-112H178.3c-65.7 0-120.1 48.7-129 112zM0 482.3C0 383.8 79.8 304 178.3 304h91.4C368.2 304 448 383.8 448 482.3c0 16.4-13.3 29.7-29.7 29.7H29.7C13.3 512 0 498.7 0 482.3z"/></svg></span>
                        <span class="text-gray-400 capitalize">{{$greeting}} , <span class="font-bold text-white">{{Auth::user()->name}}</span></span>
                    </div>
                </a>
            </div>
            <div class="py-1 px-2">
                <a href="{{route('auth.profile')}}">
                    <div class="flex items-center text-gray-200 fill-gray-200 hover:fill-white hover:text-white">
                        <span class="mr-1"><svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 576 512"><path d="M512 80c8.8 0 16 7.2 16 16V416c0 8.8-7.2 16-16 16H64c-8.8 0-16-7.2-16-16V96c0-8.8 7.2-16 16-16H512zM64 32C28.7 32 0 60.7 0 96V416c0 35.3 28.7 64 64 64H512c35.3 0 64-28.7 64-64V96c0-35.3-28.7-64-64-64H64zM208 256a64 64 0 1 0 0-128 64 64 0 1 0 0 128zm-32 32c-44.2 0-80 35.8-80 80c0 8.8 7.2 16 16 16H304c8.8 0 16-7.2 16-16c0-44.2-35.8-80-80-80H176zM376 144c-13.3 0-24 10.7-24 24s10.7 24 24 24h80c13.3 0 24-10.7 24-24s-10.7-24-24-24H376zm0 96c-13.3 0-24 10.7-24 24s10.7 24 24 24h80c13.3 0 24-10.7 24-24s-10.7-24-24-24H376z"/></svg></span>
                        <span>Profile</span>
                    </div>
                </a>
            </div>
            <div class="py-1 px-2">
                <a href="{{route('auth.changepassword')}}">
                    <div class="flex items-center text-gray-200 fill-gray-200 hover:fill-white hover:text-white">
                        <span class="mr-1"><svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 448 512"><path d="M144 144v48H304V144c0-44.2-35.8-80-80-80s-80 35.8-80 80zM80 192V144C80 64.5 144.5 0 224 0s144 64.5 144 144v48h16c35.3 0 64 28.7 64 64V448c0 35.3-28.7 64-64 64H64c-35.3 0-64-28.7-64-64V256c0-35.3 28.7-64 64-64H80z"/></svg></span>
                        <span>Change Password</span>
                    </div>
                </a>
            </div>
            <div class="py-1 px-2">
                <form method="POST" action="{{ route('logout') }}" x-data>
                    @csrf
                        <a class="cursor-pointer" @click.prevent="$root.submit();">
                            <div class="flex items-center text-gray-200 fill-gray-200 hover:fill-white hover:text-white">
                                <span class="mr-1"><svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 512 512"><path d="M377.9 105.9L500.7 228.7c7.2 7.2 11.3 17.1 11.3 27.3s-4.1 20.1-11.3 27.3L377.9 406.1c-6.4 6.4-15 9.9-24 9.9c-18.7 0-33.9-15.2-33.9-33.9l0-62.1-128 0c-17.7 0-32-14.3-32-32l0-64c0-17.7 14.3-32 32-32l128 0 0-62.1c0-18.7 15.2-33.9 33.9-33.9c9 0 17.6 3.6 24 9.9zM160 96L96 96c-17.7 0-32 14.3-32 32l0 256c0 17.7 14.3 32 32 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32l-64 0c-53 0-96-43-96-96L0 128C0 75 43 32 96 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32z"/></svg></span>
                                <span>Logout</span>
                            </div>
                        </a>
                </form>
            </div>
        </div>

        <div class="my-2">
            <div>
                <label class="text-gray-500 font-bold uppercase text-xs">Nav Overview</label>
            </div>
            <div class="py-1 px-2">
                <a href="{{route('dashboard')}}">
                    <div class="flex items-center text-gray-200 fill-gray-200 hover:fill-white hover:text-white">
                        <span class="mr-1"><svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 576 512"><path d="M575.8 255.5c0 18-15 32.1-32 32.1h-32l.7 160.2c0 2.7-.2 5.4-.5 8.1V472c0 22.1-17.9 40-40 40H456c-1.1 0-2.2 0-3.3-.1c-1.4 .1-2.8 .1-4.2 .1H416 392c-22.1 0-40-17.9-40-40V448 384c0-17.7-14.3-32-32-32H256c-17.7 0-32 14.3-32 32v64 24c0 22.1-17.9 40-40 40H160 128.1c-1.5 0-3-.1-4.5-.2c-1.2 .1-2.4 .2-3.6 .2H104c-22.1 0-40-17.9-40-40V360c0-.9 0-1.9 .1-2.8V287.6H32c-18 0-32-14-32-32.1c0-9 3-17 10-24L266.4 8c7-7 15-8 22-8s15 2 21 7L564.8 231.5c8 7 12 15 11 24z"/></svg></span>
                        <span>Dashboard</span>
                    </div>
                </a>
            </div>
            @can('manage brand')
            <div class="py-1 px-2">
                <a href="{{route('brands.index')}}">
                    <div class="flex items-center text-gray-200 fill-gray-200 hover:fill-white hover:text-white">
                        <span class="mr-1"><svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 512 512"><path d="M0 256a256 256 0 1 0 512 0A256 256 0 1 0 0 256zM241 377c-9.4 9.4-24.6 9.4-33.9 0s-9.4-24.6 0-33.9l87-87-87-87c-9.4-9.4-9.4-24.6 0-33.9s24.6-9.4 33.9 0L345 239c9.4 9.4 9.4 24.6 0 33.9L241 377z"/></svg></span>
                        <span>Brand</span>
                    </div>
                </a>
            </div>
            @endcan
            @can('manage category')
            <div class="py-1 px-2">
                <a href="{{route('categories.index')}}">
                    <div class="flex items-center text-gray-200 fill-gray-200 hover:fill-white hover:text-white">
                        <span class="mr-1"><svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 512 512"><path d="M0 256a256 256 0 1 0 512 0A256 256 0 1 0 0 256zM241 377c-9.4 9.4-24.6 9.4-33.9 0s-9.4-24.6 0-33.9l87-87-87-87c-9.4-9.4-9.4-24.6 0-33.9s24.6-9.4 33.9 0L345 239c9.4 9.4 9.4 24.6 0 33.9L241 377z"/></svg></span>
                        <span>Category</span>
                    </div>
                </a>
            </div>
            @endcan
            @can('manage product')
            <div class="py-1 px-2">
                <a href="{{route('products.index')}}">
                    <div class="flex items-center text-gray-200 fill-gray-200 hover:fill-white hover:text-white">
                        <span class="mr-1"><svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 512 512"><path d="M0 256a256 256 0 1 0 512 0A256 256 0 1 0 0 256zM241 377c-9.4 9.4-24.6 9.4-33.9 0s-9.4-24.6 0-33.9l87-87-87-87c-9.4-9.4-9.4-24.6 0-33.9s24.6-9.4 33.9 0L345 239c9.4 9.4 9.4 24.6 0 33.9L241 377z"/></svg></span>
                        <span>Product</span>
                    </div>
                </a>
            </div>
            @endcan
        </div>

        @canany(['manage cmo','manage customer','read customer','read cmo'])
        <div class="my-2">
            <div>
                <label class="text-gray-500 font-bold uppercase text-xs">Customer Data</label>
            </div>
            @canany(['manage customer','read customer'])
            <div class="py-1 px-2">
                <a href="{{route('customers.index')}}">
                    <div class="flex items-center text-gray-200 fill-gray-200 hover:fill-white hover:text-white">
                        <span class="mr-1"><svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 512 512"><path d="M0 256a256 256 0 1 0 512 0A256 256 0 1 0 0 256zM241 377c-9.4 9.4-24.6 9.4-33.9 0s-9.4-24.6 0-33.9l87-87-87-87c-9.4-9.4-9.4-24.6 0-33.9s24.6-9.4 33.9 0L345 239c9.4 9.4 9.4 24.6 0 33.9L241 377z"/></svg></span>
                        <span>Customer</span>
                    </div>
                </a>
            </div>
            @endcan
            @canany(['manage cmo','read cmo'])
            <div class="py-1 px-2">
                <a href="{{route('cmos.index')}}">
                    <div class="flex items-center text-gray-200 fill-gray-200 hover:fill-white hover:text-white">
                        <span class="mr-1"><svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 512 512"><path d="M0 256a256 256 0 1 0 512 0A256 256 0 1 0 0 256zM241 377c-9.4 9.4-24.6 9.4-33.9 0s-9.4-24.6 0-33.9l87-87-87-87c-9.4-9.4-9.4-24.6 0-33.9s24.6-9.4 33.9 0L345 239c9.4 9.4 9.4 24.6 0 33.9L241 377z"/></svg></span>
                        <span>CMO</span>
                    </div>
                </a>
            </div>
            @endcan
        </div>
        @endcanany

        @canany(['manage reportsales','manage reportinventorylevel'])
        <div class="my-2">
            <div>
                <label class="text-gray-500 font-bold uppercase text-xs">Daily Report</label>
            </div>
            @can('manage reportsales')
            <div class="py-1 px-2">
                <a href="{{route('reportsales.index')}}">
                    <div class="flex items-center text-gray-200 fill-gray-200 hover:fill-white hover:text-white">
                        <span class="mr-1"><svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 512 512"><path d="M0 256a256 256 0 1 0 512 0A256 256 0 1 0 0 256zM241 377c-9.4 9.4-24.6 9.4-33.9 0s-9.4-24.6 0-33.9l87-87-87-87c-9.4-9.4-9.4-24.6 0-33.9s24.6-9.4 33.9 0L345 239c9.4 9.4 9.4 24.6 0 33.9L241 377z"/></svg></span>
                        <span>Sales</span>
                    </div>
                </a>
            </div>
            @endcan
            @can('manage reportinventorylevel')
            <div class="py-1 px-2">
                <a href="{{route('reportinventories.index')}}">
                    <div class="flex items-center text-gray-200 fill-gray-200 hover:fill-white hover:text-white">
                        <span class="mr-1"><svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 512 512"><path d="M0 256a256 256 0 1 0 512 0A256 256 0 1 0 0 256zM241 377c-9.4 9.4-24.6 9.4-33.9 0s-9.4-24.6 0-33.9l87-87-87-87c-9.4-9.4-9.4-24.6 0-33.9s24.6-9.4 33.9 0L345 239c9.4 9.4 9.4 24.6 0 33.9L241 377z"/></svg></span>
                        <span>Inventory Level</span>
                    </div>
                </a>
            </div>
            @endcan
            @can('manage reportdeliveryplan')
            <div class="py-1 px-2">
                <a href="{{route('reportdeliveryplans.index')}}">
                    <div class="flex items-center text-gray-200 fill-gray-200 hover:fill-white hover:text-white">
                        <span class="mr-1"><svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 512 512"><path d="M0 256a256 256 0 1 0 512 0A256 256 0 1 0 0 256zM241 377c-9.4 9.4-24.6 9.4-33.9 0s-9.4-24.6 0-33.9l87-87-87-87c-9.4-9.4-9.4-24.6 0-33.9s24.6-9.4 33.9 0L345 239c9.4 9.4 9.4 24.6 0 33.9L241 377z"/></svg></span>
                        <span>Delivery Plan</span>
                    </div>
                </a>
            </div>
            @endcan
        </div>
        @endcanany

        
        @canany(['manage forecast'])
        <div class="my-2">
            <div>
                <label class="text-gray-500 font-bold uppercase text-xs">Monthly Report</label>
            </div>
            @can('manage forecast')
            <div class="py-1 px-2">
                <a href="{{route('forecasts.index')}}">
                    <div class="flex items-center text-gray-200 fill-gray-200 hover:fill-white hover:text-white">
                        <span class="mr-1"><svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 512 512"><path d="M0 256a256 256 0 1 0 512 0A256 256 0 1 0 0 256zM241 377c-9.4 9.4-24.6 9.4-33.9 0s-9.4-24.6 0-33.9l87-87-87-87c-9.4-9.4-9.4-24.6 0-33.9s24.6-9.4 33.9 0L345 239c9.4 9.4 9.4 24.6 0 33.9L241 377z"/></svg></span>
                        <span>Forecast</span>
                    </div>
                </a>
            </div>
            @endcan
        </div>
        @endcanany

        
        @canany(['manage reportsales'])
        <div class="my-2">
            <div>
                <label class="text-gray-500 font-bold uppercase text-xs">Summaries</label>
            </div>
            @can('manage reportsales')
            <div class="py-1 px-2">
                <a href="{{route('summaries.sales')}}">
                    <div class="flex items-center text-gray-200 fill-gray-200 hover:fill-white hover:text-white">
                        <span class="mr-1"><svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 512 512"><path d="M0 256a256 256 0 1 0 512 0A256 256 0 1 0 0 256zM241 377c-9.4 9.4-24.6 9.4-33.9 0s-9.4-24.6 0-33.9l87-87-87-87c-9.4-9.4-9.4-24.6 0-33.9s24.6-9.4 33.9 0L345 239c9.4 9.4 9.4 24.6 0 33.9L241 377z"/></svg></span>
                        <span>Sales</span>
                    </div>
                </a>
            </div>
            @endcan
            @can('manage reportsales')
            <div class="py-1 px-2">
                <a href="{{route('reportsalechecks.sales')}}">
                    <div class="flex items-center text-gray-200 fill-gray-200 hover:fill-white hover:text-white">
                        <span class="mr-1"><svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 512 512"><path d="M0 256a256 256 0 1 0 512 0A256 256 0 1 0 0 256zM241 377c-9.4 9.4-24.6 9.4-33.9 0s-9.4-24.6 0-33.9l87-87-87-87c-9.4-9.4-9.4-24.6 0-33.9s24.6-9.4 33.9 0L345 239c9.4 9.4 9.4 24.6 0 33.9L241 377z"/></svg></span>
                        <span>Sales Check (upload)</span>
                    </div>
                </a>
            </div>
            @endcan
        </div>
        @endcanany
        
        @canany(['manage user','manage uom','manage shipment','manage zone'])
        <div class="my-2">
            <div>
                <label class="text-gray-500 font-bold uppercase text-xs">Other Data</label>
            </div>
            @can('manage user')
            <div class="py-1 px-2">
                <a href="{{route('users.index')}}">
                    <div class="flex items-center text-gray-200 fill-gray-200 hover:fill-white hover:text-white">
                        <span class="mr-1"><svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 576 512"><path d="M512 80c8.8 0 16 7.2 16 16V416c0 8.8-7.2 16-16 16H64c-8.8 0-16-7.2-16-16V96c0-8.8 7.2-16 16-16H512zM64 32C28.7 32 0 60.7 0 96V416c0 35.3 28.7 64 64 64H512c35.3 0 64-28.7 64-64V96c0-35.3-28.7-64-64-64H64zM208 256a64 64 0 1 0 0-128 64 64 0 1 0 0 128zm-32 32c-44.2 0-80 35.8-80 80c0 8.8 7.2 16 16 16H304c8.8 0 16-7.2 16-16c0-44.2-35.8-80-80-80H176zM376 144c-13.3 0-24 10.7-24 24s10.7 24 24 24h80c13.3 0 24-10.7 24-24s-10.7-24-24-24H376zm0 96c-13.3 0-24 10.7-24 24s10.7 24 24 24h80c13.3 0 24-10.7 24-24s-10.7-24-24-24H376z"/></svg></span>
                        <span>User</span>
                    </div>
                </a>
            </div>
            @endcan
            @can('manage uom')
            <div class="py-1 px-2">
                <a href="{{route('uoms.index')}}">
                    <div class="flex items-center text-gray-200 fill-gray-200 hover:fill-white hover:text-white">
                        <span class="mr-1"><svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 448 512"><path d="M152 24c0-13.3-10.7-24-24-24s-24 10.7-24 24V64H64C28.7 64 0 92.7 0 128v16 48V448c0 35.3 28.7 64 64 64H384c35.3 0 64-28.7 64-64V192 144 128c0-35.3-28.7-64-64-64H344V24c0-13.3-10.7-24-24-24s-24 10.7-24 24V64H152V24zM48 192h80v56H48V192zm0 104h80v64H48V296zm128 0h96v64H176V296zm144 0h80v64H320V296zm80-48H320V192h80v56zm0 160v40c0 8.8-7.2 16-16 16H320V408h80zm-128 0v56H176V408h96zm-144 0v56H64c-8.8 0-16-7.2-16-16V408h80zM272 248H176V192h96v56z"/></svg></span>
                        <span>Uom</span>
                    </div>
                </a>
            </div>
            @endcan
            @can('manage shipment')
            <div class="py-1 px-2">
                <a href="{{route('shipments.index')}}">
                    <div class="flex items-center text-gray-200 fill-gray-200 hover:fill-white hover:text-white">
                        <span class="mr-1"><svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 512 512"><path d="M0 256a256 256 0 1 0 512 0A256 256 0 1 0 0 256zM241 377c-9.4 9.4-24.6 9.4-33.9 0s-9.4-24.6 0-33.9l87-87-87-87c-9.4-9.4-9.4-24.6 0-33.9s24.6-9.4 33.9 0L345 239c9.4 9.4 9.4 24.6 0 33.9L241 377z"/></svg></span>
                        <span>Shipment</span>
                    </div>
                </a>
            </div>
            @endcan
            @can('manage zone')
            <div class="py-1 px-2">
                <a href="{{route('zones.index')}}">
                    <div class="flex items-center text-gray-200 fill-gray-200 hover:fill-white hover:text-white">
                        <span class="mr-1"><svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 512 512"><path d="M0 256a256 256 0 1 0 512 0A256 256 0 1 0 0 256zM241 377c-9.4 9.4-24.6 9.4-33.9 0s-9.4-24.6 0-33.9l87-87-87-87c-9.4-9.4-9.4-24.6 0-33.9s24.6-9.4 33.9 0L345 239c9.4 9.4 9.4 24.6 0 33.9L241 377z"/></svg></span>
                        <span>Zone</span>
                    </div>
                </a>
            </div>
            @endcan
        </div>
        @endcanany

    </div>
</div>
