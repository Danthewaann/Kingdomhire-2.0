<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Http\Requests\ContactFormRequest;

class ContactUsFormReceipt extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The contact form request object.
     *
     * @var ContactFormRequest
     */
    public $request;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(ContactFormRequest $request)
    {   
        $this->request = $request;
        $this->to($request->email);
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('email.receipt');
    }
}
