<?php
if (!function_exists('generateInitials')) {
    function generateInitials($fullName, $maxChars = 2)
    {
        // Validasi input
        if (!is_string($fullName) || empty($fullName)) {
            return '';
        }

        $words = explode(' ', $fullName);
        $initials = '';

        foreach ($words as $word) {
            $initials .= strtoupper(substr($word, 0, 1));
        }

        // Batasi inisial hingga maksimal $maxChars karakter
        $initials = substr($initials, 0, $maxChars);

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
