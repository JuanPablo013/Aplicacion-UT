<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h1 class="text-2xl font-bold text-center my-5">Reporte Vinculación</h1>
                    <h2 class="text-xl font-bold text-center my-2">{{ trans('messages.months.' . date('F')) }} {{ date('Y') }}</h2>

                    <div class="md:flex md:justify-center p-5">
                        <livewire:crear-proyectos 
                            :docente="$docente"
                        />
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>