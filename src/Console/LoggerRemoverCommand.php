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

namespace Antares\Logger\Console;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Antares\View\Console\Command;
use Antares\Logger\Model\Logs;
use ZipArchive;
use Exception;

class LoggerRemoverCommand extends Command
{

    /**
     * human readable command name
     *
     * @var String
     */
    protected $title = 'Activity logs remover';

    /**
     * when command should be executed
     *
     * @var String
     */
    protected $launched = 'daily';

    /**
     * when command can be executed
     *
     * @var array
     */
    protected $availableLaunches = [
        'everyFiveMinutes',
        'everyTenMinutes',
        'everyThirtyMinutes',
        'hourly',
        'daily'
    ];

    /**
     * The console command name.
     *
     * @var String
     */
    protected $name = 'logger:remove-olds';

    /**
     * The console command description.
     *
     * @var String
     */
    protected $description = 'Remove logger activity logs after days stored in configuration file.';

    /**
     * Builder instance
     *
     * @var \Illuminate\Database\Eloquent\Builder 
     */
    protected $builder;

    /**
     * Construct
     * 
     * @param Logs $model
     */
    public function __construct(Logs $model)
    {
        parent::__construct();
        $this->builder = $model->newQuery();
    }

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $days = (int) app('antares.memory')->make('primary')->get('activity_logs_remove_after_days', config('antares/logger::activity_log.remove_interval'));
        if (!$days) {
            $this->comment('Configuration for remove activity logs is not configured. Ignoring.');
            return;
        }

        $logs  = $this->builder->where('created_at', '<', DB::raw("DATE(DATE_ADD(NOW(), INTERVAL -{$days} DAY))"));
        $count = $logs->count();

        if (!$count) {
            $this->comment('There are no notification logs available. Ignoring.');
            return;
        }
        DB::beginTransaction();
        try {
            $this->zip($logs->get());
            $logs->delete();
        } catch (Exception $ex) {
            Log::error($ex);
            $this->error($ex->getMessage());
            DB::rollback();
        }
        DB::commit();

        $this->line(sprintf('%d notification logs has been deleted.', $count));
    }

    /**
     * Creation of zip archive with historical data of activity logs
     * 
     * @param \Illuminate\Support\Collection $logs
     * @throws Exception
     */
    protected function zip($logs)
    {
        $path = config('antares/logger::activity_log.history_save_path');
        @mkdir($path, 0777, true);

        $za          = new ZipArchive();
        $filename    = 'activity_log_' . date('Y_m_d', time()) . '.zip';
        $destination = $path . $filename;

        if ($za->open($destination, ZipArchive::CREATE) !== TRUE) {
            throw new Exception("Cannot open <$destination>");
        }
        $za->addFromString(date('Y_m_d_H:i:s', time()) . ".log", print_r($logs->toArray(), true));
        $za->close();
    }

}
