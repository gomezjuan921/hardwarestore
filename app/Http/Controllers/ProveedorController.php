<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Proveedor;

class ProveedorController extends Controller
{
    public function index(){
        return view('proveedor.index');
    }    
    public function datatable(){
        $proveedores = Proveedor::select('id','documento','razon_social','celular','telefono','direccion')->get();
        return datatables()
            ->of($proveedores)
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
    public function crear(){
        return view('proveedor.crear')->renderSections()['content'];
    }
    public function guardar(Request $request){
        $request->validate([
            'documento' => 'required|min:5',
            'razon_social' => 'required|min:3',
            'celular' => 'required|min:10|numeric',
            'telefono' => 'nullable|min:7|numeric',
        ]);
        $proveedor = new Proveedor();
        $proveedor->documento = $request->documento;
        $proveedor->razon_social = $request->razon_social;
        $proveedor->celular = $request->celular;
        $proveedor->telefono = $request->telefono;
        $proveedor->direccion = $request->direccion;
        $proveedor->save();
        return response()->json($proveedor);
    }
    public function ver($id){
        $proveedor = Proveedor::find($id);
        return view('proveedor.ver',compact('proveedor'))->renderSections()['content'];
    }
    public function editar($id){
        $proveedor = Proveedor::find($id);
        return view('proveedor.editar',compact('proveedor'))->renderSections()['content'];
    }
    public function actualizar(Request $request, $id){
        $request->validate([
            'documento' => 'required|min:5',
            'razon_social' => 'required|min:3',
            'celular' => 'required|min:10|numeric',
            'telefono' => 'nullable|min:7|numeric',
        ]);
        $proveedor = Proveedor::find($id);
        $proveedor->documento = $request->documento;
        $proveedor->razon_social = $request->razon_social;
        $proveedor->celular = $request->celular;
        $proveedor->telefono = $request->telefono;
        $proveedor->direccion = $request->direccion;
        $proveedor->save();
        return response()->json($proveedor);
    }
    public function eliminar(Request $request,Proveedor $id){
        $id->delete();
        return response()->json(['status'=>'success']);
    }

}
