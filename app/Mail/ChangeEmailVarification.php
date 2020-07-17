<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ChangeEmailVarification extends Mailable
{
    use Queueable, SerializesModels;

      
    /**
     * The objEmail object instance.
     *
    * @var objEmail
     */
    public $objEmail;
 
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($objEmail)
    {
        $this->objEmail = $objEmail;
    }
   
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
        ->subject($this->objEmail->subject)
        ->view('emails.myTestMail')
        ->with('details',$this->objEmail->details);
    }
}
