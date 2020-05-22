<?php

namespace App\Http\Controllers;

use App\suscripcion;
use Illuminate\Http\Request;
use GuzzleHttp\Client;

class SuscripcionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {

            $apiKey = env('apiKey');
            $secretKey = env('secretKey');
            $base_uri_Flow = env('base_uri_Flow');
            $limit =$request->limit;
            $planId = $request->planId;

            $client = new Client([
                // Base URI is used with relative requests
                'base_uri' => $base_uri_Flow,
                // You can set any number of default request options.
                'timeout'  => 2.0,
            ]);

        //Creando la firma para Flow
            $params = array( 
                "apiKey" => $apiKey,
                "limit" => $limit,
                "planId" => $planId
              ); 
            $keys = array_keys($params);
            sort($keys);
              

            //concatena
            $toSign = "";
            foreach($keys as $key) {
                $toSign .= $key . $params[$key];
            };
            $signature = hash_hmac('sha256', $toSign , $secretKey);

            
            $response = $client->request('GET', $base_uri_Flow.'/api/plans/get?apiKey='.$apiKey.'&s='.$signature.'&limit='.$limit.'&planId='.$planId, [        ]);

            $code = $response->getStatusCode(); // 200
            $order = json_decode($response->getBody(),true);

        } catch (\Throwable $th) {
            $statusCode = 1; // codigos de error
            $msg = 'Hubo un error'; // mensaje de error
            $order = null;
        }

        return response()->json([
            'statusCode' => isset($statusCode) ? $statusCode : 0,
            'message' => isset($msg) ? $msg : 'Success',
            'order' => $order // respues json
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

        try {

            $apiKey = env('apiKey');
            $secretKey = env('secretKey');
            $base_uri_Flow = env('base_uri_Flow');


            $client = new Client([
                // Base URI is used with relative requests
                'base_uri' => $base_uri_Flow,
                // You can set any number of default request options.
                'timeout'  => 2.0,
            ]);

        //Creando la firma para Flow
            $params = array( 
                "apiKey" => $apiKey,
                "planId" => $request->planId,
                "customerId" => $request->customerId,
              ); 
            $keys = array_keys($params);
            sort($keys);
              

            //concatena
            $toSign = "";
            foreach($keys as $key) {
                $toSign .= $key . $params[$key];
            };
            $signature = hash_hmac('sha256', $toSign , $secretKey);

            
            $response = $client->request('POST', $base_uri_Flow.'/api/subscription/create', [
                'form_params' => [
                'apiKey' => $apiKey,
                'planId' => $request->planId,
                'customerId' => $request->customerId,
                's' => $signature,
                ]
            ]);

            $code = $response->getStatusCode(); // 200
            $order = json_decode($response->getBody(),true);
            
            $coleccion = collect($order);

            $suscripcionSave = new suscripcion;
            $suscripcionSave->subscriptionId = $coleccion['subscriptionId'];
            $suscripcionSave->planId = $coleccion['planId'];
            $suscripcionSave->plan_name = $coleccion['plan_name'];
            $suscripcionSave->customerId = $coleccion['customerId'];
            $suscripcionSave->created = $coleccion['created'];
            $suscripcionSave->subscription_start = $coleccion['subscription_start'];
            
            $suscripcionSave->save();

        } catch (\Throwable $th) {
            $statusCode = 1; // codigos de error
            $msg = 'Hubo un error'; // mensaje de error
            $order = null;
        }

        return response()->json([
            'statusCode' => isset($statusCode) ? $statusCode : 0,
            'message' => isset($msg) ? $msg : 'Success',
            'order' => $order // respues json
        ]);
    }




    /**
     * Display the specified resource.
     *
     * @param  \App\suscripcion  $suscripcion
     * @return \Illuminate\Http\Response
     */
    public function show(suscripcion $suscripcion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\suscripcion  $suscripcion
     * @return \Illuminate\Http\Response
     */
    public function edit(suscripcion $suscripcion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\suscripcion  $suscripcion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, suscripcion $suscripcion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\suscripcion  $suscripcion
     * @return \Illuminate\Http\Response
     */
    public function destroy(suscripcion $suscripcion)
    {
        //
    }
}
