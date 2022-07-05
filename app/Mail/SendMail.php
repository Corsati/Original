<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendMail extends Mailable
{
    use Queueable, SerializesModels;

    public $message;

    public function __construct($data, $template = 'send_mail')
    {
        $this->data     = $data;
        $this->template = $template;
    }


    public function build(): SendMail
    {
        $data = $this->data;
        return $this->view("emails.$this->template",compact('data'))->subject(__('aap_name'));
    }
}
