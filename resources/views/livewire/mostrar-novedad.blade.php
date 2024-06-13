<div class="p-10">
    <div class="mb-5">
        <h3 class="font-bold text-3xl text-gray-800 my-3">
            {{ $novedad->docente->docen_documento . ' - ' . $novedad->docente->docen_nombre . ' - ' . $novedad->docente->tipoDocente->docen_nombre }}
        </h3>

        <div class="md:grid md:grid-cols-2 bg-gray-50 p-4 my-10">

            {{-- <p class="font-bold text-sm uppercase text-gray-800 my-3">Documento de Identidad del Docente:
                <span class="normal-case font-normal"></span>
            </p>

            <p class="font-bold text-sm uppercase text-gray-800 my-3">Nombre Completo del Docente:
                <span class="normal-case font-normal"></span>
            </p> --}}

            <p class="font-bold text-sm uppercase text-gray-800 my-3">Tipo de Novedad:
                <span class="normal-case font-normal">{{ $novedad->novedad_tipo }}</span>
            </p>

            <p class="font-bold text-sm uppercase text-gray-800 my-3">Código del Programa:
                <span class="normal-case font-normal">{{ $novedad->programa->programa_codigo }}</span>
            </p>

            <p class="font-bold text-sm uppercase text-gray-800 my-3">Nombre del Programa:
                <span class="normal-case font-normal">{{ $novedad->programa->programa_nombre }}</span>
            </p>

            <p class="font-bold text-sm uppercase text-gray-800 my-3">Código del CAT:
                <span class="normal-case font-normal">{{ $novedad->cat->cat_codigo }}</span>
            </p>

            <p class="font-bold text-sm uppercase text-gray-800 my-3">Nombre del CAT:
                <span class="normal-case font-normal">{{ $novedad->cat->cat_nombre }}</span>
            </p>

            <p class="font-bold text-sm uppercase text-gray-800 my-3">Semestre:
                <span class="normal-case font-normal">{{ $novedad->novedad_semestre }}</span>
            </p>

            <p class="font-bold text-sm uppercase text-gray-800 my-3">Grupo:
                <span class="normal-case font-normal">{{ $novedad->novedad_grupo }}</span>
            </p>

            <p class="font-bold text-sm uppercase text-gray-800 my-3">Código de la Asignatura:
                <span class="normal-case font-normal">{{ $novedad->novedad_codigoasignatura }}</span>
            </p>

            <p class="font-bold text-sm uppercase text-gray-800 my-3">Nombre de la Asignatura:
                <span class="normal-case font-normal">{{ $novedad->novedad_nombreasignatura }}</span>
            </p>

            <p class="font-bold text-sm uppercase text-gray-800 my-3">Horas a Reportar:
                <span class="normal-case font-normal">{{ $novedad->novedad_horas }}</span>
            </p>

            <p class="font-bold text-sm uppercase text-gray-800 my-3">Número de Estudiantes:
                <span class="normal-case font-normal">{{ $novedad->novedad_numeroestudiantes }}</span>
            </p>

            <p class="font-bold text-sm uppercase text-gray-800 my-3">Desplazamiento:
                <span class="normal-case font-normal">{{ $novedad->novedad_desplazamiento }}</span>
            </p>

            <p class="font-bold text-sm uppercase text-gray-800 my-3">Número de Desplazamientos:
                <span class="normal-case font-normal">{{ $novedad->novedad_numerodesplazamiento }}</span>
            </p>

            <p class="font-bold text-sm uppercase text-gray-800 my-3">Observación:
                <span class="normal-case font-normal">{{ $novedad->novedad_observacion }}</span>
            </p>

            <p class="font-bold text-sm uppercase text-gray-800 my-3">Fecha de Inicio de Vinculación:
                <span class="normal-case font-normal">{{ str_replace(' De ', ' de ', ucwords(\Carbon\Carbon::parse($novedad->novedad_fechainicio)->isoFormat('D [de] MMMM [de] YYYY'), " ")) }}</span>
            </p>

            <p class="font-bold text-sm uppercase text-gray-800 my-3">Fecha Final de Vinculación:
                <span class="normal-case font-normal">{{ str_replace(' De ', ' de ', ucwords(\Carbon\Carbon::parse($novedad->novedad_fechafin)->isoFormat('D [de] MMMM [de] YYYY'), " ")) }}</span>
            </p>

            <p class="font-bold text-sm uppercase text-gray-800 my-3">Soportes:
                <span class="normal-case font-normal">
                    <a class="text-sm text-blue-800" href="{{ asset('storage/pdf/' . $novedad->novedad_soportes) }}" target="_blank">{{ $novedad->novedad_soportes }}</a>
                </span>
            </p>

            <p class="font-bold text-sm uppercase text-gray-800 my-3">Usuario Creador:
                <span class="normal-case font-normal">{{ $novedad->user->name }}</span>
            </p>

            <p class="font-bold text-sm uppercase text-gray-800 my-3">Fecha de Creación:
                <span class="normal-case font-normal">{{ str_replace(' De ', ' de ', ucwords(\Carbon\Carbon::parse($novedad->novedad_created_at)->isoFormat('D [de] MMMM [de] YYYY'), " ")) }}</span>
            </p>
        </div>
        
    </div>
</div>

{{-- @push('scripts')
    
    
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
 
        document.addEventListener('livewire:initialized', () => {
            @this.on('mostrarAlerta', estudioId => {
                Swal.fire({
                    title: '¿Estás seguro?',
                    text: "Un Estudio eliminado no se puede recuperar!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si, ¡Eliminar!',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                if (result.isConfirmed) {
                    //Eliminar el Docente desde el servidor
                    @this.dispatch('eliminarEstudio', {estudio: estudioId}); // Emitir evento para comunicarse con el servidor, le puse de nombre estudio y no id porque tienen que ser iguales con el de la funcion eliminarEstudio en el componente, y como quiero eliminar todo el registro del estudio, por eso ese nombre, estudioId es para recuperar el id del estudio que quiero eliminar
 
                    Swal.fire(
                        '¡Eliminado!',
                        'El Estudio se ha eliminado correctamente',
                        'success'
                    )
                }
            })
        });
    });
 
    </script>
    
@endpush --}}

