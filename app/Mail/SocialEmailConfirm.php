<?php

namespace App\Mail;

use App\Helpers\Languages;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SocialEmailConfirm extends Mailable
{
    use Queueable, SerializesModels;

    public $language;

    public $confirmationUrl;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($confirmationUrl = null, $language = Languages::DEFAULT_LANGUAGE)
    {
        Languages::localizeApp($language);

        $this->language = $language;

        $this->confirmationUrl = $confirmationUrl;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject(trans('email.email_confirm'))->markdown('email.social-email-confirm');
    }
}
