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
 * @version    0.9.2
 * @author     Antares Team
 * @license    BSD License (3-clause)
 * @copyright  (c) 2017, Antares
 * @link       http://antaresproject.io
 */

namespace Antares\Logger\Widgets;

use Antares\Logger\Model\Logs;
use Antares\UI\UIComponents\Adapter\AbstractTemplate;
use DB;

class UsersOnline extends AbstractTemplate
{

    /**
     * name of widget
     * 
     * @var String 
     */
    public $name = 'Users Online';

    /**
     * Title of widget in top bar
     *
     * @var String 
     */
    protected $title = 'Users Online';

    /**
     * Name of template used by widget
     * 
     * @var String
     */
    protected $template = 'empty';

    /**
     * widget attributes
     *
     * @var array
     */
    protected $attributes = [
        'min_width'      => 3,
        'min_height'     => 11,
        'max_width'      => 12,
        'max_height'     => 52,
        'default_width'  => 3,
        'default_height' => 11
    ];

    /**
     * render widget content
     * 
     * @return String | mixed
     */
    public function render()
    {
        $query = Logs::query()->select( DB::raw('user_id, MAX(created_at) as created_at') )
                ->groupBy('user_id')
                ->whereNotNull('user_id')
                ->with('user');

        if( auth()->check() ) {
            $query->where('user_id', '<>', auth()->user()->id);
        }

        $items = $query->get();

        return view('antares/logger::admin.widgets.users_online', compact('items'))->render();
    }

}
