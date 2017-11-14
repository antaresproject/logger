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

namespace Antares\Logger\Http\Handlers;

use Antares\Foundation\Support\MenuHandler;
use Antares\Contracts\Authorization\Authorization;

class ActivityLogsShowBreadcrumbMenu extends MenuHandler
{

    /**
     * Menu configuration.
     *
     * @var array
     */
    protected $menu = [
        'id'   => 'logger-breadcrumb',
        'link' => 'antares::logger/activity/index',
        'icon' => null,
        'boot' => [
            'group' => 'menu.top.logger',
            'on'    => 'antares/logger::admin.activity.show'
        ]
    ];

    /**
     * Get the title.
     * @param  string  $value
     * @return string
     */
    public function getTitleAttribute($value)
    {
        return '#' . from_route('id');
    }

    /**
     * Check authorization to display the menu.
     * @param  \Antares\Contracts\Authorization\Authorization  $acl
     * @return bool
     */
    public function authorize(Authorization $acl)
    {
        return true;
    }

    /**
     * Create a handler.
     * @return void
     */
    public function handle()
    {
        if (!$this->passesAuthorization() or is_null($id = from_route('id'))) {
            return;
        }
        $this->createMenu();


        $this->handler
                ->add('activity-log-delete', '^:logger-breadcrumb')
                ->title(trans('antares/logger::messages.activity_logs_delete'))
                ->icon('zmdi-delete')
                ->link(handles('antares::logger/activity/delete/' . $id))
                ->attributes([
                    'data-title'       => trans('antares/logger::messages.delete_ask'),
                    'data-description' => trans('antares/logger::messages.delete_message', ['id' => $id]),
                    'class'            => 'triggerable confirm'
        ]);
    }

}
