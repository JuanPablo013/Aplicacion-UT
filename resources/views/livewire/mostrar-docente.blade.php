<div class="p-10">
    <div class="mb-5">
        <h3 class="font-bold text-3xl text-gray-800 my-3">
            {{ $docente->docen_nombre }}
        </h3>

        <div class="md:grid md:grid-cols-2 bg-gray-50 p-4 my-10">
            <p class="font-bold text-sm uppercase text-gray-800 my-3">Documento:
                <span class="normal-case font-normal">{{ $docente->docen_documento }}</span>
            </p>

            <p class="font-bold text-sm uppercase text-gray-800 my-3">Correo Electrónico Institucional:
                <span class="normal-case font-normal">{{ $docente->docen_correoinst }}</span>
            </p>

            <p class="font-bold text-sm uppercase text-gray-800 my-3">Correo Electrónico Personal:
                <span class="normal-case font-normal">{{ $docente->docen_correopersonal }}</span>
            </p>

            <p class="font-bold text-sm uppercase text-gray-800 my-3">Teléfono:
                <span class="normal-case font-normal">{{ $docente->docen_telefono }}</span>
            </p>

            <p class="font-bold text-sm uppercase text-gray-800 my-3">Lugar de Residencia del Docente:
                <span class="normal-case font-normal">{{ $docente->lugarResidencia->divip_nommunicipio }}</span>
            </p>

            <p class="font-bold text-sm uppercase text-gray-800 my-3">Lugar de Expedición del Documento:
                <span class="normal-case font-normal">{{ $docente->lugarExpedicion->divip_nommunicipio }}</span>
            </p>

            <p class="font-bold text-sm uppercase text-gray-800 my-3">Tipo de Docente:
                <span class="normal-case font-normal">{{ $docente->tipoDocente->docen_nombre }}</span>
            </p>

            <p class="font-bold text-sm uppercase text-gray-800 my-3">Clasificación Pregrado del Docente:
                <span class="normal-case font-normal">{{ $docente->clasificacion->clasi_clasificacion }}</span>
            </p>

            <p class="font-bold text-sm uppercase text-gray-800 my-3">Acta de Clasificación Pregrado del Docente:
                <span class="normal-case font-normal">{{ $docente->docen_actaclasificacionpregrado }}</span>
            </p>

            <p class="font-bold text-sm uppercase text-gray-800 my-3">Fecha de Clasificación Pregrado del Docente:
                <span class="normal-case font-normal">{{ $docente->docen_fechaclasificacion }}</span>
            </p>

            <p class="font-bold text-sm uppercase text-gray-800 my-3">Perfil del Docente:
                <span class="normal-case font-normal">{{ $docente->docen_perfilcompleto }}</span>
            </p>

            @if($docente->docen_clasificacionposgrado)
                <p class="font-bold text-sm uppercase text-gray-800 my-3">Clasificación Posgrado:
                    <span class="normal-case font-normal">{{ $docente->docen_clasificacionposgrado }}</span>
                </p>
            @endif

            @if($docente->docen_clasificacionpregradoespecial)
                <p class="font-bold text-sm uppercase text-red-600 my-3">Clasificación Pregrado Especial:
                    <span class="normal-case font-bold">{{ $docente->docen_clasificacionpregradoespecial }}</span>
                </p>
            @endif

            <p class="font-bold text-sm uppercase text-gray-800 my-3">Creador del Docente:
                <span class="normal-case font-normal">{{ $docente->user->name }}</span>
            </p>
        </div>

        <h3 class="font-bold text-3xl text-gray-800 my-3"">Estudios:</h3>

        <!-- Mostrar los estudios -->
        <div class="divide-y divide-gray-200 bg-gray-50 p-4 my-10">
            @forelse($docente->estudios->sortByDesc('nivel.id') as $estudio)
                <div class="p-5 md:flex md:justify-between items-center">
                    <div>
                        <p class="font-bold text-sm uppercase text-gray-800 my-3">Titulo: 
                            <span class="normal-case font-normal">{{ $estudio->estud_titulo }} </span>
                        </p>
                        <p class="font-bold text-sm uppercase text-gray-800 my-3">Universidad: 
                            <span class="normal-case font-normal">{{ $estudio->estud_universidad }}</span>
                        </p> 
                        {{-- <p class="font-bold text-sm uppercase text-gray-800 my-3">Fecha del grado:
                            <span class="normal-case font-normal">{{ str_replace(' De ', ' de ', ucwords(\Carbon\Carbon::parse($estudio->estud_fechagrado)->isoFormat('D [de] MMMM [de] YYYY'), " ")) }}</span>
                        </p> --}}
                        <p class="font-bold text-sm uppercase text-gray-800 my-3">Nivel de Estudios: 
                            <span class="normal-case font-normal">{{ $estudio->nivel->nacad_nivel }}</span>
                        </p> 
                    </div>
                    <div class="mt-5 md:mt-0">
                        @can('update', $estudio)
                            <a href="{{ route('estudios.edit', ['docente' => $docente, 'estudio' => $estudio]) }}" class="block w-full md:w-auto bg-blue-800 p-3 text-sm uppercase font-bold text-white rounded-lg text-center mb-3">
                                Editar
                            </a>
                        @endcan
                        @can('delete', $estudio)
                            <button 
                            wire:click="$dispatch('mostrarAlerta', {id: {{ $estudio->id }}})"
                            href="{{ route('estudios.edit', ['docente' => $docente, 'estudio' => $estudio]) }}" class="block w-full md:w-auto bg-red-600 p-3 text-sm uppercase font-bold text-white rounded-lg text-center">
                                Eliminar
                            </button>
                        @endcan
                    </div>
                </div>
            @empty
                <span>No hay estudios registrados para este docente.</span>
            @endforelse
        </div>
    </div>
</div>

@push('scripts')
    
    
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
    
@endpush
