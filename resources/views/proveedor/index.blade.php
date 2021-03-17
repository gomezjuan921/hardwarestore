@extends('adminlte::page')

@section('title', 'Proveedores')

@section('content')
<div class="container">
        <div class="row">
            <div class="col-12">
                <button class='btn btn-success' id="agregarProveedorBtn"><i class='fa fa-plus' aria-hidden='true'></i> Agregar Proveedor</button>
            </div>            
            <div class="col-12">
            <br>
                <div class="card card-primary">
                    <div class="card-header">
                        Lista de proveedores
                    </div>
                    <div class="card-body">
                        <table class="table table-hover table-bordered table-striped" id="proveedoresGrid">
                            <thead>
                                <tr>
                                    <th width="5%">Id</th>
                                    <th width="10%">Documento</th>
                                    <th width="30%">Razon Social</th>
                                    <th width="15%">Celular</th>
                                    <th width="10%">Teléfono</th>
                                    <th width="15%">Dirección</th>
                                    <th width="15%">Acciones</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

     <!-- large modal -->
     <div class="modal fade bd-example-modal-lg" id="gestionProveedorModal" tabindex="-1" role="dialog" aria-labelledby="smallModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Gestión Proveedores</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="gestionProveedorModalBody">
                    <div>
                        Aca el contenido
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>    
@stop

@section('js')
    <script>
        $('#proveedoresGrid').DataTable({
            "responsive": true,
            "autoWidth": false,
            "serverSide":true,
            "processing": true,
            "ajax": "{{ route('proveedor.datatable') }}",
            "columns": [
                {data: 'id'},
                {data: 'documento'},
                {data: 'razon_social'},
                {data: 'celular'},
                {data: 'telefono'},
                {data: 'direccion'},                
                {data: 'action', orderable: false, searchable: false},
            ],
            "language": {
                "lengthMenu": "Ver _MENU_ registros por pagina",
                "zeroRecords": "Sin resultados - lo sentimos",
                "info": "Viendo pagina _PAGE_ de _PAGES_",
                "infoEmpty": "Sin resultados",
                "infoFiltered": "(Encontrados de _MAX_ registros en total)",
                'search': 'Buscar :',
                'paginate':{
                    'previous': 'Anterior',
                    'next': 'Siguiente'
                }
            },
        });

        $("#agregarProveedorBtn").click(function(){
            $('#gestionProveedorModal').modal('show');
            $('#gestionProveedorModalBody').html('Espere por favor...').show();
            $.ajax({
            url : "{{ route('proveedor.crear') }}",
            type: "GET",
                success:function(response){
                    $('#gestionProveedorModal').modal('show');
                    $('#gestionProveedorModalBody').html(response).show();        
                },
            });
        })

        function ver(id){
            $('#gestionProveedorModal').modal('show');
            $('#gestionProveedorModalBody').html('Espere por favor...').show();
            var url = "{{ route('proveedor.ver', ":id") }}";
            url = url.replace(':id', id);
            $.ajax({
            url : url,
            type: "GET",
                success:function(response){
                    $('#gestionProveedorModal').modal('show');
                    $('#gestionProveedorModalBody').html(response).show();        
                },
            });
        }

        function editar(id){
            $('#gestionProveedorModal').modal('show');
            $('#gestionProveedorModalBody').html('Espere por favor...').show();
            var url = "{{ route('proveedor.editar', ":id") }}";
            url = url.replace(':id', id);
            $.ajax({
            url : url,
            type: "GET",
                success:function(response){
                    $('#gestionProveedorModal').modal('show');
                    $('#gestionProveedorModalBody').html(response).show();        
                },
            });
        }

        function eliminar(id){
            if(!confirm("Esta seguro de eliminar el registro?")){
                return false;
            }
            var url = "{{ route('proveedor.eliminar', ":id") }}";
            url = url.replace(':id', id);
            $.ajax({
            url : url,
            type:"POST",
            dataType: "json",
                data:{
                    "_token": "{{ csrf_token() }}",
                    "_method": "DELETE",
                    id:id,
                },
                success:function(response){
                    if(response.status=='success'){
                        $('#proveedoresGrid').DataTable().ajax.reload();
                    }
                },
            });
        }

    </script>
@stop