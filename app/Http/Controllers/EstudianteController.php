<?php

namespace App\Http\Controllers;

use App\Models\Estudiante;
use App\Models\Facultad;
use App\Http\Requests\EstudianteRequest;
use Illuminate\Http\Request;

class EstudianteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAll()
    {
        $facultad= Facultad::all();

        $data = Estudiante::join('facultades','id_facultad','=','facultades.id')->select('estudiantes.*','facultades.nombre_facultad')->get();


        return response()->json($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(EstudianteRequest $request)
    {
        $request->validated();
        $estudiante= new Estudiante([
            'nombres'=>$request->nombres,
            'apellidos'=>$request->apellidos,
            'correo'=>$request->correo,
            'usuario'=>$request->usuario,
            'edad'=>$request->edad,
            'id_facultad'=>$request->id_facultad
        ]);

        $estudiante->save();
        return response()->json(['message '=>'Estudiante agregado con exito',
    'estudiante'=>$estudiante],200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getById($id)
    {
        $estudiante= Estudiante::where('estudiantes.id', '=', $id)->join('facultades','id_facultad','=','facultades.id')->select('estudiantes.*','facultades.nombre_facultad')->get();
       //no funciona con null  ni con emtpy
        $respuesta= count($estudiante)==0 ?'usuario no encontrado': $estudiante;
        return response()->json($respuesta);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function remove($id)
    {
        $estudiante= Estudiante::find($id);
        if (count($estudiante)==0){
            return response('No se ha encontrado el id del estudiante');
        }
        $estudiante->delete();
        return  response('Estudiante eliminado con exito');
    }

}
