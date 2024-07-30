<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }} @if(isset($title)){{$title ? ' | '.$title : ''}}@endif</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Styles -->
        @livewireStyles
    </head>
    <body class="font-sans antialiased">
        <x-banner />

        <div class="min-h-screen w-full flex flex-wrap relative">

            <div id="sidebar" class="transition-all duration-150 ease-in-out min-h-screen fixed top-0 -left-full sm:left-0 sm:relative sm:flex-none w-3/4 sm:w-64 bg-gray-900">
                @livewire('loggedin.navigation-bar')
            </div>

            <div class="sm:flex-auto w-full sm:w-1/2">
                    <!-- Page Heading -->
                    @if (isset($header))
                        <header class="bg-white shadow">
                            <div class="mx-auto py-6 px-4 sm:px-6 lg:px-8">
                                <div class="w-full flex justify-between">
                                    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                                    {{ $header }}
                                    </h2>
                                    <button class="block sm:hidden" onclick="toggleSidebar()">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="fill-black h-5 w-5" viewBox="0 0 448 512">
                                            <path d="M0 96C0 78.3 14.3 64 32 64H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H32C14.3 128 0 113.7 0 96zM0 256c0-17.7 14.3-32 32-32H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H32c-17.7 0-32-14.3-32-32zM448 416c0 17.7-14.3 32-32 32H32c-17.7 0-32-14.3-32-32s14.3-32 32-32H416c17.7 0 32 14.3 32 32z"/>
                                        </svg>
                                    </button>       
                                </div>
                            </div>
                        </header>
                    @endif

                    <!-- Page Content -->
                    <main class="w-full bg-gray-800 min-h-[320px] sm:min-h-[620px]">
                        <div class="py-12">
                            <div class="mx-auto px-2 sm:px-6 lg:px-8">
                                <div class="bg-white p-2 overflow-hidden shadow-xl sm:rounded-lg">
                                @if (isset($contentTitle))
                                    <div class="mb-3">
                                        <h3 class="py-2 font-semibold">{{$contentTitle}}</h3>
                                        <hr>
                                    </div>
                                @endif
                                {{ $slot }}
                                </div>
                            </div>
                        </div>
                    </main>

            </div>
        </div>

        @stack('modals')

        <script>
            function toggleSidebar() {
                var sidebar = document.getElementById('sidebar');

                // Check if the sidebar has the '-left-full' class
                if (sidebar.classList.contains('-left-full')) {
                    // Remove the '-left-full' class
                    sidebar.classList.remove('-left-full');
                    // Add the 'left-0' class
                    sidebar.classList.add('left-0');
                } else {
                    // If the sidebar doesn't have '-left-full' class,
                    // add it back and remove 'left-0'
                    sidebar.classList.add('-left-full');
                    sidebar.classList.remove('left-0');
                }
            }
        </script>

        
        <script>
            document.addEventListener('livewire:init', () => {
                Livewire.on('alert-success', (event) => {
                        toastr.success(event.message)
                });
                Livewire.on('alert-error', (event) => {
                        toastr.error(event.message)
                });
                Livewire.on('alert-warning', (event) => {
                        toastr.warning(event.message)
                });
                Livewire.on('alert-info', (event) => {
                        toastr.info(event.message)
                });
            });
        </script>
        @livewireScripts
    </body>
</html>
