<?php
if (!function_exists('generateInitials')) {
    function generateInitials($fullName)
    {
        $words = explode(' ', $fullName);
        $initials = '';

        foreach ($words as $word) {
            $initials .= strtoupper(substr($word, 0, 1));
        }

        return $initials;
    }
}

if (!function_exists('getStatusColor')) {
    function getStatusColor($status)
    {
        switch ($status) {
            case 'menunggu konfirmasi':
                return '#007bff'; // Blue
            case 'revisi':
                return '#ffab00'; // Orange
            case 'acc':
                return '#71dd37'; // Green
            default:
                return '#000000'; // Default color (black)
        }
    }
}
?>
