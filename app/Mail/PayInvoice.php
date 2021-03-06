<?php

namespace App\Mail;

use App\Model\Payment;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class PayInvoice extends Mailable
{
    use Queueable, SerializesModels;
    public $payment_id= "0";
    public $reference = 'Number';
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
        return $this->subject('Invoice Reference: '.$this->reference)->markdown('emails.invoices.pay',['url'=>env('APP_URL').'/business/invoice/pay/'.$this->payment_id,'payment'=>Payment::find($this->payment_id)]);

       // return $this->markdown('emails.invoices.pay');
    }
}
