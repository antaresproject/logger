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

namespace Antares\Logger\Events;

use Antares\Logger\Model\Location;
use Antares\Model\User;
use Carbon\Carbon;
use Illuminate\Support\Arr;

class NewDeviceDetected
{

    /**
     * User instance.
     *
     * @var User
     */
    public $user;

    /**
     * DateTime of detection
     *
     * @var Carbon
     */
    public $dateTime;

    /**
     * Detection parameters.
     *
     * @var array
     */
    public $location;

    /**
     * NewDeviceDetected constructor.
     * @param User $user
     * @param Location $location
     */
    public function __construct(User $user, Location $location) {
        $this->user         = $user;
        $this->location     = $location;
        $this->dateTime     = Carbon::now();
    }

}