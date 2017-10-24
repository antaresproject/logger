<?php

/**
 * Part of the Antares package.
 *
 * NOTICE OF LICENSE
 *
 * Licensed under the 3-clause BSD License.
 *
 * This source file is subject to the 3-clause BSD License that is
 * bundled with this package in the LICENSE file.
 *
 * @package    Logger
 * @version    0.9.0
 * @author     Antares Team
 * @license    BSD License (3-clause)
 * @copyright  (c) 2017, Antares
 * @link       http://antaresproject.io
 */

namespace Antares\Logger\Listeners;

use Antares\Logger\Events\NewDeviceDetected;
use Antares\Logger\Notifications\NewDeviceDetectedNotification;
use Antares\Notifications\Facade\Notification;

class SendMailAboutNewDeviceDetected {

    public function handle(NewDeviceDetected $event) {
        Notification::send($event->user, new NewDeviceDetectedNotification($event));
    }

}