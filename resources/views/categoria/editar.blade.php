@extends('adminlte::page')

@section('title', 'Editar Categoria')

@section('content_header')
    <h1>Editar Categoria</h1>
@stop

@section('content')
    <div class="card card-primary">
        <div class="card-header">
        <h3 class="card-title">Formulario</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <!--<form action="{{ route('categoria.actualizar', $categoria->id) }}" method="POST">-->
        <form>
        @csrf
        @method('put')
        <div class="card-body">
            <div class="form-group">
                <label for="nombrecategoria">Nombre Categoria</label>
                <input type="text" name="nombre" id="nombre" value="{{ old('nombre', $categoria->nombre) }}" class="form-control" id="nombrecategoria" placeholder="Ingrese el nombre de la categoria">
                <div class="alert-message" id="nombreError"></div>
            </div>            
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
            <button type="submit" class="btn btn-primary btn-submit-edit">Enviar</button>
        </div>
        </form>
    </div>
    <!-- /.card -->
    <script>
        $(document).ready(function() {
            $(".btn-submit-edit").click(function(e){
                e.preventDefault();                
                $.ajaxSetup({
                    statusCode: {
                        422: function (data) {
                            var errores = data.responseJSON;
                            var lista = errores.errors
                            $.each(lista, function (k, v) {
                                console.log(k+" --- "+v)
                                $("#"+k+"Error").html('<font color="red">'+v+'</font>');
                            })
                        }
                    }
                });
                var _token = $("input[name='_token']").val();
                var nombre = $("#nombre").val();
                $.ajax({
                    url: "{{ route('categoria.actualizar', $categoria->id) }}",
                    type:'POST',
                    dataType: "json",
                    data: {
                        _token:_token, 
                        nombre:nombre,
                        "_method": "PUT",
                    },
                    success:function(response){
                        $('#gestionModal').modal('hide');
                        $('#gestionModalBody').html('');
                        $('#categoriasGrid').DataTable().ajax.reload();
                    },
                });
            }); 
        });
    </script>    
@stop