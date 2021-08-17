<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;


class CompanyRegistration extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
   public $name;
   public $url;
   public $token;
     

    public function __construct($name,$url,$token)
    {
         
        $this->name = $name;
        $this->url = $url;
        $this->token = $token;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
 
        return $this->view('mail.company_registration', ['url' => $this->url, 'token' => $this->token ,  
            'name' => $this->name ]);
    }
}
