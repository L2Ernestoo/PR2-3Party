@extends('layout')

@section('contenido')
    <h2>Actividades</h2>
    <table class="table table-striped">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Fecha</th>
            <th scope="col">Descripcion</th>
            <th scope="col">Materia</th>
            <th scope="col">Grado</th>
            @if(\Illuminate\Support\Facades\Auth::user()->roles_id_rol === 2)
                <th scope="col">Catedratico</th>
            @endif
            <th scope="col">Archivo</th>
        </tr>
        </thead>
        <tbody>
        @foreach($actividades as $item)
        <tr>
            <th scope="row">{{$loop->iteration}}</th>
            <td>{{$item->created_at}}</td>
            <td>{{$item->descripcion}}</td>
            <td>{{$item->materia}}</td>
            <td>{{$item->grado}}</td>
            @if(\Illuminate\Support\Facades\Auth::user()->roles_id_rol === 2)
                <td>{{$item->catedratico}}</td>
            @endif
            <td><a href="/../storage/{{$item->url_actividad}}" target="_blank">Ver Archivo</a></td>
        </tr>
        @endforeach
        </tbody>
    </table>
@endsection
