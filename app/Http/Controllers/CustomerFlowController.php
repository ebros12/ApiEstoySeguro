<?php

namespace App\Http\Controllers;

use App\customerFlow;
use Illuminate\Http\Request;
use GuzzleHttp\Client;

class CustomerFlowController extends Controller
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
              ); 
            $keys = array_keys($params);
            sort($keys);
              

            //concatena
            $toSign = "";
            foreach($keys as $key) {
                $toSign .= $key . $params[$key];
            };
            $signature = hash_hmac('sha256', $toSign , $secretKey);

            
            $response = $client->request('GET', $base_uri_Flow.'/api/customer/list?apiKey='.$apiKey.'&s='.$signature.'&limit='.$limit, [        ]);

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
/*         $validator = Validator::make($request->all(), [
            'order_id' => 'required|integer', // Validacion de parametros
        ]); */

/*         if ($validator->fails()) return $this->validationFail($validator->errors()); */

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
                "name" => $request->name,
                "email" => $request->email,
                "externalId" => $request->externalId,
              ); 
            $keys = array_keys($params);
            sort($keys);
              

            //concatena
            $toSign = "";
            foreach($keys as $key) {
                $toSign .= $key . $params[$key];
            };
            $signature = hash_hmac('sha256', $toSign , $secretKey);

            
            $response = $client->request('POST', $base_uri_Flow.'/api/customer/create', [
                'form_params' => [
                'apiKey' => $apiKey,
                'name' => $request->name,
                'email' => $request->email,
                'externalId' => $request->externalId,
                's' => $signature,
                ]
            ]);

            $code = $response->getStatusCode(); // 200
            $order = json_decode($response->getBody(),true);
            
            $coleccion = collect($order);

            $customerSave = new customerFlow;
            $customerSave->customerId = $coleccion['customerId'];
            $customerSave->created = $coleccion['created'];
            $customerSave->email = $coleccion['email'];
            $customerSave->name = $coleccion['name'];
            $customerSave->pay_mode = $coleccion['pay_mode'];
            $customerSave->creditCardType = $coleccion['creditCardType'];
            $customerSave->last4CardDigits = $coleccion['last4CardDigits'];
            $customerSave->externalId = $coleccion['externalId'];
            $customerSave->status = $coleccion['status'];
            $customerSave->registerDate = $coleccion['registerDate'];
            $customerSave->sellerNombre = $request->sellerNombre;
            $customerSave->sellerId = $request->sellerId;
            $customerSave->save();

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
     * @param  \App\customerFlow  $customerFlow
     * @return \Illuminate\Http\Response
     */
    public function show(customerFlow $customerFlow)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\customerFlow  $customerFlow
     * @return \Illuminate\Http\Response
     */
    public function edit(customerFlow $customerFlow)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\customerFlow  $customerFlow
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, customerFlow $customerFlow)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\customerFlow  $customerFlow
     * @return \Illuminate\Http\Response
     */
    public function destroy(customerFlow $customerFlow)
    {
        //
    }
}
