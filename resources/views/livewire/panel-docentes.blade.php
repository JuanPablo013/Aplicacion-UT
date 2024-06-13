<div>

    <livewire:filtrar-docentes />

    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

        @forelse ($docentes as $docente)
            <div class="p-6 text-gray-900 md:flex md:justify-between md:items-center">
                <div class="space-y-3">
                    <a href="{{ route('docentes.show', $docente->id) }}" class="text-xl font-bold">
                        {{ $docente->docen_nombre }}
                    </a>
                    <p class="text-sm font-bold uppercase my-2">Documento:
                        <span class="font-normal normal-case">{{ $docente->docen_documento }}</span>
                    </p>
                    <p class="text-sm font-bold uppercase my-2">Lugar de Residencia:
                        <span class="font-normal normal-case">{{ $docente->lugarResidencia->divip_nommunicipio }}</span>
                    </p>
                    <p class="text-sm font-bold uppercase my-2">Tipo de Docente:
                        <span class="font-normal normal-case">{{ $docente->tipoDocente->docen_nombre }}</span>
                    </p>
                    <div class="max-w-xl overflow-auto my-2">
                        <p class="text-sm font-bold uppercase">Perfil Completo:
                            <span class="font-normal normal-case">{{ $docente->docen_perfilcompleto }}</span>
                        </p>
                    </div>
                    @if($docente->docen_clasificacionpregradoespecial)
                        <p class="text-sm font-bold uppercase text-red-600 my-2">Clasificación Pregrado Especial:
                            <span class="normal-case">{{ $docente->docen_clasificacionpregradoespecial }}</span>
                        </p>
                    @endif  
                    <p class="font-bold text-sm uppercase my-2">Creador del Docente:
                        <span class="normal-case">{{ $docente->user->name }}</span>
                    </p>
                </div>

                <div class="flex flex-col md:flex-row gap-4 items-stretch mt-5 md:mt-0">
                    <a
                        href="{{ route('proyectos.create', $docente->id) }}"
                        class="bg-yellow-400 py-2 px-4 rounded-lg text-white text-xs font-bold uppercase text-center"
                    >Generar Novedad</a>
                    <a
                        href="{{ route('docentes.estudios.create', $docente->id) }}"
                        class="bg-slate-800 py-2 px-4 rounded-lg text-white text-xs font-bold uppercase text-center"
                    >Agregar estudios</a>

                    @can('update', $docente)
                        <a
                            href="{{ route('docentes.edit', $docente->id) }}"
                            class="bg-blue-800 py-2 px-4 rounded-lg text-white text-xs font-bold uppercase text-center"
                        >Editar</a>
                    @endcan

                    @can('delete', $docente)
                        <form action="{{ route('docentes.destroy', $docente->id) }}" method="POST"
                            onsubmit="return confirm('¿Estás seguro de que quieres eliminar este docente?');">
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
            <p class="p-3 text-center text-sm text-gray-600">No hay docentes que mostrar</p>
        @endforelse
        
    </div>

    <div class="mt-10">
        {{ $docentes->links() }}
    </div>

</div>
