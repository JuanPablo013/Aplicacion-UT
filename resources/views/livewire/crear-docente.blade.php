<form class="md:w-1/2 space-y-5" action="" wire:submit.prevent='crearDocente'>

    <div class="flex flex-col">
        <div class="flex items-start">
            <x-input-label 
                for="documento" 
                :value="__('Documento de identidad')" 
            />
            <span class="text-red-700 ml-2">*</span>
        </div>

        <x-text-input 
            id="documento" 
            class="block mt-1 w-full" 
            type="text" 
            wire:model="documento" 
            :value="old('documento')" 
            placeholder="Documento"
        />

        @error('documento')
            <livewire:mostrar-alerta :message="$message" />
        @enderror
    </div>

    {{-- Información desde la tabla Divipola --}}
    <div class="flex flex-col">
        <div class="flex items-start">
            <x-input-label 
                for="lugar_expedicion" 
                :value="__('Lugar de Expedición del Documento')" 
            />
            <span class="text-red-700 ml-2">*</span>
        </div>

        <select
            id="lugar_expedicion"
            wire:model="lugar_expedicion"
            class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full"
        >
            <option value="">-- Seleccione una opción --</option>
            @foreach ($divipola_ as $divipola)
                <option value="{{ $divipola->id }}">{{ $divipola->divip_nommunicipio }}</option>
            @endforeach
        </select>

        @error('lugar_expedicion')
            <livewire:mostrar-alerta :message="$message" />
        @enderror
    </div> 

    <div class="flex flex-col">
        <div class="flex items-start">
            <x-input-label 
                for="nombres" 
                :value="__('Nombres y Apellidos')" 
            />
            <span class="text-red-700 ml-2">*</span>
        </div>

        <x-text-input 
            id="nombres" 
            class="block mt-1 w-full" 
            type="text" 
            wire:model="nombres" 
            :value="old('nombres')" 
            placeholder="Nombres"
        />

        @error('nombres')
            <livewire:mostrar-alerta :message="$message" />
        @enderror
    </div>

    {{-- Información desde la tabla Divipola --}}
    <div class="flex flex-col">
        <div class="flex items-start">
            <x-input-label 
                for="lugar_residencia" 
                :value="__('Lugar de Residencia del Docente')" 
            />
            <span class="text-red-700 ml-2">*</span>
        </div>

        <select
            id="lugar_residencia"
            wire:model="lugar_residencia"
            class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full"
        >   
            <option value="">-- Seleccione una opción --</option>
            @foreach ($divipola_ as $divipola)
                <option value="{{ $divipola->id }}">{{ $divipola->divip_nommunicipio }}</option>
            @endforeach
        </select>

        @error('lugar_residencia')
            <livewire:mostrar-alerta :message="$message" />
        @enderror
    </div>

    <div class="flex flex-col">
        <div class="flex items-start">
            <x-input-label 
                for="telefono" 
                :value="__('Teléfono')" 
            />
            <span class="text-red-700 ml-2">*</span>
        </div>

        <x-text-input 
            id="telefono" 
            class="block mt-1 w-full" 
            type="text" 
            wire:model="telefono" 
            :value="old('telefono')" 
            placeholder="Teléfono"
        />

        @error('telefono')
            <livewire:mostrar-alerta :message="$message" />
        @enderror
    </div>

    <div class="flex flex-col">
        <div class="flex items-start">
            <x-input-label 
                for="correo_institucional" 
                :value="__('Correo Institucional')" 
            />
            <span class="text-red-700 ml-2">*</span>
        </div>

        <x-text-input 
            id="correo_institucional" 
            class="block mt-1 w-full" 
            type="text" 
            wire:model="correo_institucional" 
            :value="old('correo_institucional')" 
            placeholder="Correo Institucional"
        />

        @error('correo_institucional')
            <livewire:mostrar-alerta :message="$message" />
        @enderror
    </div>

    <div class="flex flex-col">
        <div class="flex items-start">
            <x-input-label 
                for="correo_personal" 
                :value="__('Correo Personal')" 
            />
            <span class="text-red-700 ml-2">*</span>
        </div>

        <x-text-input 
            id="correo_personal" 
            class="block mt-1 w-full" 
            type="text" 
            wire:model="correo_personal" 
            :value="old('correo_personal')" 
            placeholder="Correo Personal"
        />

        @error('correo_personal')
            <livewire:mostrar-alerta :message="$message" />
        @enderror
    </div>

    <div class="flex flex-col">
        <div class="flex items-start">
            <x-input-label 
                for="tipo_docente" 
                :value="__('Tipo de Docente')" 
            />
            <span class="text-red-700 ml-2">*</span>
        </div>

        <select
            id="tipo_docente"
            wire:model="tipo_docente"
            class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full"
        >
            <option value="">-- Seleccione una opción --</option>
            @foreach ($tipos as $tipo)
                <option value="{{ $tipo->id }}">{{ $tipo->docen_nombre }}</option>
            @endforeach
        </select>

        @error('tipo_docente')
            <livewire:mostrar-alerta :message="$message" />
        @enderror
    </div>
    
    {{-- Información desde la tabla Clasificación Docente --}}
    <div class="flex flex-col">
        <div class="flex items-start">
            <x-input-label 
                for="cdpr" 
                :value="__('Clasificación de Pregrado (CDPR)')" 
            />
            <span class="text-red-700 ml-2">*</span>
        </div>
        
        <select
            id="cdpr"
            wire:model="cdpr"
            class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full"
        >
            <option value="">-- Seleccione una opción --</option>
            @foreach ($clasificaciones as $clasificacion)
                <option value="{{ $clasificacion->id }}">{{ $clasificacion->clasi_clasificacion }}</option>
            @endforeach
        </select>

        @error('cdpr')
            <livewire:mostrar-alerta :message="$message" />
        @enderror
    </div>

    <div>
        <x-input-label 
            for="clasificacion_especial" 
            :value="__('Clasificación de Pregadro Especial (Solo si aplica)')" 
        />
        <select
            id="clasificacion_especial"
            wire:model="clasificacion_especial"
            class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full"
        >
            <option value="">-- Seleccione una opción --</option>
            <option value="Garante">Garante</option>
            <option value="Diplomado">Diplomado</option>
        </select>

        @error('clasificacion_especial')
            <livewire:mostrar-alerta :message="$message" />
        @enderror
    </div>

    <div class="flex flex-col">
        <div class="flex items-start">
            <x-input-label 
                for="cdpra" 
                :value="__('Acta de Clasificación de Pregrado (CDPRA)')" 
            />
            <span class="text-red-700 ml-2">*</span>
        </div>

        <x-text-input 
            id="cdpra" 
            class="block mt-1 w-full" 
            type="text" 
            wire:model="cdpra" 
            :value="old('cdpra')" 
            placeholder="CDPRA"
        />

        @error('cdpra')
            <livewire:mostrar-alerta :message="$message" />
        @enderror
    </div>

    <div class="flex flex-col">
        <div class="flex items-start">
            <x-input-label 
                for="cdprf" 
                :value="__('Fecha de Clasificación de Pregrado (CDPRF)')" 
            />
            <span class="text-red-700 ml-2">*</span>
        </div>

        <x-text-input 
            id="cdprf" 
            class="block mt-1 w-full" 
            type="text" 
            wire:model="cdprf" 
            :value="old('cdprf')" 
            placeholder="CDPRF"
        />

        @error('cdprf')
            <livewire:mostrar-alerta :message="$message" />
        @enderror
    </div>

    <div>
        <x-input-label 
            for="cdpo" 
            :value="__('Clasificación de Posgrado (CDPO)')" 
        />
        
        <x-text-input 
            id="cdpo" 
            class="block mt-1 w-full" 
            type="text" 
            wire:model="cdpo" 
            :value="old('cdpo')" 
            placeholder="CDPO"
        />

        @error('cdpo')
            <livewire:mostrar-alerta :message="$message" />
        @enderror
    </div>

    {{-- Información desde la tabla Niveles --}}
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

    {{-- <div>
        <x-input-label 
            for="perfil_completo" 
            :value="__('Perfil Completo del Docente')" 
        />
        <textarea 
            wire:model="perfil_completo"
            placeholder="Por favor ingrese el perfil completo del Docente"
            class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full h-36"
            disabled
        ></textarea> 

        @error('perfil_completo')
            <livewire:mostrar-alerta :message="$message" />
        @enderror
    </div> --}}

    <x-primary-button>
        Ingresar Docente
    </x-primary-button>

</form>

