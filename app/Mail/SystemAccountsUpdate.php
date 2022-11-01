<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SystemAccountsUpdate extends Mailable
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
        return $this->markdown('emails.system.accounts_update')
        ->subject('Weekly System Summary');
    }
}
