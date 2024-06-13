<table>
    <thead>
    <tr>
        <th>Documento de Identidad del Docente</th>
        <th>Nombre del Docente</th>
        <th>Tipo de Docente</th>
        <th>Tipo de Novedad</th>
        <th>Código del Programa</th>
        <th>Nombre del Programa</th>
        <th>Código del CAT</th>
        <th>Nombre del CAT</th>
        <th>Semestre</th>
        <th>Grupo</th>
        <th>Código de la Asignatura</th>
        <th>Nombre de la Asignatura</th>
        <th>Horas a Reportar</th>
        <th>Número de Estudiantes</th>
        <th>Desplazamiento</th>
        <th>Número de Desplazamientos</th>
        <th>Observación</th>
        <th>Fecha de Inicio de Vinculación</th>
        <th>Fecha Final de Vinculación</th>
        <th>Soportes</th>
        <th>Usuario Creador</th>
        <th>Fecha de Creación</th>
        <th>Acumulado de Horas</th>
    </tr>
    </thead>
    <tbody>
    @foreach($novedades as $novedad)
        <tr>
            <td>{{ $novedad->docente->docen_documento }}</td>
            <td>{{ $novedad->docente->docen_nombre }}</td>
            <td>{{ $novedad->docente->tipoDocente->docen_nombre }}</td>
            <td>{{ $novedad->novedad_tipo }}</td>
            <td>{{ $novedad->programa->programa_codigo }}</td>
            <td>{{ $novedad->programa->programa_nombre }}</td>
            <td>{{ $novedad->cat->cat_codigo }}</td>
            <td>{{ $novedad->cat->cat_nombre }}</td>
            <td>{{ $novedad->novedad_semestre }}</td>
            <td>{{ $novedad->novedad_grupo }}</td>
            <td>{{ $novedad->novedad_codigoasignatura }}</td>
            <td>{{ $novedad->novedad_nombreasignatura }}</td>
            <td>{{ $novedad->novedad_horas }}</td>
            <td>{{ $novedad->novedad_numeroestudiantes }}</td>
            <td>{{ $novedad->novedad_desplazamiento }}</td>
            <td>{{ $novedad->novedad_numerodesplazamiento }}</td>
            <td>{{ $novedad->novedad_observacion }}</td>
            <td>{{ $novedad->novedad_fechainicio }}</td>
            <td>{{ $novedad->novedad_fechafin }}</td>
            <td>{{ asset('storage/pdf/' . $novedad->novedad_soportes) }}</td>
            <td>{{ $novedad->user->name }}</td>
            <td>{{ $novedad->created_at }}</td>
            <td>{{ $novedad->docente->docen_horastotales }}</td>
        </tr>
    @endforeach
    </tbody>
</table>