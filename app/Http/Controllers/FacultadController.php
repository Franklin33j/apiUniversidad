<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Facultad;
use App\Http\Requests\FacultadRequest;
use Exception;

class FacultadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAll()
    {
        $data= Facultad::join('universidades','id_universidad','=','universidades.id')->select('facultades.*','universidades.nombre_universidad')->get();;
        return response()->json($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(FacultadRequest $request)
    {
        try{
            $request->validated();

        $facultad= new Facultad([
            'nombre_facultad'=> $request->nombre,
            'cant_carreras'=>$request->cant_carreras,
            'id_universidad'=>$request->id_universidad,
        ]);

    $facultad->save();

    return response()->json(['message'=>'Facultad agregada con exito',
        'facultad'=> $facultad]);
        }
        catch(Exception $e){
            return response($e->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function remove($id)
    {
        $facultad= Facultad::find($id);
        if (count($facultad)==0){
            return response('No se ha encontrado el id de la facultad');
        }

        $facultad->delete();
        return  response('Facultad eliminada con exito');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(FacultadRequest $request,$id)
    {
        $facultad= Facultad::find($id);
        if(count($facultad)==0){
            return response('El id ingresado no se encuentra registrado');
        }
        $request->validated();
        //validar si el formulario viene nullo
        $facultad->nombre_facultad= $request->nombre_facultad;
        $facultad->cant_materias= $request->cant_materias;
        $facultad->id_universidad=$request->id_universidad;

        $facultad->save();
        return response()->json([
            'message'=>'Facultad agregada con exito',
            'Universidad'=> $facultad
        ]);
    }

}
