<?php

namespace App\Channels;

use Illuminate\Notifications\Notification;
use Twilio\Rest\Client;

class WhatsAppChannel
{
    public function send($notifiable, Notification $notification)
    {
        if ($notification->requisicion_folio->c_abraham == 1) {
            $to = +5218110722732;   //Abraham (CEO)
            $message = $notification->toWhatsApp($notifiable);
            $from = config('services.twilio.whatsapp_from');

            $twilio = new Client(config('services.twilio.sid'), config('services.twilio.token'));

            return $twilio->messages->create('whatsapp:' . $to, [
                "from" => 'whatsapp:' . $from,
                "body" => $message->content
            ]);
        }
        if ($notification->requisicion_folio->c_marko == 1) {
            $to = +5218121754043;  //Marko SanMiguel (Gerente)
            $message = $notification->toWhatsApp($notifiable);

            $from = config('services.twilio.whatsapp_from');
             $twilio = new Client(config('services.twilio.sid'), config('services.twilio.token'));

            return $twilio->messages->create('whatsapp:' . $to, [
                "from" => 'whatsapp:' . $from,
                "body" => $message->content
            ]);
        }
        if ($notification->requisicion_folio->c_eduardo == 1) {
            $to = +5218128611230; //Eduardo (Materiales)
            $message = $notification->toWhatsApp($notifiable);

            $from = config('services.twilio.whatsapp_from');


            $twilio = new Client(config('services.twilio.sid'), config('services.twilio.token'));

            return $twilio->messages->create('whatsapp:' . $to, [
                "from" => 'whatsapp:' . $from,
                "body" => $message->content
            ]);
        } 
         
    }
}
