@section('content')
    <h3>Información Proveedor</h3>
    <table class="table table-hover table-bordered table-striped">
        <tr>
            <th width="40%">ID </th> <td>{{$proveedor->id}}</td>
        </tr>
        <tr>
            <th>Documento </th> <td>{{$proveedor->documento}}</td>
        </tr>
        <tr>
            <th>Razón Social </th> <td>{{$proveedor->razon_social}}</td>
        </tr>
        <tr>
            <th>Celular </th> <td>{{$proveedor->celular}}</td>
        </tr>
        <tr>
            <th>Teléfono </th> <td>{{$proveedor->telefono}}</td>
        </tr>
        <tr>
            <th>Dirección </th> <td>{{$proveedor->direccion}}</td>
        </tr>        
        <tr>
            <th>Creado en </th> <td>{{$proveedor->created_at}}</td>
        </tr>        
        <tr>
            <th>Actualizado en </th> <td>{{$proveedor->updated_at}}</td>
        </tr> 
    </table>    
@stop