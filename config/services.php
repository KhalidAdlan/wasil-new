<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],
    'facebook' => [
        'page-token' => env('FACEBOOK_PAGE_TOKEN', 'EAAMOzoSdB7IBAOGfNfW66Ue7DLA8SJmeNAvrISErlFXUcKdFsbZAggsKkVtA6ZADWDEjb8ZAs8rb7pWu3uRGqm3Mi1PraCQn5Ju2ikKBA8qdGpVzdQQZASQ7KOa0jSjWfmjgNCrNBWqNpP6Qb1E2MIeUjVSeZAdZBlN1ZC05gm7cwZDZD'),
        
        // Optional - Omit this if you want to use default version.
        
        // Optional - If set, the appsecret_proof will be sent to verify your page-token.
        'app-secret' => env('FACEBOOK_APP_SECRET', '5ba7fc55b77b0f71511a7e19156ec131')
    ],

];
