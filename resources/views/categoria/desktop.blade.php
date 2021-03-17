@extends('adminlte::page')

@section('title', 'Categorias')

@section('content_header')
    <h1>Categorias</h1>
@stop

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <button class='btn btn-success' id="agregarCategoriaBtn"><i class='fa fa-plus' aria-hidden='true'></i> Agregar Categoria</button>
            </div>            
            <div class="col-12">
            <br>
                <div class="card card-primary">
                    <div class="card-header">
                        Lista de categorias
                    </div>
                    <div class="card-body">
                        <table class="table table-hover table-bordered table-striped" id="categoriasGrid">
                            <thead>
                                <tr>
                                    <th width="10%">Id</th>
                                    <th width="75%">Nombre</th>
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
    <div class="modal fade bd-example-modal-lg" id="gestionModal" tabindex="-1" role="dialog" aria-labelledby="smallModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Gestión Categoria</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="gestionModalBody">
                    <div>
                        Acael contenido
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

@stop

@section('js');
    <script>
        $('#categoriasGrid').DataTable({
            "responsive": true,
            "autoWidth": false,
            "serverSide":true,
            "processing": true,
            "ajax": "{{ route('categoria.datatable') }}",
            "columns": [
                {data: 'id'},
                {data: 'nombre'},
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

        $("#agregarCategoriaBtn").click(function(){
            $('#gestionModal').modal('show');
            $('#gestionModalBody').html('Espere por favor...').show();
            $.ajax({
            url : "{{ route('categoria.crear') }}",
            type: "GET",
                success:function(response){
                    $('#gestionModal').modal('show');
                    $('#gestionModalBody').html(response).show();        
                },
            });
        })

        function ver(id){
            $('#gestionModal').modal('show');
            $('#gestionModalBody').html('Espere por favor...').show();
            var url = "{{ route('categoria.detalle', ":id") }}";
            url = url.replace(':id', id);
            $.ajax({
            url : url,
            type: "GET",
                success:function(response){
                    $('#gestionModal').modal('show');
                    $('#gestionModalBody').html(response).show();        
                },
            });
        }

        function editar(id){
            $('#gestionModal').modal('show');
            $('#gestionModalBody').html('Espere por favor...').show();
            var url = "{{ route('categoria.editar', ":id") }}";
            url = url.replace(':id', id);
            $.ajax({
            url : url,
            type: "GET",
                success:function(response){
                    $('#gestionModal').modal('show');
                    $('#gestionModalBody').html(response).show();        
                },
            });
        }

        function eliminar(id){
            if(!confirm("Esta seguro de eliminar el registro?")){
                return false;
            }
            var url = "{{ route('categoria.eliminar', ":id") }}";
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
                        $('#categoriasGrid').DataTable().ajax.reload();
                    }
                },
            });
        }
    </script>
@endsection