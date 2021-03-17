@section('content')
    <h3>Información Categoria</h3>
    <table class="table table-hover table-bordered table-striped">
        <tr>
            <th width="40%">ID </th> <td>{{$categoria->id}}</td>
        </tr>
        <tr>
            <th>Nombre </th> <td>{{$categoria->nombre}}</td>
        </tr>        
        <tr>
            <th>Creado en </th> <td>{{$categoria->created_at}}</td>
        </tr>        
        <tr>
            <th>Actualizado en </th> <td>{{$categoria->updated_at}}</td>
        </tr>        
    </table>    
@stop