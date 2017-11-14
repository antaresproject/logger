<?php

namespace Antares\Logger\Notifications\Variables;

use Antares\Logger\Events\NewDeviceDetected;
use Antares\Logger\Model\Location;
use Antares\Notifications\Contracts\ModelVariablesResoluble;
use Antares\Notifications\Services\ModuleVariables;
use Carbon\Carbon;
use Faker\Factory as Faker;
use Closure;

class DeviceDetectedVariablesProvider implements ModelVariablesResoluble
{

    /**
     * Applies the variables to the module container.
     *
     * @param ModuleVariables $moduleVariables
     */
    public function applyVariables(ModuleVariables $moduleVariables): void
    {
        $moduleVariables
            ->modelDefinition('location', Location::class, self::fakeLocation())
                ->setAttributes([
                    'city'      => 'City',
                    'country'   => 'Country',
                    'ipAddress' => 'IP Address',
                ]);

        $moduleVariables
            ->modelDefinition('newDeviceDetected', NewDeviceDetected::class, self::fakeEvent());
    }

    /**
     * @return Closure
     */
    public static function fakeLocation(): Closure
    {
        return function() {
            $faker = Faker::create();

            $data = [
                'ip_address'    => $faker->ipv4,
                'location'      => [
                    'country'       => $faker->country,
                    'city'          => $faker->city,
                ],
            ];

            return new Location($data);
        };
    }

    /**
     * @return Closure
     */
    public static function fakeEvent(): Closure
    {
        return function() {
            $user       = auth()->user();
            $location   = value(self::fakeLocation());

            return new NewDeviceDetected($user, $location);
        };
    }

}
