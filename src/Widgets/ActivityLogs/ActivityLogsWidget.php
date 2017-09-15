<?php

namespace Antares\Logger\Widgets\ActivityLogs;

use Antares\Logger\Widgets\ActivityLogs\Controller\ActivityLogsController;
use Antares\Logger\Widgets\ActivityLogs\Processor\ParamsProcessor;
use Antares\UI\UIComponents\Adapter\AbstractTemplate;
use Illuminate\Support\Facades\Route;

class ActivityLogsWidget extends AbstractTemplate
{

    /**
     * name of widget
     * 
     * @var String 
     */
    public $name = 'Logs';

    /**
     * Title of widget in top bar
     *
     * @var String 
     */
    protected $title = 'Recent Activity';

    /**
     * widget attributes
     *
     * @var array
     */
    protected $attributes = [
        'min_width'      => 6,
        'min_height'     => 6,
        'max_width'      => 12,
        'max_height'     => 52,
        'default_width'  => 7,
        'default_height' => 16,
        'enlargeable'    => false,
        'titlable'       => true,
        'card_class'     => 'card--logs card--scrollbox',
    ];

    /**
     * ParamsProcessor instance
     *
     * @var ParamsProcessor 
     */
    protected $processor;

    /**
     * {@inheritdoc}
     */
    public function __construct()
    {
        parent::__construct();
        $this->processor = app(ParamsProcessor::class);
    }

    /**
     * Definition of widget routes
     * 
     * @return \Symfony\Component\Routing\Router
     */
    public static function routes()
    {
        Route::match(['GET', 'POST'], area() . '/activity-logs/index/{user?}', ActivityLogsController::class . '@index')->middleware('antares');
    }

    /**
     * render widget content
     * 
     * @return String | mixed
     */
    public function render()
    {
        publish('logger', ['js/logs.js']);
        publish('logger', ['css/zero_data.css']);
        return view('antares/logger::admin.widgets.logs', $this->processor->get())->render();
    }

}
