<?php

/**
 * Part of the Antares Project package.
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
 * @copyright  (c) 2017, Antares Project
 * @link       http://antaresproject.io
 */

namespace Antares\Logger\Http\Datatables;

use Antares\Logger\Http\Filter\ActivityTypeFilter;
use Antares\Datatables\Services\DataTable;
use Illuminate\Contracts\View\Factory;
use Antares\Logger\Model\LogTypes;
use Antares\Datatables\Datatables;
use Antares\Support\Facades\Form;
use Antares\Logger\Model\Logs;
use Antares\Support\Str;
use Exception;

class ActivityLogs extends DataTable
{

    /**
     * Ajax url
     * 
     * @var String
     */
    protected $ajax = 'antares::logger/activity/index';

    /**
     * how many items per page
     *
     * @var mixed 
     */
    public $perPage = 25;

    /**
     * availbale filters
     *
     * @var type 
     */
    protected $filters = [
        ActivityTypeFilter::class
    ];

    /**
     * Components colors map
     *
     * @var array 
     */
    protected $colors = [];

    /**
     * Type identifier
     *
     * @var mixed 
     */
    protected $typeId = null;

    /**
     * Constructing
     * 
     * @param Datatables $datatables
     * @param Factory $viewFactory
     */
    public function __construct(Datatables $datatables, Factory $viewFactory)
    {
        parent::__construct($datatables, $viewFactory);
        $this->colors = $this->colors();
        if (!is_null($this->typeId = from_route('typeId'))) {
            $this->ajax = 'antares::logger/activity/index/type/' . $this->typeId;
        }
    }

    /**
     * Creates components color map
     * 
     * @return array
     */
    protected function colors()
    {
        $extensions = ['core'] + array_keys(app('antares.memory')->make('component')->get('extensions.active'));
        $colors     = config('colors');
        $index      = 0;
        $components = array_map(function($current) {
            return trim(str_replace('components', '', $current), '/');
        }, $extensions);
        $return = [];
        foreach ($components as $index => $component) {
            $color = array_get($colors, $index, '000');
            array_set($return, $component, '#' . $color);
        }
        return $return;
    }

    /**
     * {@inheritdoc}
     */
    public function query()
    {
        $query = Logs::withoutGlobalScopes()->select([
                    'tbl_brands.name as brand_name',
                    'tbl_log_types.name as component_name',
                    'tbl_log_priorities.name as priority_name',
                    'tbl_logs.*',
                ])
                ->leftJoin('tbl_brands', 'tbl_logs.brand_id', '=', 'tbl_brands.id')
                ->leftJoin('tbl_log_priorities', 'tbl_logs.priority_id', '=', 'tbl_log_priorities.id')
                ->leftJoin('tbl_log_types', 'tbl_logs.type_id', '=', 'tbl_log_types.id')
                ->leftJoin('tbl_logs_translations', function($join) {
                    $join->on('tbl_logs_translations.log_id', '=', 'tbl_logs.id')->on('tbl_logs_translations.lang_id', '=', \Illuminate\Support\Facades\DB::raw(lang_id()));
                })
                ->where('tbl_logs.brand_id', brand_id())
                ->where('tbl_logs.is_api_request', 0);
        if (!is_null($this->typeId)) {
            $query->where('tbl_log_types.id', $this->typeId);
        }

        listen('datatables.order.operation', function($query, $direction) {
            $query->orderBy('tbl_logs.name', $direction)->orderBy('tbl_logs.type_id', $direction);
        });
        listen('datatables.order.created_at', function($query, $direction) {
            $query->orderBy('tbl_logs.id', 'desc');
        });



        return $query;
    }

    /**
     * {@inheritdoc}
     */
    public function ajax()
    {

        $acl               = app('antares.acl')->make('antares/logger');
        $canShowDetails    = $acl->can('activity-show-details');
        $canActivityDelete = $acl->can('activity-delete-log');
        $row               = null;
        $return            = $this->prepare()
                        ->filterColumn('component_name', function ($query, $keyword) {
                            $query->whereRaw("tbl_log_types.name like '%$keyword%'");
                        })
                        ->filter(function($query) {
                            $keyword = array_get(app('request')->get('search'), 'value');
                            if (is_null($keyword) or ! strlen($keyword)) {
                                return;
                            }
                            $query->whereRaw("(tbl_logs_translations.raw like '%$keyword%' or tbl_logs.old_value like '%$keyword%' or tbl_logs.new_value like '%$keyword%' or tbl_logs.related_data like '%$keyword%' or tbl_logs.ip_address like '%$keyword%' or tbl_logs.created_at like '%$keyword%' or tbl_log_priorities.name like '%$keyword%' or tbl_log_types.name like '%$keyword%')");
                        })
                        ->editColumn('component_name', $this->getTypeValue($row))
                        ->editColumn('priority', $this->getPriorityValue($row))
                        ->editColumn('operation', $this->getOperationValue($row))
                        ->editColumn('created_at', function ($model) {
                            return format_x_days($model->created_at);
                        })->addColumn('action', $this->getActionsColumn($canShowDetails, $canActivityDelete));
        if (extension_active('multibrand')) {
            $return->editColumn('brand_name', $this->getBrandValue($row));
        }
        return $return->make(true);
    }

    /**
     * Gets operation value
     * 
     * @param \Illuminate\Database\Eloquent\Model $row
     * @return Closure
     */
    public function getOperationValue()
    {

        return function($row) {
            try {
                return $row->translated();
            } catch (Exception $ex) {
                return '---';
            }
        };
    }

    /**
     * Gets priority value
     * 
     * @param \Illuminate\Database\Eloquent\Model $row
     * @return Closure
     */
    public function getPriorityValue()
    {

        return function($row) {
            return priority_label($row->priority_name);
        };
    }

    /**
     * Gets type value
     * 
     * @param \Illuminate\Database\Eloquent\Model $row
     * @return Closure
     */
    public function getTypeValue()
    {
        return function($row) {
            $name  = is_null($row->component_name) ? 'core' : $row->component_name;
            $color = isset($this->colors[$name]) ? $this->colors[$name] : '#000';
            return '<span class="label-circle" data-color="' . $color . '" >' . ucfirst(Str::humanize($name)) . '</span>';
        };
    }

    /**
     * Gets component name for csv
     * 
     * @return String
     */
    public function getComponent_nameValue()
    {
        return $this->getTypeValue();
    }

    /**
     * Gets brand value
     * 
     * @param \Illuminate\Database\Eloquent\Model $row
     * @return Closure
     */
    public function getBrandValue()
    {

        return function($row) {
            return $row->brand_name;
        };
    }

    /**
     * {@inheritdoc}
     */
    public function html()
    {
        $html = $this->setName('Activity Logs')
                ->addColumn(['data' => 'id', 'name' => 'id', 'title' => trans('Id')]);

        $columnsDef = [
            ['width' => '3%', 'targets' => 0],
            ['width' => '10%', 'targets' => 4],
            ['width' => '10%', 'targets' => 5],
        ];

        if (extension_active('multibrand')) {
            $html->addColumn(['data' => 'brand_name', 'name' => 'brand_name', 'title' => trans('Brand'), 'class' => 'desktop']);
            $columnsDef = array_merge($columnsDef, [
                ['width' => '6%', 'targets' => 1],
                ['width' => '10%', 'targets' => 2],
                ['width' => '1%', 'targets' => 7]]);
        } else {
            $columnsDef = array_merge($columnsDef, [
                ['width' => '10%', 'targets' => 1],
                ['width' => '7%', 'targets' => 3],
                ['width' => '1%', 'targets' => 6]]);
        }


        return $html->addColumn(['data' => 'component_name', 'name' => 'component_name', 'title' => trans('Type')])
                        ->addColumn(['data' => 'operation', 'name' => 'operation', 'title' => trans('Operation')])
                        ->addColumn(['data' => 'priority', 'name' => 'priority', 'title' => trans('Priority'), 'class' => 'desktop'])
                        ->addColumn(['data' => 'ip_address', 'name' => 'ip_address', 'title' => trans('Ip Address'), 'class' => 'desktop'])
                        ->addColumn(['data' => 'created_at', 'name' => 'created_at', 'title' => trans('Created at'), 'class' => 'desktop'])
                        ->addAction(['name' => 'edit', 'title' => '', 'class' => 'mass-actions dt-actions', 'orderable' => false, 'searchable' => false])
                        ->addMassAction('delete', app('html')->link(handles('antares::logger/activity/delete', ['csrf' => true]), app('html')->raw('<i class="zmdi zmdi-delete"></i><span>' . trans('Delete') . '</span>'), [
                                    'class'            => "triggerable confirm mass-action",
                                    'data-title'       => trans("Are you sure?"),
                                    'data-description' => trans('Deleting logs'),
                        ]))
                        ->addGroupSelect($this->typesSelect())
                        ->ajax(handles($this->ajax))
                        ->parameters([
                            'order'        => [[5, 'desc']],
                            'aoColumnDefs' => $columnsDef
        ]);
    }

    /**
     * Creates select for types
     *
     * @return String
     */
    protected function typesSelect()
    {
        $types    = app(LogTypes::class)->select(['name', 'id'])->get();
        $options  = ['' => trans('antares/logger::messages.all')];
        $selected = request()->ajax() ? null : 1;
        if (!is_null($this->typeId) && !is_null($found    = $types->where('id', (int) $this->typeId)->first())) {
            $selected = $found->name;
        }
        foreach ($types as $type) {
            array_set($options, $type->name, ucfirst(Str::humanize($type->name)));
        }

        $classname = 'logs-select-type';
        $column    = extension_active('multibrand') ? 2 : 1;
        app('antares.asset')->container('antares/foundation::scripts')->inlineScript('grid-stack', $this->inline($classname, $column));

        return Form::select('type', $options, $selected, [
                    'data-prefix'            => '',
                    'data-selectAR--mdl-big' => "true",
                    'class'                  => $classname . ' mr24 select2--prefix',
        ]);
    }

    /**
     * Generate datatable inline type selector
     * 
     * @param String $classname
     * @param mixed $column
     * @return String
     */
    protected function inline($classname, $column)
    {
        $inline = <<<EOD
           $(document).ready(function(){                         
                $('.%s', document).on('change', function (e) {
                    var table = $(this).closest('.tbl-c').find('[data-table-init]');
                    if (table.length < 0) {
                        return false;
                    }
                    var api = table.dataTable().api();
                    var val = $.fn.dataTable.util.escapeRegex($(this).val());
                    api.column(%s).search(val, true, false).draw();
                });            
           });
EOD;
        return sprintf($inline, $classname, $column);
    }

    /**
     * Get actions column for table builder.
     * @return callable
     */
    protected function getActionsColumn($canShowDetails, $canActivityDelete)
    {
        return function ($row) use($canShowDetails, $canActivityDelete) {
            $btns = [];
            $html = app('html');
            if ($canShowDetails) {
                if ($row->name === 'JOBRESULTS_CREATED') {
                    $btns[] = $html->create('li', $html->link(handles('antares::automation/show/' . $row->job_id), trans('antares/logger::messages.show_full_log'), ['data-icon' => 'desktop-windows']));
                } else {
                    $btns[] = $html->create('li', $html->link(handles('antares::logger/activity/show/' . $row->id), trans('antares/logger::messages.show_details'), ['data-icon' => 'desktop-windows']));
                }
            }
            if ($canActivityDelete) {
                $btns[] = $html->create('li', $html->link(handles('antares::logger/activity/delete/' . $row->id), trans('antares/logger::messages.delete'), ['class' => "triggerable confirm", 'data-icon' => 'delete', 'data-title' => trans('antares/logger::messages.delete_ask'), 'data-description' => trans('antares/logger::messages.delete_message', ['id' => $row->id])]));
            }
            if (empty($btns)) {
                return '';
            }
            $section = $html->create('div', $html->create('section', $html->create('ul', $html->raw(implode('', $btns)))), ['class' => 'mass-actions-menu', 'data-id' => $row->id])->get();
            return '<i class="zmdi zmdi-more"></i>' . $html->raw($section)->get();
        };
    }

}
