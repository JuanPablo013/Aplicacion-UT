<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Inicio') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if (session()->has('mensaje'))
                <div class="uppercase border border-green-600 bg-green-100 text-green-600 font-bold p-2 my-3 text-sm">
                    {{ session('mensaje') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("Página de Inicio") }}
                </div>
                <div class="flex justify-center items-center p-9">
                    <picture>
                        <source srcset="{{ asset('images/CidHBGLc_400x400.webp') }}" type="image/webp">
                        <img src="{{ asset('images/CidHBGLc_400x400.png') }}" alt="Logo de la Universidad y del IDEAD">
                    </picture>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
