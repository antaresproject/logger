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
 * @package    Notifications
 * @version    0.9.2
 * @author     Antares Team
 * @license    BSD License (3-clause)
 * @copyright  (c) 2017, Antares
 * @link       http://antaresproject.io
 */

namespace Antares\Logger\Listener;

use Antares\Memory\Model\Option;
use Antares\Html\Form\Fieldset;
use Illuminate\Support\Fluent;
use Antares\Html\Form\Grid;

class ConfigurationListener
{

    /**
     * Handles the security form event.
     *
     * @param Fluent $model
     * @param Grid $grid
     */
    public function handle(Fluent $model, Grid $grid)
    {
        $grid->fieldset(function(Fieldset $fieldset) {
            $fieldset->legend(trans('antares/logger::global.form.activity_log_config_legend'));

            $fieldset->control('raw', 'activity_log_days')
                    ->label('')
                    ->field(function() {
                        $memory = app('antares.memory')->make('primary');
                        return trans('antares/logger::global.form.activity_log_config_days_label', ['x' => '<input class="w50" type="number" name="activity_log_days" value="' . $memory->get('activity_logs_remove_after_days', config('antares/logger::activity_log.remove_interval')) . '" size="2" max-length="2"  />']);
                    });
            $fieldset->control('input:text', 'help')
                    ->label('')
                    ->wrapper(['class' => 'col-dt-24 col-24 col-mb-24'])
                    ->fieldClass('input-field__desc')
                    ->field(function() {
                        return trans('antares/logger::global.form.activity_log_config_days_help');
                    });
        });
        $grid->rules(array_merge($grid->rules, [
            'activity_log_days' => ['numeric'],
        ]));
    }

    /**
     * Save notifications configuration
     *
     * @param Option $model
     * @return bool
     */
    public function updated(Option $model)
    {

        $model        = Option::query()->firstOrNew([
            'name' => 'notifications_remove_after_days'
        ]);
        $model->value = input('days');
        return $model->save();
    }

}
