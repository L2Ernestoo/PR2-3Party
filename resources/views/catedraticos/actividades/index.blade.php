@extends('layout')

@section('contenido')
    <h2>Registro de contenido educativo</h2>
    <form action="{{route('actividades.store')}}" enctype="multipart/form-data" method="post">
        <div class="row">
            <div class="form-group col-md-4">
                <label for="inputMateria">Materia</label>
                <select name="materia" id="inputMateria" class="form-control">
                    <option selected>Seleccionar...</option>
                    @foreach($materias as $item)
                        <option value="{{$item->id_materia}}">{{$item->descripcion}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-md-4">
                <label for="inputGrado">Grado</label>
                <select name="grado" id="inputGrado" class="form-control">
                    <option selected>Seleccionar...</option>
                    @foreach($grados as $item)
                        <option value="{{$item->id_grado}}">{{$item->descripcion}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-md-6">
                <label for="file">Archivo</label>
                <input name="archivo" type="file" class="form-control-file" id="file">
            </div>
            <div class="form-group col-md-6">
                <label for="inputDescripcion">Descripcion</label>
                <textarea name="descripcion" class="form-control" id="inputDescripcion" rows="3"></textarea>
            </div>
        </div>
    </form>
@endsection
