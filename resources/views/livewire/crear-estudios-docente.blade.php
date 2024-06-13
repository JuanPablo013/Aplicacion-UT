<form class="md:w-1/2 space-y-5" action="" wire:submit.prevent='crearEstudios'>

    <div class="flex flex-col">
        <div class="flex items-start">
            <x-input-label
                for="documento" 
                :value="__('Documento Docente')" 
            />
            <span class="text-red-700 ml-2">*</span>
        </div>
           
        <x-text-input 
            id="documento" 
            class="block mt-1 w-full" 
            type="text" 
            wire:model="documento" 
            readonly
        />
    </div>

    <div class="flex flex-col">
        <div class="flex items-start">
            <x-input-label
                for="nombres" 
                :value="__('Nombres y Apellidos Docente')" 
            />
            <span class="text-red-700 ml-2">*</span>
        </div>
           
        <x-text-input 
            id="nombres" 
            class="block mt-1 w-full" 
            type="text" 
            wire:model="nombres" 
            readonly
        />
    </div>

    <div class="flex flex-col">
        <div class="flex items-start">
            <x-input-label 
                for="nivel_estudios" 
                :value="__('Nivel Estudios')" 
            />
            <span class="text-red-700 ml-2">*</span>
        </div>

        <select
            id="nivel_estudios"
            wire:model="nivel_estudios"
            class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full"
        >
            <option value="">-- Seleccione una opción --</option>
            @foreach ($niveles as $nivel)
                <option value="{{ $nivel->id }}">{{ $nivel->nacad_nivel }}</option>
            @endforeach
        </select>

        @error('nivel_estudios')
            <livewire:mostrar-alerta :message="$message" />
        @enderror
    </div>

    <div class="flex flex-col">
        <div class="flex items-start">
            <x-input-label 
                for="nombre_titulo" 
                :value="__('Titulo')" 
            />
            <span class="text-red-700 ml-2">*</span>
        </div>

        <x-text-input 
            id="nombre_titulo" 
            class="block mt-1 w-full" 
            type="text" 
            wire:model="nombre_titulo" 
            :value="old('nombre_titulo')" 
            placeholder="Nombre del Título"
        />

        @error('nombre_titulo')
            <livewire:mostrar-alerta :message="$message" />
        @enderror
    </div> 

    <div class="flex flex-col">
        <div class="flex items-start">
            <x-input-label 
                for="universidad" 
                :value="__('Universidad')" 
            />
            <span class="text-red-700 ml-2">*</span>
        </div>

        <x-text-input 
            id="universidad" 
            class="block mt-1 w-full" 
            type="text" 
            wire:model="universidad" 
            :value="old('universidad')" 
            placeholder="Universidad"
        />

        @error('universidad')
            <livewire:mostrar-alerta :message="$message" />
        @enderror
    </div>


    {{-- <div class="flex flex-col">
        <div class="flex items-start">
            <x-input-label 
                for="fecha_grado" 
                :value="__('Fecha del grado')" 
            />
            <span class="text-red-700 ml-2">*</span>
        </div>

        <x-text-input 
            id="fecha_grado" 
            class="block mt-1 w-full" 
            type="date" 
            wire:model="fecha_grado" 
            :value="old('fecha_grado')" 
            placeholder="Fecha del grado"
        />

        @error('fecha_grado')
            <livewire:mostrar-alerta :message="$message" />
        @enderror
    </div> --}}

    <x-primary-button>
        Ingresar Estudios
    </x-primary-button>

</form>


