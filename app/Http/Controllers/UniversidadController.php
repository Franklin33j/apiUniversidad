<?php

namespace App\Http\Controllers;

use App\Http\Requests\UniversidadRequest as RequestsUniversidadRequest;
use Illuminate\Http\Request;
use App\Http\Requests\UniversidadRequest;
use App\Models\Universidad;
use Illuminate\Auth\Events\Validated;

class UniversidadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function allInfo()
    {

        $allInfo= Universidad::all();
        return $allInfo;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(UniversidadRequest $request)
    {
        $request->validated();

        $universidad= new Universidad([
            'nombre_universidad'=> $request->nombre_universidad,
            'rector'=>$request->rector,
        ]);

        $universidad->save();
        return response()->json(['message'=>'usuario agregado con exito',
    'user'=>$universidad]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $universidad= Universidad::find($id);
        if ($universidad==null){
            return response('No se ha encontrado el id del la universidad');
        }

        $universidad->delete();
        return  response('Universidad eliminada con exito');
    }

    public function getById($id)
    {
        $universidad= Universidad::find($id);
        if ($universidad==null){
            return response('No se ha encontrado el id del la universidad');
        }

        return  response($universidad);
    }



    public function update($id,Request $request)
    {
        //validaciones sin usar unique ya que genera error
        $this->validate($request, [
            'nombre_universidad' => 'required|string',
            'rector' => 'required|string'
        ],[ 'nombre_universidad.required'=>'El nombre_universidad es obligatorio',
        'rector.required'=>'El rector es obligatorio',]);

        $universidad= Universidad::find($id);
        $universidadInfo= Universidad::where('nombre_universidad','=',trim($request->nombre_universidad))->first();

        //viene null porque no es un request personalizado
        if($universidad==null ){
            return response('id no encontrado');
        }
        //TODO ESTO POR HACER UNIQUE EL CAMPO nombre_universidad, practicamente lo estoy validando
        if($universidadInfo!= null){
            //si los id coinciden se refiere al mismo registro
            if($universidad->id == $universidadInfo->id){
                $universidad->rector= $request->rector;
                return response()->json([
                    'message'=>'Universidad actualizada con exito',
                    'Universidad'=>$universidad
                ]
            );
            }
            //sino que se encuentra en otro registro
            return response('Ya existe un nombre_universidad con el mismo valor');
        }
        $universidad->nombre_universidad=$request->nombre_universidad;
        $universidad->rector= $request->rector;

        $universidad->save();
        return response()->json([
            'message'=>'Universidad actualizada con exito',
            'Universidad'=> $universidad
        ]);
    }
}
