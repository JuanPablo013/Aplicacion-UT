<div class="bg-gray-100 py-8">
    <h2 class="text-2xl md:text-4xl text-gray-700 text-center font-extrabold mb-5">Buscar y Filtrar Novedades</h2>

    <div class="max-w-7xl mx-auto">
        <form
            wire:submit.prevent="leerDatosFormulario"
        >
            <div class="md:grid md:grid-cols-1 gap-5">
                {{-- <div class="mb-5">
                    <label 
                        class="block mb-1 text-sm text-gray-700 uppercase font-bold pl-1"
                        for="mes">Mes
                    </label>
                    <select 
                        id="mes"
                        class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 w-full"
                        wire:model="mes"
                    >
                        <option value="">-- Seleccione un mes --</option>
                        <option value="01">Enero</option>
                        <option value="02">Febrero</option>
                        <option value="03">Marzo</option>
                        <option value="04">Abril</option>
                        <option value="05">Mayo</option>
                        <option value="06">Junio</option>
                        <option value="07">Julio</option>
                        <option value="08">Agosto</option>
                        <option value="09">Septiembre</option>
                        <option value="10">Octubre</option>
                        <option value="11">Noviembre</option>
                        <option value="12">Diciembre</option>
                    </select>
                </div> --}}

                <div class="mb-5">
                    <label 
                        class="block mb-1 text-sm text-gray-700 uppercase font-bold pl-1"
                        for="semestre">Semestre
                    </label>
                    <select 
                        id="semestre"
                        class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 w-full"
                        wire:model="semestre"
                    >
                        <option value="">-- Seleccione un semestre --</option>
                        <option value="01">Semestre A (Febrero a Julio)</option>
                        <option value="02">Semestre B (Agosto a Diciembre)</option>
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

