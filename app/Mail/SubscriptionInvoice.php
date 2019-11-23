<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SubscriptionInvoice extends Mailable
{
    use Queueable, SerializesModels;

    public $subscriptionData;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($subscriptionData)
    {
        $this->subscriptionData = $subscriptionData;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
      return $this->subject('Invoice | Expert Connect')->view('emailers.text.subscriptionInvoice')->with('data', $this->subscriptionData);
    }
}
