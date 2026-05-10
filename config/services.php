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

    'postmark' => [
        'key' => env('POSTMARK_API_KEY'),
    ],

    'resend' => [
        'key' => env('RESEND_API_KEY'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'slack' => [
        'notifications' => [
            'bot_user_oauth_token' => env('SLACK_BOT_USER_OAUTH_TOKEN'),
            'channel' => env('SLACK_BOT_USER_DEFAULT_CHANNEL'),
        ],
    ],

    'whatsapp' => [
        /** رابط احتياطي إن لم يُعرف الجنس أو كانت القيمة غير متوقعة */
        'group_invite_url' => env('WHATSAPP_GROUP_INVITE_URL'),
        /** مجموعة المشاركين — ذكر */
        'group_invite_url_male' => env(
            'WHATSAPP_GROUP_INVITE_URL_MALE',
            'https://chat.whatsapp.com/JT3lsUQg2wD1OLeAj26rKh?mode=gi_t'
        ),
        /** مجموعة المشاركات — أنثى */
        'group_invite_url_female' => env(
            'WHATSAPP_GROUP_INVITE_URL_FEMALE',
            'https://chat.whatsapp.com/Gs9ZQcHbhRYFuDFbsVEMY7?mode=gi_t'
        ),
    ],

    /** الموقع الرسمي لجمعية كفاءات (زر الفوتر) */
    'kafaat' => [
        'website_url' => env('KAFAAT_WEBSITE_URL', 'https://kafaat.org.sa'),
    ],

    /*
    | رابط زر «التوجه للموقع» في صفحة تفاصيل الملتقى (خرائط أو موقع مسرح الحدث).
    */
    'event_venue_url' => env(
        'EVENT_VENUE_URL',
        'https://www.google.com/maps/search/?api=1&query='.rawurlencode('مسرح مركز التنمية الاجتماعية، بريدة')
    ),

];
