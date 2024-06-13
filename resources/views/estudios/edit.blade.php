<x-app-layout>
    {{-- <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar Estudios') }}
        </h2>
    </x-slot> --}}

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h1 class="text-2xl font-bold text-center my-5">
                        Editar Estudios de: {{ $docente->docen_nombre }}
                    </h1>

                    <h2 class="text-xl font-bold text-center my-5">
                        Estudio a editar: {{ $estudio->estud_titulo }}
                    </h2>

                    <div class="md:flex md:justify-center p-5">
                        <livewire:editar-estudio
                            :docente="$docente"
                            :estudio="$estudio"
                        />
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
