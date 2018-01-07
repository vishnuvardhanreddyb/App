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
        'model' => App\User::class,
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],

    'google' => [
        'client_id' => '699396254425-k45p509vvn3pt84an8jd3963npqavur6.apps.googleusercontent.com',         // Your google Client ID
        'client_secret' => 'FsyDY-qwesevp5LwipjdD_AE', // Your google Client Secret
        'redirect' => 'http://localhost:8000/login/google/callback',
    ],

    'facebook' => [
        'client_id' => '156524328327245',         // Your facebook Client ID
        'client_secret' => 'bbddd8eee06ad79b903219ccdc1790ae', // Your facebook Client Secret
        'redirect' => 'http://localhost:8000/login/facebook/callback',
    ],

];
