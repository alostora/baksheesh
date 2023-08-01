<?php

namespace App\Traits;

use App\Foundations\Notification\NotificationCollection;

trait NotificationTrait
{

    public function notify(array $module, array $event, array $data)
    {

        NotificationCollection::foramtContent($event, $data);

        NotificationCollection::createNotification($module, $event, $data);

        NotificationCollection::notify($event, $data);
    }
}
