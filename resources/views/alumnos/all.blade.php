@extends('layout')

@section('contenido')
    <h2>Tareas</h2>
    <table class="table table-striped">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Fecha</th>
            <th scope="col">Descripcion</th>
            @if(\Illuminate\Support\Facades\Auth::user()->roles_id_rol === 1)
                <th scope="col">Alumno</th>
            @endif
            <th scope="col">Archivo</th>
        </tr>
        </thead>
        <tbody>
        @foreach($tareas as $item)
            <tr>
                <th scope="row">{{$loop->iteration}}</th>
                <td>{{$item->created_at}}</td>
                <td>{{$item->descripcion}}</td>
                @if(\Illuminate\Support\Facades\Auth::user()->roles_id_rol === 1)
                    <td>{{$item->alumno}}</td>
                @endif
                <td><a href="/../storage/{{$item->url_entrega}}" target="_blank">Ver Tarea</a></td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
