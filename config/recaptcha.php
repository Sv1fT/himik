<?php

return [

    /*
     * ==========================================
     * Recaptcha Keys
     * ==========================================
     *
     * See https://www.google.com/recaptcha/admin
     * */
    'public_key'  => env('RECAPTCHA_PUBLIC_KEY', '6LciTTAUAAAAAHnYqlj3oNN9bw_3ysrkaSr5yeAt'),
    'private_key' => env('RECAPTCHA_PRIVATE_KEY', '6LciTTAUAAAAADf-KYcoo57BH0WpUKtmakMGd55m'),

    /*
     * ==========================================
     * Recaptcha Options
     * ==========================================
     *
     * See https://developers.google.com/recaptcha/docs/display
     * */
    'options'     => [
        'data-theme' => 'light',   // dark, light
        'data-type'  => 'image',   // audio, image
        'data-size'  => 'normal',  // compact, normal
        'lang'       => 'ru',
    ],
];
