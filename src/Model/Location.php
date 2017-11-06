<?php

namespace Antares\Logger\Model;

use Illuminate\Contracts\Support\Arrayable;

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
     * @param string $ipAddress
     * @param string $country
     * @param string $city
     */
    public function __construct(string $ipAddress, string $country, string $city) {
        $this->ipAddress = $ipAddress;
        $this->country = $country;
        $this->city = $city;
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