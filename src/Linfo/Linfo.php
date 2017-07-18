<?php

namespace Antares\Logger\Linfo;

use Linfo\Linfo as BaseLinfo;

class Linfo extends BaseLinfo
{

    protected function getOS()
    {
        list($os) = explode('_', PHP_OS, 2);
        if ($os === 'Linux') {
            return 'LinuxNoCpuPercentage';
        }
        // This magical constant knows all
        switch ($os) {

            // These are supported
            case 'Linux':
            case 'FreeBSD':
            case 'DragonFly':
            case 'OpenBSD':
            case 'NetBSD':
            case 'Minix':
            case 'Darwin':
            case 'SunOS':
                return PHP_OS;
                break;
            case 'WINNT':
                return 'Windows';
                break;
        }

        // So anything else isn't
        return false;
    }

}
