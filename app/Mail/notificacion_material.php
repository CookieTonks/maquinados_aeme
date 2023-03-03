<?php

namespace App\Mail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class notificacion_material extends Mailable
{
    use Queueable, SerializesModels;

    public $info;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($mostrar)
    {
        $this->info = $mostrar;
    }

    /*
     * Build the message.
     *
     * @return $this
     */

    public function build()
    {
        return $this->subject('ALMACEN: Llegada de material')->view('Correos.notificacion_material');
    }
}
