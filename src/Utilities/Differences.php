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

namespace Antares\Logger\Utilities;

use Illuminate\Support\Arr;

class Differences {

    /**
     * @var array
     */
    protected $previousData = [];

    /**
     * @var array
     */
    protected $newData = [];

    /**
     * @var array
     */
    protected $computed = [];

    /**
     * Differences constructor.
     * @param array $previousData
     * @param array $newData
     */
    public function __construct(array $previousData, array $newData) {
        $this->previousData = $previousData;
        $this->newData      = $newData;

        $this->compute();
    }

    protected function compute() : void {
        $this->computed = [];

        foreach($this->newData as $key => $value) {
            if (! array_key_exists($key, $this->previousData)) {
                $this->computed[$key] = [
                    'before'    => null,
                    'after'     => $value,
                ];
            }
            elseif ($value !== $this->previousData[$key] &&
                ! $this->originalIsNumericallyEquivalent($key)) {
                $this->computed[$key] = [
                    'before'    => $this->previousData[$key],
                    'after'     => $value,
                ];
            }
        }
    }

    /**
     * @return array
     */
    public function all() : array {
        return $this->computed;
    }

    /**
     * @param string $attribute
     * @return array|null
     */
    public function get(string $attribute) : ?array {
        return Arr::get($this->computed, $attribute);
    }

    /**
     * @return array
     */
    public function getKeys() : array {
        return array_keys( $this->all() );
    }

    /**
     * @param string $attribute
     * @return bool
     */
    public function isChanged(string $attribute) : bool {
        return in_array($attribute, $this->getKeys(), true);
    }

    /**
     * @param string $attribute
     * @return bool
     */
    public function isNotChanged(string $attribute) : bool {
        return ! in_array($attribute, $this->getKeys(), true);
    }

    /**
     * @param string $attribute
     * @param null $default
     * @return mixed
     */
    public function getPrevious(string $attribute, $default = null) {
        return Arr::get($this->previousData, $attribute, $default);
    }

    /**
     * @param string $attribute
     * @param null $default
     * @return mixed
     */
    public function getNew(string $attribute, $default = null) {
        return Arr::get($this->newData, $attribute, $default);
    }

    /**
     * Determine if the new and old values for a given key are numerically equivalent.
     *
     * @param string $key
     * @return bool
     */
    private function originalIsNumericallyEquivalent(string $key) : bool {
        $current = $this->previousData[$key];

        $original = $this->newData[$key];

        // This method checks if the two values are numerically equivalent even if they
        // are different types. This is in case the two values are not the same type
        // we can do a fair comparison of the two values to know if this is dirty.
        return is_numeric($current) && is_numeric($original)
            && strcmp((string) $current, (string) $original) === 0;
    }


}
