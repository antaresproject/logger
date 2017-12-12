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
 * @package    Notifications
 * @version    0.9.2
 * @author     Antares Team
 * @license    BSD License (3-clause)
 * @copyright  (c) 2017, Antares
 * @link       http://antaresproject.io
 */

namespace Antares\Logger\Listener;

use Antares\Memory\Model\Option;

class ConfigurationListenerSave
{

    /**
     * Handles the general settings save.
     */
    public function handle()
    {
        if (is_null($days = input('activity_log_days'))) {
            return;
        }
        $option        = Option::query()->firstOrCreate(['name' => 'activity_logs_remove_after_days']);
        $option->value = $days;
        $option->save();
    }

}
