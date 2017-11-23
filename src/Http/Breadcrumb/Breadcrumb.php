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

namespace Antares\Logger\Http\Breadcrumb;

use DaveJamesMiller\Breadcrumbs\Facade as Breadcrumbs;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;

class Breadcrumb
{

    /**
     * shows breadcrumbs on devices list
     */
    public function onDevicesList()
    {
        Breadcrumbs::register('devices-list', function($breadcrumbs) {
            $breadcrumbs->push('Devices', handles('antares::logger/devices'));
        });

        view()->share('breadcrumbs', Breadcrumbs::render('devices-list'));
    }

    /**
     * shows breadcrumbs on device edit;
     * 
     * @param Model $model
     * @return void
     */
    public function onEditDevice($model)
    {
        $this->onDevicesList();
        Breadcrumbs::register('device-edit', function($breadcrumbs) use($model) {
            $breadcrumbs->parent('devices-list');
            $breadcrumbs->push('Edit #' . $model->id . ', ' . $model->machine, handles('antares::logger/devices/' . $model->id . '/edit'));
        });
        view()->share('breadcrumbs', Breadcrumbs::render('device-edit'));
    }

    /**
     * when shows edit notification form
     * 
     * @param Model $eloquent
     */
    public function onSystem()
    {
        Breadcrumbs::register('error-log', function($breadcrumbs) {
            $breadcrumbs->push('Error Log', handles('antares::logger/system/index'));
        });
        $view = !is_null(from_route('date')) ? view('antares/logger::admin.partials._breadcrumb')->render() : Breadcrumbs::render('error-log');
        view()->share('breadcrumbs', $view);
    }

    /**
     * Breadcrumbs when list of activity
     * 
     * @param String $type
     * @param array $params
     */
    public function onActivity($type = null, $params = [])
    {

        Breadcrumbs::register('logger-activity', function($breadcrumbs) use($params) {
            $breadcrumbs->push('Activity Log', handles('antares::logger/activity/index'), $params);
        });
        if (!is_null($type)) {
            Breadcrumbs::register('logger-activity-' . $type, function($breadcrumbs) use($type) {
                $breadcrumbs->push(ucfirst($type) . ' Log', handles('antares::logger/activity/' . $type));
            });
            view()->share('breadcrumbs', Breadcrumbs::render('logger-activity-' . $type));
        } else {
            view()->share('breadcrumbs', Breadcrumbs::render('logger-activity'));
        }
    }

    /**
     * breadcrummbs when shows request log page
     */
    public function onRequestIndex()
    {
        Breadcrumbs::register('logger-request', function($breadcrumbs) {
            $breadcrumbs->push('Request Log', handles('antares::logger/request/index'));
        });
        view()->share('breadcrumbs', Breadcrumbs::render('logger-request'));
    }

    /**
     * Breadcrummbs when shows request log details
     */
    public function onRequestDetails()
    {
        Breadcrumbs::register('logger-request', function($breadcrumbs) {
            $breadcrumbs->push('Request Log', handles('antares::logger/request/index'), ['force_link' => true]);
        });
        $date = Request::route()->parameter('date');
        Breadcrumbs::register('logger-request-' . $date, function($breadcrumbs) use($date) {
            $breadcrumbs->parent('logger-request');
        });
        view()->share('breadcrumbs', Breadcrumbs::render('logger-request-' . $date));
    }

    /**
     * breadcrummbs when shows system informations
     */
    public function onSystemInformations()
    {
        Breadcrumbs::register('logger-system-informations', function($breadcrumbs) {
            $breadcrumbs->push('System Information', handles('antares::logger/information/index'));
        });
        view()->share('breadcrumbs', Breadcrumbs::render('logger-system-informations'));
    }

    /**
     * breadcrummbs when shows reports history
     */
    public function onReportsHistory()
    {
        $this->onSystemInformations();
        Breadcrumbs::register('logger-reports-history', function($breadcrumbs) {
            $breadcrumbs->parent('logger-system-informations');
            $breadcrumbs->push('Reports history', handles('antares::logger/history'));
        });
        view()->share('breadcrumbs', Breadcrumbs::render('logger-reports-history'));
    }

    /**
     * breadcrummbs when shows preview html report
     * 
     * @param Model $model
     */
    public function onPreviewHtmlReport(Model $model)
    {
        $this->onReportsHistory();
        Breadcrumbs::register('logger-reports-preview-' . $model->id, function($breadcrumbs) use($model) {
            $breadcrumbs->parent('logger-reports-history');
            $breadcrumbs->push('Preview report ' . $model->name, handles('antares::logger/view/' . $model->id));
        });
        view()->share('breadcrumbs', Breadcrumbs::render('logger-reports-preview-' . $model->id));
    }

}
