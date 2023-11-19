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
?>