<?php

namespace Antares\Logger\Notifications\Variables;

use Antares\Logger\Events\NewDeviceDetected;
use Antares\Logger\Model\Location;
use Antares\Notifications\Contracts\ModelVariablesResoluble;
use Antares\Notifications\Services\ModuleVariables;
use Carbon\Carbon;
use Faker\Factory as Faker;
use Antares\GeoIP\GeoIPFacade;
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
            ->modelDefinition('location', Location::class, self::location())
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
    public static function location(): Closure
    {
        return function() {
            $data = [
                'ip_address'    => GeoIPFacade::getClientIP(),
                'location'      => [],
            ];

            try {
                $data['location'] = app()->make('geoip')->getLocation();
            } catch (\Exception $ex) {
                $data['location'] = [
                    'country'       => 'not reached',
                    'city'          => 'not reached',
                ];
            }

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
            $location   = value(self::location());

            return new NewDeviceDetected($user, $location);
        };
    }

}
