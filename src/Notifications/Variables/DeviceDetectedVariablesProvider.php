<?php

namespace Antares\Logger\Notifications\Variables;

use Antares\Logger\Model\Location;
use Antares\Notifications\Contracts\ModelVariablesResoluble;
use Antares\Notifications\Services\ModuleVariables;
use Faker\Factory as Faker;
use CLosure;

class DeviceDetectedVariablesProvider implements ModelVariablesResoluble {

    /**
     * Applies the variables to the module container.
     *
     * @param ModuleVariables $moduleVariables
     */
    public function applyVariables(ModuleVariables $moduleVariables) : void {
        $moduleVariables
            ->modelDefinition('location', Location::class, self::default())
            ->setAttributes([
                'city'          => 'City',
                'country'       => 'Country',
                'ipAddress'     => 'IP Address',
            ]);
    }

    /**
     * @return Closure
     */
    public static function default() : Closure {
        return function() {
            $faker = Faker::create();

            return new Location($faker->ipv4, $faker->country, $faker->city);
        };
    }

}
