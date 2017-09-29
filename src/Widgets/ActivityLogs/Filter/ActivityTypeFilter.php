<?php

namespace Antares\Logger\Widgets\ActivityLogs\Filter;

use Yajra\Datatables\Contracts\DataTableScopeContract;
use Antares\Datatables\Filter\SelectFilter;
use Antares\Logger\Model\LogTypes;
use Antares\Support\Str;

class ActivityTypeFilter extends SelectFilter implements DataTableScopeContract
{

    /**
     * name of filter
     *
     * @var String 
     */
    protected $name = 'Types';

    /**
     * column to search
     *
     * @var String
     */
    protected $column = 'type';

    /**
     * filter pattern
     *
     * @var String
     */
    protected $pattern = 'Type: %value';

    /**
     * filter instance dataprovider
     * 
     * @return array
     */
    protected function options()
    {
        $types  = app(LogTypes::class)->select(['name', 'id'])->get();
        $return = [];
        foreach ($types as $type) {
            $return = array_add($return, $type->id, ucfirst(Str::humanize($type->name)));
        }
        return $return;
    }

    /**
     * filters data by parameters from memory
     * 
     * @param mixed $builder
     */
    public function apply($builder)
    {
        $values = $this->getValues();
        if (empty($values)) {
            return $builder;
        }

        return $builder->whereHas('component', function($query) use($values) {
                    $query->whereIn('id', $values);
                });
    }

    /**
     * {@inheritdoc}
     */
    public function render()
    {
        publish('automation', ['js/automation_status_filter.js']);
        $selected = $this->getValues();
        return view('datatables-helpers::partials._filter_select_multiple', [
                    'options'  => $this->options(),
                    'column'   => $this->column,
                    'selected' => $selected
                ])->render();
    }

}
