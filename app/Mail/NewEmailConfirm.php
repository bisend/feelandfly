<?php

namespace App\Mail;

use App\Helpers\Languages;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class NewEmailConfirm extends Mailable
{
    use Queueable, SerializesModels;

    public $user;

    public $confirmationUrl;

    public $language;
    
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user, $confirmationUrl = null, $language = Languages::DEFAULT_LANGUAGE)
    {
        Languages::localizeApp($language);

        $this->user = $user;

        $this->confirmationUrl = $confirmationUrl;

        $this->language = $language;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject(trans('email.new_email_confirm'))->markdown('email.new-email-confirm');
    }
}
