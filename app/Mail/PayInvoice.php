<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class PayInvoice extends Mailable
{
    use Queueable, SerializesModels;
    public $payment_id= "0";
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Welcome to Sumra!')->markdown('emails.invoices.pay',['url'=>'https://business.sumra.net/business/invoice/pay/'.$this->payment_id]);

       // return $this->markdown('emails.invoices.pay');
    }
}
