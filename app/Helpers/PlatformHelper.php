<?php

namespace App\Helpers;

class PlatformHelper
{
    public static function getPlatformIcon($platform_id)
    {
        switch ($platform_id) {
            case 1:
                return '<i class="bi bi-windows"></i>';
            case 2:
                return '<i class="bi bi-playstation text-xl"></i>' ;
            case 3:
                return '<img src="' . asset('storage/platforms/ps2.svg') . '" alt="PS2" style="min-width: 100%; min-height: 100%; max-width: max-content; max-height: max-content;">' ;
            default:
                return '<span>Unknown Platform</span>';
        }
    }

    public static function getPlatformName($platform_id)
    {
        switch ($platform_id) {
            case 1:
                return '<p>Windows</p>';
            case 2:
                return '<p>PlayStation 1</p>' ;
            case 3:
                return '<p>PlayStation 2</p>' ;
            default:
                return '<span>Unknown Platform</span>';
        }
    }
}