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



use Antares\Model\Role;
use Illuminate\Database\Migrations\Migration;

class LoggerAcl extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        $admin   = Role::admin();
        $acl     = app('antares.acl')->make('antares/logger');
        $memory  = app('antares.memory')->make('component');
        $acl->attach($memory);
        $acl->roles()->attach([$admin->name]);
        $actions = [
            'Activity Dashboard', 'Activity Delete Log', 'Activity Show Details',
            'Report Generate', 'Report View', 'Report Delete', 'Report Html', 'Report Download',
            'Analyzer Dashboard', 'Analyzer Run', 'Analyzer Server', 'Analyzer System',
            'Analyzer Modules', 'Analyzer Version', 'Analyzer Database', 'Analyzer Logs',
            'Analyzer Components', 'Analyzer Checksum',
            'Report Generate', 'Report View', 'Report Download', 'Report Delete', 'Report Html', 'Report Send', 'Report Generate Standalone',
            'View Logs',
            'Request List', 'Request Clear', 'Request Show',
            'Error List', 'Error Details', 'Error Delete', 'Error Download',
            'History List', 'History Show', 'History Delete'
        ];
        $acl->actions()->attach($actions);
        $acl->allow($admin->name, $actions);

        $memory->finish();
        app('antares.memory')->make('primary')->getHandler()->forgetCache();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Foundation::memory()->forget('acl_antares/logger');
    }

}
