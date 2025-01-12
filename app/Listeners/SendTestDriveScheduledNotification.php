<?php

namespace App\Listeners;

use App\Events\TestDriveScheduled;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendTestDriveScheduledNotification
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(TestDriveScheduled $event): void
    {
        //
    }
}
