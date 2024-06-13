<div class="bg-gray-100 py-8">
    <h2 class="text-2xl md:text-4xl text-gray-700 text-center font-extrabold mb-5">Buscar y Filtrar Docentes</h2>

    <div class="max-w-7xl mx-auto">
        <form
            wire:submit.prevent="leerDatosFormulario"
        >
            <div class="md:grid md:grid-cols-3 gap-5">
                <div class="mb-5">
                    <label 
                        class="block mb-1 text-sm text-gray-700 uppercase font-bold pl-1"
                        for="termino">Término de Búsqueda
                    </label>
                    <input 
                        id="termino"
                        type="text"
                        placeholder="Buscar por Nombre: ej. Juan"
                        class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 w-full"
                        wire:model="termino"
                    />
                </div>

                <div class="mb-5">
                    <label 
                        class="block mb-1 text-sm text-gray-700 uppercase font-bold "
                        for="identificacion">Término de Búsqueda
                    </label>
                    <input 
                        id="identificacion"
                        type="text"
                        placeholder="Buscar por Número de Identificación"
                        class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 w-full"
                        wire:model="identificacion"
                    />
                </div>

                <div class="mb-5">
                    <label class="block mb-1 text-sm text-gray-700 uppercase font-bold">Ciudad de Residencia</label>
                    <select wire:model="ciudad" class="border-gray-300 p-2 w-full">
                        <option>--Seleccione--</option>
            
                        @foreach ($divipola_ as $divipola )
                            <option value="{{ $divipola->id }}">{{ $divipola->divip_nommunicipio }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="flex justify-end">
                <input 
                    type="submit"
                    class="bg-indigo-500 hover:bg-indigo-600 transition-colors text-white text-sm font-bold px-10 py-2 rounded cursor-pointer uppercase w-full md:w-auto"
                    value="Buscar"
                />
            </div>
        </form>
    </div>
</div>
