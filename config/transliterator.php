<?php

return [
    'default' => env('TRANSLITERATOR', 'alif'),

    'services' => [
        'alif' => [
            'class' => Zvermafia\Transliteration\AlifTransliterator::class,
        ],
        'lotin' => [
            'class' => Zvermafia\Transliteration\LotinTransliterator::class,
        ],
    ],
];
