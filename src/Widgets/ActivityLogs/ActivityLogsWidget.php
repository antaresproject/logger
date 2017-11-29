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
        'min_width'          => 12,
        'min_height'         => 14,
        'max_width'          => 52,
        'max_height'         => 52,
        'default_width'      => 12,
        'default_height'     => 14,
        'enlargeable'        => false,
        'titlable'           => true,
        'card_class'         => 'card--pagination card--logs',
        'card_content_class' => 'datarow flex ff-cnw jc-flex-start',
        'tablet'             => [0, 36, 24, 14],
        'mobile'             => [0, 36, 24, 14]
    ];

    /**
     * ParamsProcessor instance
     *
     * @var ParamsProcessor 
     */
    protected $paramsProcessor;

    /**
     * ActivityLogsWidget constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->paramsProcessor = app(ParamsProcessor::class);
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
        $params = $this->paramsProcessor->get();
        publish('logger', ['js/logs.js']);
        publish('logger', ['css/zero_data.css']);

        return view('antares/logger::admin.widgets.logs', $this->paramsProcessor->get())->render();
    }

}
