<x-app-layout>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h1 class="text-2xl font-bold text-center my-10">
                        Editar Novedad: {{ $novedad->novedad_tipo }}
                    </h1>

                    <div class="md:flex md:justify-center p-5">
                        <livewire:editar-novedad
                            :novedad="$novedad"
                        />
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
