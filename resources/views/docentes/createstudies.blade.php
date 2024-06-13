<x-app-layout>
    {{-- <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Crear Estudios') }}
        </h2>
    </x-slot> --}}

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h1 class="text-2xl font-bold text-center my-10">Ingresar más Estudios</h1>

                    @if (session()->has('mensaje'))
                        <div class="uppercase border border-green-600 bg-green-100 text-green-600 font-bold p-2 my-3 text-sm">
                            {{ session('mensaje') }}
                        </div>
                    @endif

                    <div class="md:flex md:justify-center p-5">
                        <livewire:crear-estudios-docente 
                            :docente="$docente"
                        />
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
