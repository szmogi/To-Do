<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NotificationDone extends Mailable
{
    use Queueable, SerializesModels;

    public $data;



    /**  
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {        
        return $this->from('szmogi@szmogi.site','Me')
        ->to('admin@admin.com', 'Your mail')
        ->subject('Item done')
        ->markdown('mail.NotificationMailDone')
        ->with('data',$this->data);       
       
    }
}
