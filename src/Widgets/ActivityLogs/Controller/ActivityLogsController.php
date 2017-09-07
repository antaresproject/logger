<?php

namespace Antares\Logger\Widgets\ActivityLogs\Controller;

use Antares\Logger\Widgets\ActivityLogs\Processor\ParamsProcessor;
use Antares\Logger\Widgets\ActivityLogs\Filter\ActivityTypeFilter;
use Antares\Foundation\Http\Controllers\AdminController;
use Antares\Datatables\Adapter\FilterAdapter;

class ActivityLogsController extends AdminController
{

    /**
     * ParamsProcessor instance
     *
     * @var ParamsProcessor
     */
    protected $processor;

    /**
     * Construct
     * 
     * @param ParamsProcessor $processor
     */
    public function __construct(ParamsProcessor $processor)
    {
        parent::__construct();
        $this->processor = $processor;
    }

    /**
     * route acl access controlling
     */
    public function setupMiddleware()
    {
        $this->middleware("web");
        $this->middleware("antares.auth");
    }

    /**
     * Index action, list of logs
     * 
     * @param mixed $id
     * @return \Illuminate\View\View
     */
    public function index($id = null)
    {
        $filter = app(FilterAdapter::class);
        $filter->add(ActivityTypeFilter::class);

        $this->processor->setUid($id)->setFilter($filter);

        return view('antares/logger::admin.widgets.logs', $this->processor->get(input('search')));
    }

}
