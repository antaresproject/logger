<?php

namespace Antares\Logger\Model;

class Location {

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

}