<?php

namespace App\Mail;

use App\DatabaseModels\User;
use App\Helpers\Languages;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class EmailConfirm extends Mailable
{
    use Queueable, SerializesModels;

    public $user;

    public $language;

    public $confirmationUrl;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user, $confirmationUrl = null, $language = Languages::DEFAULT_LANGUAGE)
    {
        Languages::localizeApp($language);

        $this->user = $user;

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
        return $this->subject(trans('email.email_confirm'))->markdown('email.email-confirm');
    }
}
