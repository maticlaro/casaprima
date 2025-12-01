<?php

return [
    'timezone' => 'America/Santiago',

    // Minutes between slot starts
    'slot_interval_minutes' => 30,

    // Buffer minutes added to each appointment (before/after combined)
    'per_appointment_buffer_minutes' => 15,

    // Business hours per weekday (24h format)
    // 1 = Monday ... 7 = Sunday
    'business_hours' => [
        1 => ['start' => '09:00', 'end' => '18:00'],
        2 => ['start' => '09:00', 'end' => '18:00'],
        3 => ['start' => '09:00', 'end' => '18:00'],
        4 => ['start' => '09:00', 'end' => '18:00'],
        5 => ['start' => '09:00', 'end' => '18:00'],
        6 => ['start' => '10:00', 'end' => '14:00'],
        7 => null, // closed
    ],

    // Company holidays (YYYY-MM-DD)
    'holidays' => [
        // '2025-09-18', '2025-09-19'
    ],
];
