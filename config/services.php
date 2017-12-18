<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, SparkPost and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
    ],

    'ses' => [
        'key' => env('SES_KEY'),
        'secret' => env('SES_SECRET'),
        'region' => 'us-east-1',
    ],

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],

    'stripe' => [
        'model' => App\DatabaseModels\User::class,
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],

    'facebook' => [
        'client_id' => '300232113802173',         // Your facebook app ID
        'client_secret' => 'ae9a0a77408b5777b33a519cdf7d7137', // Your facebook app Secret
        'redirect' => 'http://feelandfly.xyz/user/login/facebook/callback'
    ],

    'google' => [
        'client_id' => '813277002010-vs7878j41pj1khru14nioul5vkqubnim.apps.googleusercontent.com',
        'client_secret' => 'zoLmB9WRzAkTlF9ivAVD9G9w',
        'redirect' => 'http://feelandfly.xyz/user/login/google/callback',
    ],
];
