<?php

namespace App;

use DateTimeInterface;
use Illuminate\Notifications\DatabaseNotification;

class Notification extends DatabaseNotification
{
     /**
     * Prepare a date for array / JSON serialization.
     *
     * @param  \DateTimeInterface  $date
     * @return string
     */
    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s.u');
    }
}
