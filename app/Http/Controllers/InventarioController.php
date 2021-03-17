<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;


class InventarioController extends Controller
{
    public function entradaMercancia(){
        return view('inventario.entradamercancia');
    }
    public function administracion(){
        return view('inventario.salidamercancia');
    }

    public function desktopCategoria(){
        $categorias = Categoria::all();
        return view('categoria.desktop',compact('categorias'));
    }
    public function crearCategoria(Request $request){
        if($request->ajax()){
            return view('categoria.crear')->renderSections()['content'];
        }else{
            return view('categoria.crear');
        }        
    }
    public function almacenarCategoria(Request $request){
        $request->validate([
            'nombre' => 'required|min:3',
        ]);
        $categoria = new Categoria();
        $categoria->nombre = $request->nombre;
        $categoria->save();
        //return redirect()->route('categoria.desktop');
        return response()->json($categoria);
    }
    public function detalleCategoria($id){
        $categoria = Categoria::find($id);
        return view('categoria.detalle',compact('categoria'))->renderSections()['content'];
    }
    public function editarCategoria($id){
        $categoria = Categoria::find($id);
        return view('categoria.editar',compact('categoria'))->renderSections()['content'];;
    }
    public function actualizarCategoria(Request $request,$id){
        $request->validate([
            'nombre' => 'required|min:3',
        ]);
        $categoria = Categoria::find($id);
        $categoria->nombre = $request->nombre;
        $categoria->save();
        //return redirect()->route('categoria.desktop');
        return response()->json($categoria);
    }
    public function eliminarCategoria(Request $request,Categoria $id){
        $id->delete();
        if($request->ajax()){
            return response()->json(['status'=>'success']);
        }else{
            return redirect()->route('categoria.desktop');
        }        
    }
    public function dataCategorias(){
        $categoria = Categoria::select('id','nombre')->get();
        return datatables()
            ->of($categoria)
            ->addIndexColumn()
            ->addColumn('action',function ($data){
                return $this->getActionColumn($data);
            })
            ->rawColumns(['action'])
            ->toJson();
    }

    protected function getActionColumn($data){
        return "<button class='btn btn-info btn-sm' onclick='ver($data->id)' title='Ver Detalles'><i class='fa fa-info-circle' aria-hidden='true'></i></button> 
                <button class='btn btn-primary btn-sm' onclick='editar($data->id)' title='Modificar registro'><i class='fa fa-edit' aria-hidden='true'></i></button>
                <button class='btn btn-danger btn-sm' onclick='eliminar($data->id)' title='Eliminar registro'>&nbsp;<i class='fa fa-times' aria-hidden='true'></i>&nbsp;</button>";
    }

}
