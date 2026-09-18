<?php

return [
    'rate' => (int) env('LAUNDRY_RATE', 10000),
    'whatsapp_number' => env('WHATSAPP_NUMBER', '6287833648640'),
    'statuses' => [
        'received' => 'Received',
        'washing' => 'Washing',
        'drying' => 'Drying',
        'ironing' => 'Ironing',
        'ready' => 'Ready to Pick Up',
    ],
];
