<?php

namespace App\Mail;

use App\Helpers\Languages;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class RestorePassword extends Mailable
{
    use Queueable, SerializesModels;

    public $user;

    public $password;

    public $language;
    
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user = null, $password = null, $language = Languages::DEFAULT_LANGUAGE)
    {
        Languages::localizeApp($language);

        $this->user = $user;

        $this->password = $password;

        $this->language = $language;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject(trans('email.restore_password'))->markdown('email.restore-password');
    }
}
