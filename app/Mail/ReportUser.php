<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ReportUser extends Mailable
{
    use Queueable, SerializesModels;

    public $User;
    public $video;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($User, $video)
    {
        $this->User = $User;
        $this->video = $video;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.report');
    }
}
