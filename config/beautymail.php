<?php

return [

    // These CSS rules will be applied after the regular template CSS

    /*
        'css' => [
            '.button-content .button { background: red }',
        ],
    */

    'colors' => [

        'highlight' => '#004ca3',
        'button'    => '#004cad',

    ],

    'view' => [
        'senderName'  => config('app.name'),
        'reminder'    => null,
        'unsubscribe' => null,
        'address'     => null,

        'logo'        => [
            // 'path'   => '%PUBLIC%/vendor/beautymail/assets/images/sunny/logo.png',
            'path'   => config('app.url').'/img/email_logo.png',
            // 'path'   => 'https://logo.clearbit.com/justaddwater.in',
            'width'  => '',
            'height' => '',
        ],

        'twitter'  => null,
        'facebook' => null,
        'flickr'   => null,
    ],

];
