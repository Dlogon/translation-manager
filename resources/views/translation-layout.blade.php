<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="description" content="description here">
        <meta name="keywords" content="keywords,here">

        <title>{{ config('app.name', 'Translations') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css">
    <link rel="stylesheet" href="https://unpkg.com/tailwindcss@2.2.19/dist/tailwind.min.css" />
        <style>
            .bg-black-alt {
                background: #191919;
            }

            .text-black-alt {
                color: #191919;
            }

            .border-black-alt {
                border-color: #191919;
            }

        </style>
    </head>
    <body class="bg-black-alt font-sans leading-normal tracking-normal w-full">

        <div class="container w-full mx-auto">
            <div class="w-full px-4 md:px-0 md:mt-8 mb-16 text-gray-800 leading-normal">
                @include("translation-manager::navigation")
                <!-- Page Heading -->
                <header class="shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        @section('header')
                        @show
                    </div>
                </header>

                <!-- Page Content -->

                <div class="bg-gray-800 border border-gray-800 rounded shadow p-2">
                    <div class="flex flex-row items-center text-gray-200">
                        <main class="w-full">
                            @yield('content')
                        </main>
                    </div>
                </div>

            </div>
            <div class="tailwindAlert">
                <x-tailwindalerts::tailwind-alert/>
            </div>
        </div>
    @stack("js")
    </body>
</html>

