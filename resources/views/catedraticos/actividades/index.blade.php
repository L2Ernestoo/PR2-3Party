@extends('layout')

@section('contenido')
    <h2>Registro de contenido educativo</h2>
    <form id="formActividad" action="{{route('actividades.store')}}" enctype="multipart/form-data" method="post">
        @csrf
        @if (count($errors) > 0)
            <div class="error">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
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
                <input name="file" type="file" class="form-control-file" id="file">
            </div>
            <div class="form-group col-md-6">
                <label for="inputDescripcion">Descripcion</label>
                <textarea name="descripcion" class="form-control" id="inputDescripcion" rows="3"></textarea>
            </div>
        </div>
        {!! htmlFormSnippet() !!}

        <button type="submit" class="btn btn-primary subirActividad">Subir Actividad</button>
    </form>
@endsection
<script>
    const formActividad = $('#formActividad');
    formActividad.submit(function(e) {
        e.preventDefault();
        subirActividad();
    });

    function subirActividad(){
        var data = new FormData(formActividad[0]);

        $.ajax({
            type: 'POST',
            contentType: false,
            processData: false,
            url: '{{route('actividades.store')}}',
            data: data,
            success: function (data) {
                setTimeout(function () {
                    location.reload();
                },1000)
            },
            error: function (data){
                toastr.warning("Contacte con el administrador los datos no pudieron ser ingresados!");
            }
        });
    }
</script>
