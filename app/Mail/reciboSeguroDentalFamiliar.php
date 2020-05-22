<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Barryvdh\DomPDF\Facade as PDF;
use App\pdfcreados;

class reciboSeguroDentalFamiliar extends Mailable
{
    public $nombre;
    public $status;
     
    use Queueable, SerializesModels;

    public $distressCall;

    public function __construct($nombre,$status)
    {
        $this->nombre = $nombre;
        $this->status = $status;
       
    }

    public function build()
    {

       
        if($this->status == 2){
            $info = pdfcreados::get();
            $pdf = PDF::loadView('pdf.certificado',compact('info'));
            return $this->view("mails/confirmacionCorreoDentalFamiliar")
            ->from(env('MAIL_FROM_ADDRESS'))
            ->subject("Estado Transaccion")
            ->attachData($pdf->output(), "certificado.pdf");
        }else{
            return $this->view("mails/confirmacionCorreoDentalFamiliar")
            ->from(env('MAIL_FROM_ADDRESS'))
            ->subject("Estado Transaccion");
        }
        
    }
}
