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
 * @package    Antares Core
 * @version    0.9.2
 * @author     Antares Team
 * @license    BSD License (3-clause)
 * @copyright  (c) 2017, Antares
 * @link       http://antaresproject.io
 */

namespace Antares\Logger\Widgets\Http\Controllers;

use Antares\Foundation\Http\Controllers\AdminController;
use Antares\Logger\Widgets\ActivityLogsWidget;

class ActivityLogsController extends AdminController
{

    /**
     * {@inheritdoc}
     */
    public function setupMiddleware()
    {
        $this->middleware('web');
    }

    /**
     * Ajax response for invoice activity logs query
     * 
     * @param ActivityLogsWidget $widget
     * @return \Illuminate\View\View
     */
    public function logs(ActivityLogsWidget $widget)
    {
        return view('antares/logger::admin.widgets.logs', $widget::getParams());
    }

}
