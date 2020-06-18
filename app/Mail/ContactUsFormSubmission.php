<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Http\Requests\ContactFormRequest;
use App\User;
use Illuminate\Contracts\Mail\Mailer as MailerContract;


class ContactUsFormSubmission extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The contact form request object.
     *
     * @var ContactFormRequest
     */
    public $request;

    /**
     * The user object to send the email to.
     *
     * @var User
     */
    protected $user;


    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(ContactFormRequest $request, User $user)
    {   
        $this->request = $request;
        $this->user = $user;
        $this->to($this->user->email);
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('email.contact-us');
    }
}
 