<?php

if (! function_exists('status_badge')) {
    function status_badge($status)
    {
        $colors = [
            'to_be_fixed' => 'bg-red-500 text-white',
            'fixing'      => 'bg-yellow-500 text-black',
            'fixed'       => 'bg-green-500 text-white',
        ];

        $labels = [
            'to_be_fixed' => 'To Be Fixed',
            'fixing'      => 'Fixing',
            'fixed'       => 'Fixed',
        ];

        $color = $colors[$status] ?? 'bg-gray-500 text-white';
        $label = $labels[$status] ?? ucfirst($status);

        return "<span class='px-3 py-1 rounded font-semibold {$color}'>{$label}</span>";
    }
}
