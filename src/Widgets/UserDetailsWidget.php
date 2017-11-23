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

namespace Antares\Logger\Widgets;

use Antares\UI\UIComponents\Adapter\AbstractTemplate;
use Antares\Model\User;

class UserDetailsWidget extends AbstractTemplate
{

    /**
     * name of widget
     * 
     * @var String 
     */
    public $name = 'User Details';

    /**
     * Template for widget
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
        'x'              => 0,
        'y'              => 0,
        'min_width'      => 5,
        'min_height'     => 5,
        'max_width'      => 52,
        'max_height'     => 52,
        'default_width'  => 5,
        'default_height' => 20,
        'desktop'        => [
            0, 0, 5, 20
        ],
        'tablet'         => [
            0, 0, 8, 20
        ],
        'mobile'         => [
            0, 0, 9, 20
        ]
    ];

    /**
     * Where widget should be available 
     *
     * @var array
     */
    protected $views = [
        'antares/foundation::admin.users.show'
    ];

    /**
     * render widget content
     * 
     * @return String | mixed
     */
    public function render()
    {
        $user = User::query()->findOrFail(from_route('user'));
        return view('antares/logger::admin.widgets.user_details', ['user' => $user])->render();
    }

}
