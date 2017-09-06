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

namespace Antares\Logger;

use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Database\Eloquent\Model;
use ReflectionMethod;
use ReflectionClass;
use Exception;
use ErrorException;

class RelationResolver
{

    /**
     * Model relations
     *
     * @var array
     */
    private $properties = [];

    /**
     * Model methods
     *
     * @var array
     */
    protected $methods = array();

    /**
     * Public methods which should not be parsed.
     *
     * @var array
     */
    protected static $avoidedMethods = [
        'prepareAudit',
        'auditCreation',
        'getRelatedData',
        'auditUpdate',
        'auditDeletion',
        'audit',
        'bootLogRecorder',
        'logs',
        'classLogHistory'.
        'logHistory',
        'activate',
        'deactivate',
        'suspend',
        'delete',
        'forceDelete',
    ];


    /**
     * Gets relations from model
     *
     * @param Model $model
     * @return array
     */
    protected function getRelations(Model $model)
    {
        return $model->getRelations();
    }

    /**
     * Gets prepared data from related model
     *
     * @param Model $model
     * @return array
     */
    public function getRelationData(Model $model)
    {
        $relations = $this->getRelations($model);
        if (empty($relations)) {
            return [];
        }

        $return = [];

        foreach ($relations as $name => $details) {
            try {
                $related = $model->{$name};
                if (!is_object($model->$name())) {
                    continue;
                }
            } catch (Exception $ex) {
                continue;
            }

            if ($related === null) {
                $related = $model->$name()->getModel();
                array_set($return, $name, [get_class($related) => $related->getFillable()]);
            }

            if ($related !== null && method_exists($related, 'getAttributes')) {
                array_set($return, $name, [get_class($related) => $related->getAttributes()]);
            }
        }
        return $return;
    }

}
