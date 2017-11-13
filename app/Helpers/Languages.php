<?php

namespace App\Helpers;

use App;

/**
 * Class Languages
 * @package App\Helpers
 */
class Languages
{
    /**
     * Default application language
     *
     * @var string
     */
    const DEFAULT_LANGUAGE = 'ru';

    /**
     * Languages that are supported by the application
     *
     * @var array
     */
    const SUPPORTED_LANGUAGES = ['uk', 'ru'];

    //const SUPPORTED_LANGUAGES_SLESH = ['/uk', '/ru'];

    const SUPPORTED_LANGUAGES_REGULAR = '/\/ru|\/uk$/i';

    /**
     * set language application
     * @param string $language
     */
    public static function localizeApp($language)
    {
        App::setLocale($language);
    }
}