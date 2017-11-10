<?php

namespace Antares\Logger\Model;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Support\Arr;

class Location implements Arrayable {

    /**
     * @var string
     */
    public $ipAddress;

    /**
     * @var string
     */
    public $country;

    /**
     * @var string
     */
    public $city;

    /**
     * Location constructor.
     * @param array $data
     */
    public function __construct(array $data) {
        $this->ipAddress = Arr::get($data, 'ip_address', '');
        $this->country   = Arr::get($data, 'location.country', '');
        $this->city      = Arr::get($data, 'location.city', '');
    }

    /**
     * Get the instance as an array.
     *
     * @return array
     */
    public function toArray() : array {
        return [
            'ipAddress' => $this->ipAddress,
            'country'   => $this->country,
            'city'      => $this->city,
        ];
    }

}