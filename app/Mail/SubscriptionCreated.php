<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SubscriptionCreated extends Mailable
{
    use Queueable, SerializesModels;
    protected $user;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user)
    {
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $invoice = $this->user->invoices()->first()->pdf([
        'vendor'  => 'Express',
        'product' => 'Notify',
        ]);

        return $this->markdown('emails.subscription.created')->with([
            'user' => $this->user
        ])->attachData($invoice, 'invoice-express.pdf', [
                    'mime' => 'application/pdf',
        ]);
    }
}
