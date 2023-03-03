<?php

namespace App\Notifications;

use App\Channels\Messages\WhatsAppMessage;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Channels\WhatsAppChannel;
use App\Models\requisicion_folio;
use App\Models\User;



class OrderProcessed extends Notification
{
  use Queueable;

  public $requisicion_folio;

  public function __construct(requisicion_folio $requisicion_folio)
  {
    $this->requisicion_folio = $requisicion_folio;
  }

  public function via($notifiable)
  {
    return [WhatsAppChannel::class];
  }

  public function toWhatsApp($notifiable)
  {
      
    $orderUrl = "https://sistema.cncaeme.com/home_cotizaciones_aprobacion/{$this->requisicion_folio->id}";
    
    $company = 'cotizacion';
    $deliveryDate = $this->requisicion_folio->created_at->addDays(4)->toFormattedDateString();


    return (new WhatsAppMessage)->content("Your {$company} order of {$this->requisicion_folio->requisicion} has shipped and should be delivered on {$deliveryDate}. Details: {$orderUrl}");
  }
} 
