<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class invoicePdfSend extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $pdf;
    public function __construct($content)
    {
        $this->pdf = $content;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('email.invoice_pdf')
        ->subject('Feature listing invoice number [insert number] for Date [Insert date] from Localcarz.com')
        ->attachData($this->pdf->output(), 'invoice.pdf', [
            'mime' => 'application/pdf',
        ]);
        // return $this->subject('')->view('email.invoice_pdf');
    }
}
