<form class="md:w-1/2 space-y-5" action="" wire:submit.prevent='crearProyecto' enctype="multipart/form-data">

    <div class="flex flex-col">
        <div class="flex items-start">
            <x-input-label 
                for="documentoynombre_docente" 
                :value="__('Documento de Identidad del Docente y Nombre Completo del Docente')"
            />
            <span class="text-red-700 ml-2">*</span>
        </div>

        <x-text-input 
            id="documentoynombre_docente" 
            class="block mt-1 w-full" 
            type="text" 
            wire:model="documentoynombre_docente" 
            readonly
        />
    </div>

    <div class="flex flex-col">
        <div class="flex items-start">
            <x-input-label 
                for="tipo_novedad" 
                :value="__('Tipo de Novedad a Reportar')"
            />
            <span class="text-red-700 ml-2">*</span>
        </div>
    
        <select 
            id="tipo_novedad" 
            wire:model="tipo_novedad" 
            class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full"
        >
            <option value="">-- Seleccione una opción --</option>
            @foreach ($novedades as $novedad)
                <option value="{{ $novedad->novedad_nombre }}">{{ $novedad->novedad_nombre }}</option>
            @endforeach
        </select>
    
        @error('tipo_novedad')
            <livewire:mostrar-alerta :message="$message" />
        @enderror
    </div>

    <div class="flex flex-col">
        <div class="flex items-start">
            <x-input-label 
                for="pdf" 
                :value="__('Soportes que justifican la vinculación según lo solicitado en oficio 101-1155')" 
                />
            <span class="text-red-700 ml-2">*</span>
        </div>
        <span class="text-sm text-gray-600 mb-2">En un solo archivo PDF</span>
        
        <x-text-input 
            id="pdf" 
            type="file" 
            wire:model="pdf" 
            accept=".pdf" 
            class="block mt-1 w-full" 
        />
    
        @error('pdf')
            <livewire:mostrar-alerta :message="$message"/>
        @enderror
    </div>

    <div class="flex flex-col">
        <div class="flex items-start">
            <x-input-label 
                for="codigo_programa" 
                :value="__('Código del Programa y Programa Académico')" 
            />
            <span class="text-red-700 ml-2">*</span>
        </div>

        <select
            id="codigo_programa"
            wire:model="codigo_programa"
            class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full"
        >
            <option value="">-- Seleccione una opción --</option>
            @foreach ($programas as $programa)
                <option value="{{ $programa->id }}">{{ $programa->programa_codigo . ' - ' . $programa->programa_nombre }}</option>
            @endforeach
        </select>

        @error('codigo_programa')
            <livewire:mostrar-alerta :message="$message" />
        @enderror
    </div>

    <div class="flex flex-col">
        <div class="flex items-start">
            <x-input-label 
                for="codigo_cat" 
                :value="__('Código del CAT y Nombre del CAT')" 
            />
            <span class="text-red-700 ml-2">*</span>
        </div>
        <span class="text-sm text-gray-600 mb-2">Centro de Atención Tutorial</span>

        <select
            id="codigo_cat"
            wire:model="codigo_cat"
            class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full"
        >
            <option value="">-- Seleccione una opción --</option>
            @foreach ($cats as $cat)
                <option value="{{ $cat->id }}">{{ $cat->cat_codigo . ' - ' . $cat->cat_nombre }}</option>
            @endforeach
        </select>

        @error('codigo_cat')
            <livewire:mostrar-alerta :message="$message" />
        @enderror
    </div>

    <div class="flex flex-col">
        <div class="flex items-start">
            <x-input-label 
                for="semestre" 
                :value="__('Semestre')" 
            />
            <span class="text-red-700 ml-2">*</span>
        </div>
        <span class="text-sm text-gray-600 mb-2">Solo si se van a reportar cursos de planes de estudio</span>

        <select 
            id="semestre" 
            wire:model="semestre" 
            class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full"
        >
            <option value="">-- Seleccione una opción --</option>
            <option value="NA">NA</option>
            <option value="I">I</option>
            <option value="II">II</option>
            <option value="III">III</option>
            <option value="IV">IV</option>
            <option value="V">V</option>
            <option value="VI">VI</option>
            <option value="VII">VII</option>
            <option value="VIII">VIII</option>
            <option value="IX">IX</option>
            <option value="X">X</option>
        </select>

        @error('semestre')
            <livewire:mostrar-alerta :message="$message" />
        @enderror
    </div>

    <div class="flex flex-col">
        <div class="flex items-start">
            <x-input-label 
                for="numero_grupo" 
                :value="__('Número del grupo')" 
            />
            <span class="text-red-700 ml-2">*</span>
        </div>
        <span class="text-sm text-gray-600 mb-2">Si corresponde a grupo creado en plataforma</span>

        <select 
            id="numero_grupo" 
            wire:model="numero_grupo" 
            class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full"
        >
            <option value="">-- Seleccione una opción --</option>
            <option value="01">01</option>
            <option value="02">02</option>
            <option value="03">03</option>
            <option value="04">04</option>
            <option value="05">05</option>
            <option value="NA">NA</option>
        </select>

        @error('numero_grupo')
            <livewire:mostrar-alerta :message="$message" />
        @enderror
    </div>

    <div class="flex flex-col">
        <div class="flex items-start">
            <x-input-label 
                for="codigo_asignatura"
                :value="__('Código de la Asignatura')" 
            />
            <span class="text-red-700 ml-2">*</span>
        </div>
        <span class="text-sm text-gray-600 mb-2">Si es un proceso diferente indique NA</span>

        <x-text-input 
            id="codigo_asignatura" 
            class="block mt-1 w-full" 
            type="text" 
            wire:model="codigo_asignatura" 
            :value="old('codigo_asignatura')" 
            placeholder="Código de la Asignatura"
        />

        @error('codigo_asignatura')
            <livewire:mostrar-alerta :message="$message" />
        @enderror
    </div> 

    <div class="flex flex-col">
        <div class="flex items-start">
            <x-input-label 
                for="nombre_asignatura" 
                :value="__('Nombre de la Asignatura o Nombre Completo del Diplomado, Seminario o Trabajo de Grado')" 
            />
            <span class="text-red-700 ml-2">*</span>
        </div>

        <x-text-input 
            id="nombre_asignatura" 
            class="block mt-1 w-full" 
            type="text" 
            wire:model="nombre_asignatura" 
            :value="old('nombre_asignatura')" 
            placeholder="Nombre de la Asignatura"
        />

        @error('nombre_asignatura')
            <livewire:mostrar-alerta :message="$message" />
        @enderror
    </div>

    <div class="flex flex-col">
        <div class="flex items-start">
            <x-input-label 
                for="total_horas" 
                :value="__('Horas a Reportar')" 
            />
            <span class="text-red-700 ml-2">*</span>
        </div>

        <x-text-input 
            id="total_horas" 
            class="block mt-1 w-full" 
            type="text" 
            wire:model="total_horas" 
            :value="old('total_horas')" 
            placeholder="Horas a Reportar"
        />

        @error('total_horas')
            <livewire:mostrar-alerta :message="$message" />
        @enderror
    </div>

    <div class="flex flex-col">
        <div class="flex items-start">
            <x-input-label 
                for="numero_estudiantes" 
                :value="__('Número de Estudiantes')" 
            />
            <span class="text-red-700 ml-2">*</span>
        </div>

        <select 
            id="numero_estudiantes" 
            wire:model="numero_estudiantes" 
            class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full"
            wire:ignore
        >
        <option value="">-- Seleccione una opción --</option>
            <option value="0">0</option>
            <option value="1 a 10">1 a 10</option>
            <option value="11 a 35">11 a 35</option>
            <option value="Mas de 35">Mas de 35</option>
        </select>

        @error('numero_estudiantes')
            <livewire:mostrar-alerta :message="$message" />
        @enderror
    </div>

    <div class="flex flex-col">
        <div class="flex items-start">
            <x-input-label 
                for="desplazamiento" 
                :value="__('Desplazamiento')" 
            />
            {{-- <span class="text-red-700 ml-2">*</span> --}}
        </div>
        <span class="text-sm text-gray-600 mb-2">Si requiere por favor refiera lugar de origen y lugar de llegada</span>

        <x-text-input 
            id="desplazamiento" 
            class="block mt-1 w-full" 
            type="text" 
            wire:model="desplazamiento" 
            :value="old('desplazamiento')" 
            placeholder="Desplazamiento"
        />

        @error('desplazamiento')
            <livewire:mostrar-alerta :message="$message" />
        @enderror
    </div>

    <div class="flex flex-col">
        <div class="flex items-start">
            <x-input-label 
                for="numero_desplazamientos" 
                :value="__('Número de Desplazamientos')" 
            />
            {{-- <span class="text-red-700 ml-2">*</span> --}}
        </div>

        <x-text-input 
            id="numero_desplazamientos" 
            class="block mt-1 w-full" 
            type="text" 
            wire:model="numero_desplazamientos" 
            :value="old('numero_desplazamientos')" 
            placeholder="Número de Desplazamientos"
        />

        @error('numero_desplazamientos')
            <livewire:mostrar-alerta :message="$message" />
        @enderror
    </div>

    <div class="flex flex-col">
        <div class="flex items-start">
            <x-input-label 
                for="observacion" 
                :value="__('Observación')" 
            />
            {{-- <span class="text-red-700 ml-2">*</span> --}}
        </div>
        <span class="text-sm text-gray-600 mb-2">Nombre del trabajo y estudiante que fue asesorado, nombre del estudiante que requirio la convocatoria institucional y si se requiere elaboración de guía o solo examen</span>

        <x-text-input 
            id="observacion" 
            class="block mt-1 w-full" 
            type="text" 
            wire:model="observacion" 
            :value="old('observacion')" 
            placeholder="Observación"
        />

        @error('observacion')
            <livewire:mostrar-alerta :message="$message" />
        @enderror
    </div>

    <div class="flex flex-col">
        <div class="flex items-start">
            <x-input-label 
                for="fecha_inicio" 
                :value="__('Fecha de Inicio de Vinculación')" 
            />
            <span class="text-red-700 ml-2">*</span>
        </div>

        <x-text-input 
            id="fecha_inicio" 
            class="block mt-1 w-full" 
            type="date" 
            wire:model="fecha_inicio" 
            :value="old('fecha_inicio')" 
            placeholder="Fecha de Inicio de Vinculación"
        />

        @error('fecha_inicio')
            <livewire:mostrar-alerta :message="$message" />
        @enderror
    </div>

    <div class="flex flex-col">
        <div class="flex items-start">
            <x-input-label 
                for="fecha_final" 
                :value="__('Fecha Final de Vinculación')" 
            />
            <span class="text-red-700 ml-2">*</span>
        </div>

        <x-text-input 
            id="fecha_final" 
            class="block mt-1 w-full" 
            type="date" 
            wire:model="fecha_final" 
            :value="old('fecha_final')" 
            placeholder="Fecha Final de Vinculación"
        />

        @error('fecha_final')
            <livewire:mostrar-alerta :message="$message" />
        @enderror
    </div>

    <x-primary-button>
        Ingresar Proyecto
    </x-primary-button>

    @push('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            let selectTipoNovedad = document.getElementById("tipo_novedad");
            let selectNumeroEstudiantes = document.getElementById("numero_estudiantes");

            selectTipoNovedad.addEventListener("change", function() {
                let selectedValue = this.value;
                if (selectedValue === "Proyecto de Investigacion" || selectedValue === "Semillero de Investigacion" || selectedValue === "Grupo de Investigacion" || selectedValue === "Proyeccion Social" || selectedValue === "Representacion CD" || selectedValue === "Representacion CA" || selectedValue === "Elaboracion Portafolio" || selectedValue === "Diseño de Cursos Virtuales" || selectedValue === "Estudios de Homologacion") {
                    // Mostrar solo la opción de 0
                    showEspecialesOptions();
                } else {
                    // Mostrar opciones generales
                    showGeneralOptions();
                }
            });

            function showGeneralOptions() {
                // Mostrar opciones generales
                document.querySelector("#numero_estudiantes option[value='1 a 10']").hidden = false;
                document.querySelector("#numero_estudiantes option[value='11 a 35']").hidden = false;
                document.querySelector("#numero_estudiantes option[value='Mas de 35']").hidden = false;

                document.querySelector("#numero_estudiantes option[value='0']").hidden = true;
            }

            function showEspecialesOptions() {
                // Ocultar todas las opciones excepto la de 0
                document.querySelector("#numero_estudiantes option[value='1 a 10']").hidden = true;
                document.querySelector("#numero_estudiantes option[value='11 a 35']").hidden = true;
                document.querySelector("#numero_estudiantes option[value='Mas de 35']").hidden = true;

                // Mostrar solo la opción de 0
                document.querySelector("#numero_estudiantes option[value='0']").hidden = false;
            }
        });
    </script>
    @endpush

</form>
