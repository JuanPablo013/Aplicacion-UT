<div>

    <livewire:filtrar-novedades />

    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

        <div class="p-10 text-gray-900 text-center">
            <a 
                href="{{ route('novedades.exportnovedades', ['semestre' => $semestre]) }}"
                class="ml-4 bg-green-500 hover:bg-green-600 transition-colors text-white text-sm font-bold px-10 py-2 rounded cursor-pointer uppercase">
                Descargar Reporte
            </a>
        </div>

        @forelse ($novedades as $novedad)
            <div class="p-6 text-gray-900 md:flex md:justify-between md:items-center">
                <div class="space-y-3">
                    <a href="{{ route('novedades.show', $novedad->id) }}" class="text-xl font-bold">
                        {{ $novedad->novedad_tipo }}
                    </a> 
                    <p class="text-sm font-bold uppercase my-2">Fecha de Inicio:
                        <span class="font-normal normal-case">{{ str_replace(' De ', ' de ', ucwords(\Carbon\Carbon::parse($novedad->novedad_fechainicio)->isoFormat('D [de] MMMM [de] YYYY'), " ")) }}</span>
                    </p>
                    <p class="text-sm font-bold uppercase my-2">Código del Programa y Nombre del Programa:
                        <span class="font-normal normal-case">{{ $novedad->programa->programa_codigo . ' - ' . $novedad->programa->programa_nombre }}</span>
                    </p>
                    <p class="text-sm font-bold uppercase my-2">Documento del Docente y Nombre Completo del Docente:
                        <span class="font-normal normal-case">{{ $novedad->docente->docen_documento . ' - ' . $novedad->docente->docen_nombre }}</span>
                    </p>
                    <p class="text-sm font-bold uppercase my-2">Tipo de Docente:
                        <span class="font-normal normal-case">{{ $novedad->docente->tipoDocente->docen_nombre }}</span>
                    </p>
                    <p class="text-sm font-bold uppercase my-2">Código del Cat y Nombre del Cat:
                        <span class="font-normal normal-case">{{ $novedad->cat->cat_codigo . ' - ' . $novedad->cat->cat_nombre }}</span>
                    </p> 
                    <p class="text-sm font-bold uppercase my-2">Soportes en PDF:
                        <span class="font-normal normal-case">
                            <a class="text-sm text-blue-800" href="{{ asset('storage/pdf/' . $novedad->novedad_soportes) }}" target="_blank">{{ $novedad->novedad_soportes }}</a>
                        </span>
                    </p> 
                    <p class="font-bold text-sm uppercase my-2">Creador del Docente:
                        <span class="normal-case">{{ $novedad->user->name }}</span>
                    </p>
                </div>

                <div class="flex flex-col md:flex-row gap-4 items-stretch mt-5 md:mt-0">
                    @can('update', $novedad)
                        <a
                            href="{{ route('novedades.edit', $novedad->id) }}"
                            class="bg-blue-800 py-2 px-4 rounded-lg text-white text-xs font-bold uppercase text-center"
                            >Editar
                        </a>
                    @endcan

                    @can('delete', $novedad) 
                        <form action="{{ route('novedades.destroy', $novedad->id) }}" method="POST"
                            onsubmit="return confirm('¿Estás seguro de que quieres eliminar esta novedad?');">
                            @csrf
                            @method('DELETE')
                                <button type="submit" class="bg-red-600 py-2 px-4 rounded-lg text-white text-xs font-bold uppercase text-center block w-full">
                                    Eliminar
                                </button>
                        </form>
                    @endcan
                </div>
            </div>
        @empty
            <p class="p-3 text-center text-sm text-gray-600">No hay novedades que mostrar</p>
        @endforelse
        
    </div>

    <div class="mt-10">
        {{ $novedades->links() }}
    </div> 

</div>

{{-- @push('scripts')
    
    
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
 
        document.addEventListener('livewire:initialized', () => {
            @this.on('mostrarAlerta', novedadId => {
                Swal.fire({
                    title: '¿Estás seguro, se eliminara la Novedad?',
                    text: "Una Novedad eliminada no se puede recuperar!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si, ¡Eliminar!',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        @this.dispatch('eliminarNovedad', {novedad: novedadId}); 
                        Swal.fire(
                            '¡Eliminado!',
                            'La Novedad se ha eliminado correctamente',
                            'success'
                        )
                    }
                })
            });
        });
 
    </script> 
    
@endpush   --}}
