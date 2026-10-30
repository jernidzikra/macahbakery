<?php

if (!function_exists('isOpen')) {
    function isOpen($open = '07:00', $close = '19:00')
    {
        $now = now()->format('H:i');
        return $now >= $open && $now <= $close;
    }
}

if (!function_exists('getOpenStatus')) {
    function getOpenStatus($open = '07:00', $close = '19:00')
    {
        if (isOpen($open, $close)) {
            return [
                'status' => 'Buka Sekarang',
                'color' => '#4CAF50',
                'icon' => 'fa-store'
            ];
        } else {
            return [
                'status' => 'Tutup',
                'color' => '#dc3545',
                'icon' => 'fa-clock'
            ];
        }
    }
}