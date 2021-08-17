<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EnableDisableComapny extends Mailable
{
    use Queueable, SerializesModels;

    public $companyObj;
    public $subject;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($companyObj, $subject)
    {
        $this->companyObj = $companyObj;
        $this->subject    = $subject;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.enable_disable_company', ['company' => $this->companyObj])->subject($this->subject);
    }
}
