<?php
 
namespace App\Mail;
 
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
 
class Invoice extends Mailable
{
    use Queueable, SerializesModels;
 
    public $bookingData;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($bookingData)
    {
        $this->bookingData = $bookingData;
    }
 
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Invoice | Expert Connect')
        ->view('emailers.text.invoice')->with('data', $this->bookingData);
    }
}
 