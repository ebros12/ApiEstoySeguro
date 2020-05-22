<?php

namespace App\Http\Controllers;

use App\confirmacion;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Mail;
use Barryvdh\DomPDF\Facade as PDF;

class ConfirmacionController extends Controller
{
    /**
     * Display a listing of the resource.
     * 
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
     

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
            $token = $request->token;

            $client = new Client([
                // Base URI is used with relative requests
                'base_uri' => $base_uri_Flow,
                // You can set any number of default request options.
                'timeout'  => 2.0,
            ]);

        //Creando la firma para Flow
            $params = array( 
                "apiKey" => $apiKey,
                "token" => $token,
              ); 
            $keys = array_keys($params);
            sort($keys);
              

            //concatena
            $toSign = "";
            foreach($keys as $key) {
                $toSign .= $key . $params[$key];
            };
            $signature = hash_hmac('sha256', $toSign , $secretKey);

            
            $response = $client->request('GET', $base_uri_Flow.'/api/payment/getStatus?apiKey='.$apiKey.'&token='.$token.'&s='.$signature, [] );

            $code = $response->getStatusCode(); // 200
            $order = json_decode($response->getBody(),true);
            
            $coleccion = collect($order);
            $order = $coleccion;
            
            $confirmacionSave = new confirmacion;
            $confirmacionSave->flowOrder = $coleccion['flowOrder'];
            $confirmacionSave->commerceOrder = $coleccion['commerceOrder'];
            $confirmacionSave->requestDate = $coleccion['requestDate'];
            $confirmacionSave->status = $coleccion['status'];
            $confirmacionSave->subject = $coleccion['subject'];
            $confirmacionSave->currency = $coleccion['currency'];
            $confirmacionSave->amount = $coleccion['amount'];
            $confirmacionSave->payer = $coleccion['payer'];
            $confirmacionSave->optional = $coleccion['optional'];
            $confirmacionSave->pending_info = json_encode($coleccion['pending_info']);
            $confirmacionSave->paymentData = json_encode($coleccion['paymentData']);
            $confirmacionSave->merchantId = $coleccion['merchantId'];
            $confirmacionSave->save();

/*          status integer
            El estado de la order

                1 pendiente de pago
                2 pagada
                3 rechazada
                4 anulada */
                if (strpos($coleccion['subject'], 'Seguro Hogar 250UF') == 0) {
                    $destinatario = $coleccion['payer'];
                    $nombre = "ebros12";
                    $status = $coleccion['status'];
                    // Armar correo y pasarle datos para el constructor
                    $correo = new \App\Mail\reciboSeguroHogar($nombre,$status);
                    # ¡Enviarlo!
                    $dataCorreo = \Mail::to($destinatario)->send($correo);
                }

                if (strpos($coleccion['subject'], 'Cobertura Dental Familiar') == 0) {
                    $destinatario = $coleccion['payer'];
                    $nombre = "ebros12";
                    $status = $coleccion['status'];
                    // Armar correo y pasarle datos para el constructor
                    $correo = new \App\Mail\reciboSeguroDentalFamiliar($nombre,$status);
                    # ¡Enviarlo!
                    $dataCorreo = \Mail::to($destinatario)->send($correo);
                }

              
            


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
     * @param  \App\confirmacion  $confirmacion
     * @return \Illuminate\Http\Response
     */
    public function show(confirmacion $confirmacion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\confirmacion  $confirmacion
     * @return \Illuminate\Http\Response
     */
    public function edit(confirmacion $confirmacion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\confirmacion  $confirmacion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, confirmacion $confirmacion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\confirmacion  $confirmacion
     * @return \Illuminate\Http\Response
     */
    public function destroy(confirmacion $confirmacion)
    {
        //
    }
}
