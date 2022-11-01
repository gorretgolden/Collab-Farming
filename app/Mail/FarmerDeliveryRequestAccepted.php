<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class FarmerDeliveryRequestAccepted extends Mailable
{
    use Queueable, SerializesModels;

    public $emailInfo;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($emailInfo)
    {
        //
        $this->emailInfo = $emailInfo;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.farmer.farmer_delivery_request_accepted')
            ->subject($this->emailInfo['subject']);
    }
}
