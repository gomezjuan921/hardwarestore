@section('content')
<div class="card card-primary">
        <div class="card-header">
        <h3 class="card-title">Formulario de creación</h3>
        </div>
        <form>
        @csrf
        <div class="card-body">
            <div class="form-group">
                <label for="documento">Documento Proveedor</label>
                <input type="text" id="documento" value="{{ old('documento') }}" class="form-control" placeholder="Ingrese el documento">
                <div class="alert-message" id="documentoError"></div>
            </div>            
            <div class="form-group">
                <label for="razon_social">Razón Social</label>
                <input type="text" id="razon_social" value="{{ old('razon_social') }}" class="form-control" placeholder="Ingrese Razón Social">
                <div class="alert-message" id="razon_socialError"></div>
            </div>   
            <div class="form-group">
                <label for="celular">Celular</label>
                <input type="text" id="celular" value="{{ old('celular') }}" class="form-control" placeholder="Ingrese el número de celular">
                <div class="alert-message" id="celularError"></div>
            </div>   
            <div class="form-group">
                <label for="telefono">Teléfono</label>
                <input type="text" id="telefono" value="{{ old('telefono') }}" class="form-control" placeholder="Ingrese el número de telefono">
                <div class="alert-message" id="telefonoError"></div>
            </div>   
            <div class="form-group">
                <label for="direccion">Dirección</label>
                <input type="text" id="direccion" value="{{ old('direccion') }}" class="form-control" placeholder="Ingrese la dirección">
                <div class="alert-message" id="direccionError"></div>
            </div>   
        </div>        
        <!-- /.card-body -->
        <div class="card-footer">
            <button type="submit" class="btn btn-primary crearProveedorBtn">Crear</button>
        </div>
        </form>
    </div>
    <!-- /.card -->
    <script>
        $(document).ready(function() {
            $(".crearProveedorBtn").click(function(e){
                e.preventDefault();                
                $.ajaxSetup({
                    statusCode: {
                        422: function (data) {
                            var errores = data.responseJSON;
                            var lista = errores.errors
                            $.each(lista, function (k, v) {
                                $("#"+k+"Error").html('<font color="red">'+v+'</font>');
                            })
                        }
                    }
                });
                var _token = $("input[name='_token']").val();
                var documento = $("#documento").val();
                var razon_social = $("#razon_social").val();
                var celular = $("#celular").val();
                var telefono = $("#telefono").val();
                var direccion = $("#direccion").val();
                $.ajax({
                    url: "{{ route('proveedor.guardar') }}",
                    type:'POST',
                    dataType: "json",
                    data: {
                        _token:_token, 
                        documento:documento,
                        razon_social:razon_social,
                        celular:celular,
                        telefono:telefono,
                        direccion:direccion,
                    },
                    success:function(response){
                        $('#gestionProveedorModal').modal('hide');
                        $('#gestionProveedorModalBody').html('');
                        $('#proveedoresGrid').DataTable().ajax.reload();
                    },
                });
            }); 
        });
    </script>
@stop