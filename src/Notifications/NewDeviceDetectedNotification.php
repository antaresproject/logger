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

namespace Antares\Logger\Notifications;

use Antares\Logger\Events\NewDeviceDetected;
use Antares\Notifications\AbstractNotification;
use Antares\Notifications\Collections\TemplatesCollection;
use Antares\Notifications\Messages\MailMessage;
use Antares\Notifications\Model\Template;
use Antares\Notifications\Contracts\NotificationEditable;

class NewDeviceDetectedNotification extends AbstractNotification implements NotificationEditable
{

    /**
     * @var NewDeviceDetected
     */
    protected $newDeviceDetected;

    /**
     * NewDeviceDetectedNotification constructor.
     * @param NewDeviceDetected $newDeviceDetected
     */
    public function __construct(NewDeviceDetected $newDeviceDetected) {
        $this->newDeviceDetected = $newDeviceDetected;
    }

    /**
     * @return TemplatesCollection
     */
    public static function templates(): TemplatesCollection {
        return TemplatesCollection::make('New Device Detected', NewDeviceDetected::class)->define('mail', self::mailMessage());
    }

    /**
     * @return Template
     */
    protected static function mailMessage() {
        $subject    = 'Login to [[ foundation::site.name ]] from new device detected';
        $view       = 'antares/logger::notification.new_device_notification';

        return (new Template(['mail'], $subject, $view))->setSeverity('high')->setRecipients(['auth_user']);
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return MailMessage
     */
    public function toMail($notifiable)
    {
        $data = [
            'user'      => $this->newDeviceDetected->user,
            'date'      => $this->newDeviceDetected->dateTime->format('Y-m-d'),
            'time'      => $this->newDeviceDetected->dateTime->format('H:i'),
            'location'  => $this->newDeviceDetected->location->toArray(),
        ];

        return (new MailMessage())
            ->template('mail')
            ->viewData($data);
    }

}
