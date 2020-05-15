<?php

namespace App\Http\Controllers;

use App\seguroHogar;
use App\registrosSeguros;
use Illuminate\Http\Request;

class SeguroHogarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {
                if($request->usuarioCotizado<>null && $request->emailCotizado<>null && $request->p1==0 && $request->p2==0 && $request->p3==0 && $request->p4==0 && $request->p5==0 && $request->p6==0){
                    if($request->p7==1 || $request->p8==1 || $request->p9<>null){
                        $statusCode = 200; // codigos de error
                        $msg = 'la persona puede ser asegurada'; // mensaje de error
                        $order = seguroHogar::all();//mostrar los planes disponibles



                        //Guardar la informacion en la tabla registros_seguros
                        $registrosSeguros = new registrosSeguros;
                        $registrosSeguros->usuarioCotizado=$request->usuarioCotizado;
                        $registrosSeguros->emailCotizado=$request->emailCotizado;

                        $registrosSeguros->r7=$request->p7;
                        $registrosSeguros->r8=$request->p8;
                        $registrosSeguros->r9=$request->p9;
                    
                        $registrosSeguros->save();
              
                    }else{
                        $statusCode = 200; // codigos de error
                        $msg = 'la no puede ser asegurada'; // mensaje de error
                        $order = null; 
                    }
                }else{
                    $statusCode = 200; // codigos de error
                    $msg = 'la no puede ser asegurada'; // mensaje de error
                    $order = null;
                }

        } catch (\Throwable $th) {
            $statusCode = 1; // codigos de error
            $msg = 'Hubo un error'; // mensaje de error
            $order = $th;
        }

        return response()->json([
            'statusCode' => isset($statusCode) ? $statusCode : 0,
            'message' => isset($msg) ? $msg : 'Success',
            'order' => $order,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $seguroHogar = seguroHogar::create($request->all());
        return $seguroHogar;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\seguroHogar  $seguroHogar
     * @return \Illuminate\Http\Response
     */
    public function show(seguroHogar $seguroHogar)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\seguroHogar  $seguroHogar
     * @return \Illuminate\Http\Response
     */
    public function edit(seguroHogar $seguroHogar)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\seguroHogar  $seguroHogar
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, seguroHogar $seguroHogar)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\seguroHogar  $seguroHogar
     * @return \Illuminate\Http\Response
     */
    public function destroy(seguroHogar $seguroHogar)
    {
        //
    }
}
